<?php

namespace AHT\CustomCheckout\Controller\Adminhtml\Order;

use Magento\Framework\Exception\LocalizedException;

class DeliverySave extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Magento_Sales::actions_edit';

    private $_orderCollectionFactory;
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

    /**
     * @param \Magento\Sales\Model\OrderFactory
     */
    private $_orderFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory,
        \Magento\Sales\Model\OrderFactory $orderFactory
    )
    {
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->_pageFactory = $pageFactory;
        $this->_orderFactory = $orderFactory;
        return parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Framework\View\Result\Page $resultPage */
        $resultPage = $this->_pageFactory->create();
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        try {

            $id = $this->getRequest()->getParam('id');
            $order = $this->_orderFactory->create()->load($id);

            $order->setData('delivery_data',$this->getRequest()->getParam('date'));
            $order->setData('delivery_comment',$this->getRequest()->getParam('comment'));
            $order->save();
            $this->messageManager->addSuccessMessage(__('You updated the order delivery.'));
            return $resultRedirect->setPath('sales/*/view', ['order_id' => $id]);
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage($e, __('We can\'t update the order delivery right now.'));
        }

    }

    /**
     * Is the user allowed to view the page.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(static::ADMIN_RESOURCE);
    }
}
