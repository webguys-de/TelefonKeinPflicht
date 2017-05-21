<?php

/**
 * Observer model
 *
 * @category    Webguys
 * @package     Webguys_Telefonkeinpflicht
 */
class Webguys_Telefonkeinpflicht_Model_Observer
{
    /**
     * @param $event
     */
    public function core_block_abstract_to_html_after($event)
    {
        /** @var $block Mage_Core_Block_Abstract */
        $block = $event->getBlock();
        $type = $block->getType();
        $transportObject = $event->getTransport();

        if (in_array($type, array('checkout/onepage_billing', 'checkout/onepage_shipping', 'customer/address_edit'))) {
            $html = $transportObject->getHtml();
            $html = preg_replace_callback('#\<div class="field"\>(.*?)\</div\>#is', array($this, 'replacer'), $html);

            $transportObject->setHtml($html);
        }
    }

    /**
     * @param $matches
     * @return mixed
     */
    public function replacer($matches)
    {
        $str = $matches[0];
        if (strpos($str, ':telephone') !== false || strpos($str, 'id="telephone"') !== false) {
            $str = str_replace('required', '', $str);
            $str = str_replace('<em>*</em>', '', $str);
        }
        return $str;
    }

    /**
     * Revalidate
     *
     * @param Varien_Event_Observer $observer
     * @return $this
     */
    public function revalidate(Varien_Event_Observer $observer)
    {
        $event = $observer->getEvent();

        if (!$event || !($event instanceof Varien_Event)) {
            return $this;
        }

        $address = $event->getData('address');
        $validator = Mage::getModel('telefonkeinpflicht/validator_address');

        if ($address && ($address instanceof Mage_Customer_Model_Address_Abstract) && $validator->validate($address)) {
            $address->setData('should_ignore_validation', true);
        }

        return $this;
    }
}
