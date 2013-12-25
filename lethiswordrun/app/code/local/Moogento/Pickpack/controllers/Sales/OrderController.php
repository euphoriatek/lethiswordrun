<?php
require_once 'app/code/core/Mage/Adminhtml/controllers/Sales/OrderController.php';
class Moogento_Pickpack_Sales_OrderController extends Mage_Adminhtml_Sales_OrderController
{

	/**
	 * Class Constructor
	 * call the parent Constructor
	 */

	public function __constuct()
	{
		parent::__construct();
	}


	protected function _initAction()
	{
		$this->loadLayout()
		->_setActiveMenu('sales/order')
		->_addBreadcrumb($this->__('Sales'), $this->__('Sales'));
		// ->_addBreadcrumb($this->__('Orders'), $this->__('Trash Orders'));
		return $this;
	}


	public function indexAction()
	{
		parent::indexAction();
	}

	public function packAction()
	{
		$orderIds = $this->getRequest()->getPost('order_ids');        
		$flag = false;
		if (!empty($orderIds)) 
		{
			
				// if(Mage::getStoreConfig('pickpack_options/wonder/page_template') == 1)
				// {       
				// 			foreach ($orderIds as $orderId) 
				// 			{
				// 				$order = Mage::getModel('sales/order')->load($orderId);
				// 
				// 				$flag = true;
				// 				if (!isset($pdf))
				// 				{    			            
				// 					$pdf = Mage::getModel('sales/order_pdf_invoices')->getPdf2($order);	               					
				// 				} 
				// 				else 
				// 				{					    
				// 					$pages = Mage::getModel('sales/order_pdf_invoices')->getPdf2($order);			
				// 					$pdf->pages = array_merge ($pdf->pages, $pages->pages);
				// 				}  
				// 			}
				// 
				// 			if ($flag) 
				// 			{
				// 				return $this->_prepareDownloadResponse('packing-sheet'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
				// 			} 
				// 			else
				// 			{
				// 				$this->_getSession()->addError($this->__('There are no printable documents related to selected orders'));
				// 				$this->_redirect('*/*/');
				// 			}
				// }
				if(Mage::getStoreConfig('pickpack_options/wonder/page_template') == 1)
				{         
					$pdf = Mage::getModel('sales/order_pdf_invoices')->getPdf2($orderIds);	 
					return $this->_prepareDownloadResponse('packing-sheet'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
				}
				else
				{         
					$pdf = Mage::getModel('sales/order_pdf_invoices')->getPdfDefault($orderIds);	 
					return $this->_prepareDownloadResponse('packing-sheet'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
				}
		}
		$this->_redirect('*/*/');

	}

	public function pickAction(){
		$orderIds = $this->getRequest()->getPost('order_ids');

		if (!empty($orderIds)) 
		{
				$pdf = Mage::getModel('sales/order_pdf_invoices')->getPickSeparated2($orderIds);	 
				return $this->_prepareDownloadResponse('pick-list-separated'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
		}
		$this->_redirect('*/*/');
	}
	
	
	public function enpickAction(){
		$orderIds = $this->getRequest()->getPost('order_ids');

		if (!empty($orderIds)) 
		{
				$pdf = Mage::getModel('sales/order_pdf_invoices')->getPickCombined($orderIds);	 
				return $this->_prepareDownloadResponse('pick-list-combined'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
		}
		$this->_redirect('*/*/');
	}
	

	public function stockAction(){
		$orderIds = $this->getRequest()->getPost('order_ids');

		if (!empty($orderIds)) 
		{
				$pdf = Mage::getModel('sales/order_pdf_invoices')->getPickStock2($orderIds);	 
				return $this->_prepareDownloadResponse('out-of-stock-list'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
		}
		$this->_redirect('*/*/');
	}
	
	public function labelAction(){
		$orderIds = $this->getRequest()->getPost('order_ids');

		if (!empty($orderIds)) 
		{
				$pdf = Mage::getModel('sales/order_pdf_invoices')->getLabel($orderIds);	 
				return $this->_prepareDownloadResponse('address-labels'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
		}
		$this->_redirect('*/*/');
	}
		
	// public function pickjimAction(){
	// 	$orderIds = $this->getRequest()->getPost('order_ids');
	// 
	// 	if (!empty($orderIds)) 
	// 	{
	// 			$pdf = Mage::getModel('sales/order_pdf_invoices')->getPickCombined($orderIds);	 
	// 			return $this->_prepareDownloadResponse('pick-list-combined'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
	// 	}
	// 	$this->_redirect('*/*/');
	// }
	

	// public function enpickAction(){
	// 	$orderIds = $this->getRequest()->getPost('order_ids');
	// 	$flag = false;
	// 	if (!empty($orderIds)) {
	// 		foreach ($orderIds as $orderId) {
	// 			$order = Mage::getModel('sales/order')->load($orderId);
	// 			$shipments = Mage::getResourceModel('sales/order_invoice_collection')
	// 			->addAttributeToSelect('*')
	// 			->setOrderFilter($orderId)
	// 			->load();
	//                 
	// 			if ($shipments->getSize() > 0) {
	// 				$flag = true;
	// 				foreach ($shipments as $v){
	// 					$a[]  = $v;
	// 				}
	// 			}
	// 		}
	// 		$pdf = Mage::getModel('sales/order_pdf_pick')->getPdf($a);            
	// 		if ($flag) {
	// 			return $this->_prepareDownloadResponse('combined-picklist'.Mage::getSingleton('core/date')->date('Y-m-d_H').'.pdf', $pdf->render(), 'application/pdf');
	// 		} else {
	// 			$this->_getSession()->addError($this->__('There are no printable documents related to selected orders'));
	// 			$this->_redirect('*/*/');
	// 		}
	// 	}
	// 	$this->_redirect('*/*/');
	// }
}
