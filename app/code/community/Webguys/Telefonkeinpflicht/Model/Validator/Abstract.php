<?php

/**
 * Abstract validator model
 *
 * @category    Webguys
 * @package     Webguys_Telefonkeinpflicht
 * @author      Daniel Rose <daniel.rose@fondofbags.com>
 */
abstract class Webguys_Telefonkeinpflicht_Model_Validator_Abstract
{
    /**
     * Validate object
     *
     * @param Mage_Core_Model_Abstract $object
     * @return bool
     */
    abstract public function validate(Mage_Core_Model_Abstract $object);
}
