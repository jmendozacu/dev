<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Scheckout
 */
 if ($this->isRequired()) echo '<em>*</em>' ?><?php echo $this->__('Gender') ?></label>
<div class="input-box">
    <select id="<?php echo $this->getFieldId('gender')?>" name="<?php echo $this->getFieldName('gender')?>" title="<?php echo $this->__('Gender') ?>"<?php if ($this->isRequired()):?> class="validate-select"<?php endif; ?> <?php echo $this->getFieldParams() ?>>
        <?php $options = Mage::getResourceSingleton('customer/customer')->getAttribute('gender')->getSource()->getAllOptions();?>
        <?php $value = $this->getGender();?>
        <?php foreach ($options as $option):?>
            <option value="<?php echo $option['value'] ?>"<?php if ($option['value'] == $value) echo ' selected="selected"' ?>><?php echo $option['label'] ?></option>
        <?php endforeach;?>
    </select>
</div> 