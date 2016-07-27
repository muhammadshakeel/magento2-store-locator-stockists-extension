<?php
/**
 * Limesharp_Stockists extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License
 * that is bundled with this package in the file LICENSE
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/mit-license.php
 *
 * @category  Limesharp
 * @package   Limesharp_Stockists
 * @copyright 2016 Claudiu Creanga
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 * @author   Claudiu Creanga
 */
 
namespace Limesharp\Stockists\Block;

use Magento\Backend\Block\Template\Context;
use Limesharp\Stockists\Model\Stores;
use Limesharp\Stockists\Model\ResourceModel\Stores\CollectionFactory as StockistsCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Stores extends \Magento\Framework\View\Element\Template
{
	
    
    /**
     * @var StockistsCollectionFactory
     */
    protected $stockistsCollectionFactory;
    
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    
    public function __construct(
        StockistsCollectionFactory $stockistsCollectionFactory,
        StoreManagerInterface $storeManager,
		Context $context ,
		array $data = []
    )
    {
        $this->stockistsCollectionFactory = $stockistsCollectionFactory;
        $this->storeManager = $storeManager;
        parent::__construct($context, $data);
    }
    
    public function getBaseImageUrl()
    {
	    return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }
    
     /**
     * return stockists collection
     *
     * @return CollectionFactory
     */
    public function getStoresForFrontend()
    {
	    $collection = $this->stockistsCollectionFactory->create()
	    	->addFieldToSelect('*')
            ->addFieldToFilter('status', Stores::STATUS_ENABLED)
            ->addStoreFilter($this->_storeManager->getStore()->getId())
            ->setOrder('name', 'ASC');;
	    return $collection;
    }
}