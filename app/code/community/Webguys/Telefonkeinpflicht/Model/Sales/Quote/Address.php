<?php

if (Mage::helper('core')->isModuleEnabled('Payone_Core')) {
    class Webguys_Telefonkeinpflicht_Model_Sales_Quote_Address_Abstract extends Payone_Core_Model_Sales_Quote_Address {}
} else {
    class Webguys_Telefonkeinpflicht_Model_Sales_Quote_Address_Abstract extends Mage_Sales_Model_Quote_Address {}
}

class Webguys_Telefonkeinpflicht_Model_Sales_Quote_Address extends Webguys_Telefonkeinpflicht_Model_Sales_Quote_Address_Abstract {
    /**
     * Validate address attribute values
     *
     * @return bool
     */
    public function validate()
    {
        $errors = parent::validate();

        $transport = new Varien_Object();
        $transport->setErrors( $errors );
        $transport->setAddress( $this );

        Mage::dispatchEvent('customer_address_validation_errors', array('transport' => $transport ));

        $errors = $transport->getErrors();

        if ($errors === true || empty($errors))
        { // no errors: be true
            return true;
        }

        return $errors;
    }
}
