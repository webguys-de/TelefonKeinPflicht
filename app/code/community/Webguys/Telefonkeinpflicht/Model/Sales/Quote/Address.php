<?php

class Webguys_Telefonkeinpflicht_Model_Sales_Quote_Address extends Mage_Sales_Model_Quote_Address {
    /**
     * Validate address attribute values
     *
     * @return bool
     */
    public function validate()
    {
        $errors = parent::validate();

        $messageToFilter = Mage::helper('customer')->__('Please enter the telephone number.');
        if (is_array($errors) && false !== ($x = array_search($messageToFilter, $errors)))
        { // found telephone error: get rid of it!
            unset($errors[$x]);
            Mage::dispatchEvent('customer_address_validation_after', array('address' => $this));
        }

        if ($errors === true || empty($errors))
        { // no errors: be true
            return true;
        }

        return $errors;
    }
}
