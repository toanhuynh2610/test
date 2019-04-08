<?php
namespace Magenest\Movie\Controller\Adminhtml\System\Config;
class Reload extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $this->_redirect('admin/admin/system_config/edit/section/movie/');
    }
}