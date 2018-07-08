<?php


namespace PrateekKarki\Cmsbanner\Controller\Adminhtml\Cms;

class Uploader extends \Magento\Catalog\Model\ImageUploader
{
    public function __construct(
        \Magento\MediaStorage\Helper\File\Storage\Database $coreFileStorageDatabase,
        \Magento\Framework\Filesystem $filesystem,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Psr\Log\LoggerInterface $logger
    ) {
        parent::__construct($coreFileStorageDatabase, $filesystem, $uploaderFactory, $storeManager, $logger, 'cms/tmp', 'cms', ['jpg', 'jpeg', 'gif'] );
    }
}
