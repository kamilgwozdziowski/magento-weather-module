<?php
namespace MylSoft\Weather\Controller\Page;

use \Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;

class View extends Action
{
    /**
     * View  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

       $objectManager = ObjectManager::getInstance();

       $dataCollection = $objectManager->create('MylSoft\Weather\Model\Weather')->getCollection();                    
       $weather = $dataCollection->getLastItem()->getData();

       $block = $page->getLayout()->getBlock('mylsoft.weather.layout.view');
       $block->setData('weather', $weather);

       return $page;
    }

    public function getData()
    {
        return 111;
    }
}