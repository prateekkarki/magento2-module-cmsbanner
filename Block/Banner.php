<?php
namespace PrateekKarki\Cmsbanner\Block;

class Banner extends \Magento\Framework\View\Element\Template
{
   protected $scopeConfig;
    public function __construct(\Magento\Framework\View\Element\Template\Context $context, \Magento\Cms\Model\Page $page, \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig, array $data = [])
    {
        parent::__construct($context, $data);
        $this->scopeConfig = $scopeConfig;
        $this->page = $page;
        $this->dir = $dir;
    }

    public function getPageBanner() {
		$storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
		$image = (null == $this->page->getCmsBanner()) ? null : $this->scopeConfig->getValue('web/unsecure/base_url', $storeScope) . 'pub/media/cms/' . $this->page->getCmsBanner();
		return $image;		
	}
}
