<?php
namespace Magenest\Movie\Plugin\Cart;
use Magento\Checkout\CustomerData\AbstractItem;
class ImageProduct
{

    public function aroundGetItemData($result, \Closure $proceed,\Magento\Quote\Model\Quote\Item $item)
    {
//        $item->getProduct()->getAttributeText('image')
        $result= $proceed($item);
        $id = $item->getChildren();


        foreach ($id as $a)
        {
            $result['product_name']=$a->getProduct()->getName();
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $store = $objectManager->get('Magento\Store\Model\StoreManagerInterface')->getStore();
            $imageUrl = $store->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . 'catalog/product' .$a->getProduct()->getOrigData('thumbnail');
            $result['product_image']['src'] = $imageUrl;
        }

        //$result['product_image']['src'] = 'http://localhost/magento3/pub/media/catalog/product/s/1/s10prismblack.png.dc3022142a.999x600x550.png';
        return $result;
    }
}