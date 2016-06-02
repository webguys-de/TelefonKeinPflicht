<?php

namespace Webguys\TelefonKeinPflicht\Plugin\Model\Customer;

class Address
{

    public function afterValidate(\Magento\Customer\Model\Address $subject, $result)
    {
        $blacklist = array(
            __('Please enter the phone number.')
        );
        return array_diff($result, $blacklist);
    }

}


