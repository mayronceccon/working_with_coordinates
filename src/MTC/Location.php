<?php

namespace MTC;


class Location
{
    private $result;

    public function setFindAddress(\MTC\IGeographical $find)
    {
        if (!$find->validated()) {
            throw new \Exception('Invalid data');
        }

        $strSearch = $this->rideResearch($find);
        $data = $this->getData($strSearch);
        $this->result = $this->mountData($data);
    }

    public function getResult()
    {
        return $this->result;
    }

    private function rideResearch(\MTC\IGeographical $find)
    {
        return $find->__toString();
    }

    private function getData(string $input)
    {
        $url = 'http://maps.google.com/maps/api/geocode/json?address='.$input.'&sensor=false';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
        $return = curl_exec($curl);
        curl_close($curl);
        return json_decode($return);
    }

    private function mountData($data)
    {
        $address = '';
        if (count($data->results) > 0) {
            $address = $data->results[0]->formatted_address;
        }
        return $address;
    }
}