<?php

class Webguys_Telefonkeinpflicht_Model_Observer
{

    public function core_block_abstract_to_html_after( $event ) {

        /** @var $block Mage_Core_Block_Abstract */
        $block = $event->getBlock();

        $type = $block->getType();

        $transportObject = $event->getTransport();

        if ( in_array($type, array('checkout/onepage_billing', 'checkout/onepage_shipping','customer/address_edit') ) ) {

            $html = $transportObject->getHtml();
            $html = preg_replace_callback('#\<div class="field"\>(.*?)\</div\>#is', array( $this, 'replacer' ), $html );

            $transportObject->setHtml( $html );

        }

    }

    public function replacer( $matches )
    {
        $str = $matches[0];
        if ( strpos($str, ':telephone') !== false || strpos($str, 'id="telephone"') !== false ) {
            $str = str_replace('required','',$str);
            $str = str_replace('<em>*</em>', '', $str);
        }
        return $str;
    }


}