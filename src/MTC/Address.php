<?php

namespace MTC;


class Address implements IGeographical
{
    private $address;

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function validated()
    {
        if (empty($this->getAddress())) {
            throw new \Exception('Address should not be empty');
        }

        return true;
    }

    public function __toString()
    {
        return str_replace(" ", "+", $this->getAddress());
    }
}