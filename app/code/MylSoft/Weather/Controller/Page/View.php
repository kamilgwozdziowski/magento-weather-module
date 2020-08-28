<?php
namespace MylSoft\Weather\Controller\Page;

use \Magento\Framework\App\ObjectManager;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Controller\Result\JsonFactory;

class View extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(Context $context, JsonFactory $resultJsonFactory)
{
       $this->resultJsonFactory = $resultJsonFactory;
       parent::__construct($context);
}
    /**
     * View  page action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
       $result = $this->resultJsonFactory->create();

       $objectManager = ObjectManager::getInstance();

       $dataCollection = $objectManager->create('MylSoft\Weather\Model\Weather')->getCollection();                    
       $data = $dataCollection->getLastItem()->getData();

       return $result->setData($data);
} }