<?php

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->run("UPDATE  `eav_attribute`  SET  `is_required`  =  '0' WHERE  `eav_attribute`.`attribute_code`  =  'telephone';");

$installer->endSetup();