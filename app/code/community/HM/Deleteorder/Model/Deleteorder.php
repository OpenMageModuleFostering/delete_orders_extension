<?php
/**
 * Delete Orders Extension
 *
 * Author: Hire Magento
 * Website: www.hiremagento.com 
 * Suport Email: hiremagento@gmail.com
 *
**/

class HM_Deleteorder_Model_Deleteorder extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('deleteorder/deleteorder');
    }
}