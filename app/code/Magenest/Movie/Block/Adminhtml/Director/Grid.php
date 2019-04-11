<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 26/03/2019
 * Time: 15:27
 */
namespace Magenest\Movie\Block\Adminhtml\Director;
use Magento\Backend\Block\Widget\Grid as WidgetGrid;
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{

    protected $_directorCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magenest\Movie\Model\ResourceModel\Director\Collection $directorCollection,
        array $data = []
    ) {
        $this->_directorCollection =
            $directorCollection;
        parent::__construct($context, $backendHelper,
            $data);
        $this->setEmptyText(__('No Directors Found'));
    }
    /**
     * Initialize the movie collection
     *
     * @return WidgetGrid
     */
    protected function _prepareCollection()
    {
        $this->setCollection($this->_directorCollection);
        return parent::_prepareCollection();
    }
    /**
     * Prepare grid columns
     *
     * @return $this
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'director_id',
            [
                'header' => __('ID'),
                'index' => 'director_id',
            ]
        )->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
            ]
        );
        return $this;
    }

}