<?php
namespace PrateekKarki\Cmsbanner\Model\Cms;

use Magento\Cms\Model\ResourceModel\Page\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Cms\Model\Page\DataProvider
{

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) 
            return $this->loadedData;
        
        $items = $this->collection->getItems();
        foreach ($items as $page) {
            $this->loadedData[$page->getId()] = $page->getData();
        }

        $data = $this->dataPersistor->get('cms_page');

        if (!empty($data)) {
            $page = $this->collection->getNewEmptyItem();

            $page->setData($data);
            $this->loadedData[$page->getId()] = $page->getData();
            $this->dataPersistor->clear('cms_page');
        }
        
        if(!empty($this->loadedData[$page->getId()]['cms_banner'])){
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
            $currentStore = $storeManager->getStore();
            $media_url=$currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

            $image_name=$this->loadedData[$page->getId()]['cms_banner'];
            unset($this->loadedData[$page->getId()]['cms_banner']);
            $this->loadedData[$page->getId()]['cms_banner'][0]['name']=$image_name;
            $this->loadedData[$page->getId()]['cms_banner'][0]['url']=$media_url."cms/".$image_name;
        }
        return $this->loadedData;
    }
}
