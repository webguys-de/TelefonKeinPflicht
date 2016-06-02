<?php

namespace Webguys\TelefonKeinPflicht\Plugin\Model\Order;

class Address
{

    public function afterValidateForCustomer( \Magento\Sales\Model\Order\Address\Validator $subject, $result )
    {
        $blacklist = array(
            __('Please enter the phone number.')
        );
        return array_diff( $result, $blacklist );
    }

}


