<?php
/**
 * Created by PhpStorm.
 * User: toan
 * Date: 26/03/2019
 * Time: 15:27
 */
namespace Magenest\Movie\Block\Adminhtml\Movie;
use Magento\Backend\Block\Widget\Grid as WidgetGrid;
class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{

    protected $_movieCollection;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magenest\Movie\Model\ResourceModel\Movie\Collection $movieCollection,
        array $data = []
    ) {
        $this->_movieCollection =
            $movieCollection;
        parent::__construct($context, $backendHelper,
            $data);
        $this->setEmptyText(__('No Movies Found'));
    }
    /**
     * Initialize the movie collection
     *
     * @return WidgetGrid
     */
    protected function _prepareCollection()
    {
        $this->setCollection($this->_movieCollection);
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
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
            ]
        );
        $this->addColumn(
            'description',
            [
                'header' => __('description'),
                'index' => 'description',
            ]
        );
        $this->addColumn(
            'rating',
            [
                'header' => __('Rating'),
                'index' => 'rating',
            ]
        );
        $this->addColumn(
            'director_id',
            [
                'header' => __('Director ID'),
                'index' => 'director_id',
            ]
        );

        return $this;
    }

}