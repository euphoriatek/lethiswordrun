<?php
class Moogento_Pickpack_Model_Sortitems
{

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return array(
            array('value' => 'sku', 'label'=>Mage::helper('pickpack')->__('SKU')),
            array('value' => 'shelving_real', 'label'=>Mage::helper('pickpack')->__('Shelf')),
            array('value' => 'shelving', 'label'=>Mage::helper('pickpack')->__('Extra Attribute')),
            array('value' => 'none', 'label'=>Mage::helper('pickpack')->__('None (Don\'t sort)'))
        );
    }

}
