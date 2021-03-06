<?php
class Celebros_Conversionpro_Block_Adminhtml_Config_Info extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    const MODULE_NAME = 'Celebros_Conversionpro';
    
    public function render(Varien_Data_Form_Element_Abstract $element)
    {
        $helper = Mage::helper('conversionpro');
        $id = $element->getHtmlId();
        $html = '<tr id="row_' . $id . '">';
        $html .= '<td class="label" colspan="1">' . $helper->__('Module Version') . '</td><td class="value" colspan="4">' . $this->getModuleVersion() . '</td>';
        $html .= '</tr>';
        if ($tmp = $this->getModuleBuild()) {
            $html .= '<tr id="row">';
            $html .= '<td class="label" colspan="1">' . $helper->__('Build') . '</td><td class="value" colspan="4">' . $tmp . '</td>';
            $html .= '</tr>';
        }
        
        if ($tmp = $this->getModuleUpdate()) {
            $html .= '<tr id="row">';
            $html .= '<td class="label" colspan="1">' . $helper->__('Last Update') . '</td><td class="value" colspan="4">' . $tmp . '</td>';
            $html .= '</tr>';
        }
        
        if ($tmp = $this->getModuleDesc()) {
            $html .= '<tr id="row">';
            $html .= '<td class="label" colspan="1">' . $helper->__('Description') . '</td><td class="value" colspan="4">' . $tmp . '</td>';
            $html .= '</tr>';
        }
        
        return $html;
    }
    
    public function getModuleBuild()
    {
        return (string)Mage::getConfig()->getNode('modules/' . self::MODULE_NAME . '/build');
    }
    
    public function getModuleVersion()
    {
        return (string)Mage::getConfig()->getNode('modules/' . self::MODULE_NAME . '/version');
    }
    
    public function getModuleUpdate()
    {
        return (string)Mage::getConfig()->getNode('modules/' . self::MODULE_NAME . '/update');
    }
    
    public function getModuleDesc()
    {
        return (string)Mage::getConfig()->getNode('modules/' . self::MODULE_NAME . '/desc');
    }
    
}