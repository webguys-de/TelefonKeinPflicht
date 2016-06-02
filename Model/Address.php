<?php

namespace Webguys\TelefonKeinPflicht\Model;


class Address extends \Magento\Customer\Model\Address
{

    public function getShouldIgnoreValidation()
    {
        return true;
    }

}