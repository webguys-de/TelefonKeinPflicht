<?php

/**
 * Address validator model
 *
 * @category    Webguys
 * @package     Webguys_Telefonkeinpflicht
 * @author      Daniel Rose <daniel.rose@fondofbags.com>
 */
class Webguys_Telefonkeinpflicht_Model_Validator_Address extends Webguys_Telefonkeinpflicht_Model_Validator_Abstract
{
    /**
     * Validate object
     *
     * @param Mage_Core_Model_Abstract $object
     * @return bool
     */
    public function validate(Mage_Core_Model_Abstract $object)
    {
        if (!($object instanceof Mage_Customer_Model_Address_Abstract))
            Mage::throwException('The "object" parameter must be an instance of "Mage_Customer_Model_Address_Abstract"');

        if (!Zend_Validate::is($object->getFirstname(), 'NotEmpty')) {
            return false;
        }

        if (!Zend_Validate::is($object->getLastname(), 'NotEmpty')) {
            return false;
        }

        if (!Zend_Validate::is($object->getStreet(1), 'NotEmpty')) {
            return false;
        }

        if (!Zend_Validate::is($object->getCity(), 'NotEmpty')) {
            return false;
        }

        $_havingOptionalZip = Mage::helper('directory')->getCountriesWithOptionalZip();

        if (!in_array($object->getCountryId(), $_havingOptionalZip)
            && !Zend_Validate::is($object->getPostcode(), 'NotEmpty')
        ) {
            return false;
        }

        if (!Zend_Validate::is($object->getCountryId(), 'NotEmpty')) {
            return false;
        }

        if ($object->getCountryModel()->getRegionCollection()->getSize()
            && !Zend_Validate::is($object->getRegionId(), 'NotEmpty')
            && Mage::helper('directory')->isRegionRequired($object->getCountryId())
        ) {
            return false;
        }

        return true;
    }
}
