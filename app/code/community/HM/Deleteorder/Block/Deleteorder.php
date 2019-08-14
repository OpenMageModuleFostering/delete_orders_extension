<?php
/**
 * Delete Orders Extension
 *
 * Author: Hire Magento
 * Website: www.hiremagento.com 
 * Suport Email: hiremagento@gmail.com
 *
**/

class HM_Deleteorder_Block_Deleteorder extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getDeleteorder()     
     { 
        if (!$this->hasData('deleteorder')) {
            $this->setData('deleteorder', Mage::registry('deleteorder'));
        }
        return $this->getData('deleteorder');
        
    }
}