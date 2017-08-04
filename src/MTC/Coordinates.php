<?php


namespace MTC;


class Coordinates
{
    protected $latitude;
    protected $longitude;

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function validated()
    {
        if (empty($this->getLatitude()) or empty($this->getLongitude())) {
            throw new \Exception('Latitude or longitude should not be empty');
        }

        if (!$this->isGeoValid('latitude', $this->getLatitude())) {
            throw new \Exception('Latitude is not valid');
        }

        if (!$this->isGeoValid('longitude', $this->getLongitude())) {
            throw new \Exception('Longitude is not valid');
        }

        return true;
    }

    private function isGeoValid($type, $value)
    {
        $pattern = ($type == 'latitude')
            ? '/^(\+|-)?(?:90(?:(?:\.0{1,8})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,8})?))$/'
            : '/^(\+|-)?(?:180(?:(?:\.0{1,8})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,8})?))$/';

        if (preg_match($pattern, $value)) {
            return true;
        }

        return false;
    }
}