<?php

namespace Magenest\Movie\Model\Eav\Backend;

use Magento\Framework\App\Request\Http;

/**
 * Catalog category image attribute backend model
 *
 * @api
 * @since 100.0.2
 */
class AvatarCustomer extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{

    protected $_uploaderFactory;

    protected $_filesystem;

    protected $_fileUploaderFactory;

    protected $_logger;

    private $imageUploader;

//    protected $request;

    /**
     * @var string
     */
    private $additionalData = '_additional_data_';

    /**
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
     */
    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Filesystem $filesystem,
//        \Magento\Framework\App\Request\Http $request,
        \Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory
    ) {
        $this->_filesystem = $filesystem;
        $this->_fileUploaderFactory = $fileUploaderFactory;
        $this->_logger = $logger;
//        $this->request = $request;
    }

    /**
     * Gets image name from $value array.
     * Will return empty string in a case when $value is not an array
     *
     * @param array $value Attribute value
     * @return string
     */
    private function getUploadedImageName($value)
    {
        if (is_array($value) && isset($value[0]['name'])) {
            return $value[0]['name'];
        }

        return '';
    }

    /**
     * Avoiding saving potential upload data to DB
     * Will set empty image attribute value if image was not uploaded
     *
     */
    public function beforeSave($object)
    {
        $attributeName = $this->getAttribute()->getName();
        $value = $object->getData($attributeName);
        $imageName = $this->getUploadedImageName($value);
        if ($imageName != null) {
            $object->setData($this->additionalData . $attributeName, $value);
            $object->setData($attributeName, $imageName);
        } else {
            $object->setData($attributeName, null);
        }

        return parent::beforeSave($object);
    }

    /**
     * @return \Magenest\Movie\Model\ImageUploader
     *
     * @deprecated 101.0.0
     */
    private function getImageUploader()
    {
        if ($this->imageUploader === null) {
            $this->imageUploader = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Magenest\Movie\Model\ImageUploader::class);
        }

        return $this->imageUploader;
    }

    /**
     * Check if temporary file is available for new image upload.
     *
     * @param array $value
     * @return bool
     */

    private function isTmpFileAvailable($value)
    {
        return is_array($value) && isset($value[0]['tmp_name']);
    }

    /**
     * Save uploaded file and set its name to category
     *
     * @param \Magento\Framework\DataObject $object
     * @return \Magenest\Movie\Model\Eav\Backend\AvatarCustomer
     */
    public function afterSave($object)
    {
        $value = $object->getData($this->additionalData . $this->getAttribute()->getName());

        if ($this->isTmpFileAvailable($value) && $imageName = $this->getUploadedImageName($value)) {
            try {
                $this->getImageUploader()->moveFileFromTmp($imageName);
            } catch (\Exception $e) {
                $this->_logger->critical($e);
            }
        }
        return $this;
    }
}
