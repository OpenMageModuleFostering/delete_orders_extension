<?php
/**
 * Delete Orders Extension
 *
 * Author: Hire Magento
 * Website: www.hiremagento.com 
 * Suport Email: hiremagento@gmail.com
 *
**/

class HM_Deleteorder_Adminhtml_DeleteorderController extends Mage_Adminhtml_Controller_action
{

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('deleteorder/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
     protected function _initOrder()
    {
        $id = $this->getRequest()->getParam('order_id');
        $order = Mage::getModel('sales/order')->load($id);

        if (!$order->getId()) {
            $this->_getSession()->addError($this->__('This order no longer exists.'));
            $this->_redirect('*/*/');
            $this->setFlag('', self::FLAG_NO_DISPATCH, true);
            return false;
        }
        Mage::register('sales_order', $order);
        Mage::register('current_order', $order);
        return $order;
    }
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}
	public function deleteAction() {
		if($order = $this->_initOrder()) {
			try {
     		    $order->delete()->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Order was successfully deleted'));
				$this->_redirectUrl(Mage::getBaseUrl().'admin/sales_order/index');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('order_ids')));
			}
		}
		$this->_redirectUrl(Mage::getBaseUrl().'admin/sales_order/index');
	}
    public function massDeleteAction() {
        $deleteorderIds = $this->getRequest()->getParam('order_ids');
		if(!is_array($deleteorderIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($deleteorderIds as $deleteorderId) {
					Mage::getModel('sales/order')->load($deleteorderId)->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($deleteorderIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
		$this->_redirectUrl(Mage::getBaseUrl().'admin/sales_order/index');
    }
}