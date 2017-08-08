<?php

use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testLocationByCoordinates()
    {
        $latitude = -25.437979;
        $longitude = -49.26648;

        $coordinates = new \MTC\Coordinates();
        $coordinates->setLatitude($latitude);
        $coordinates->setLongitude($longitude);

        $location = new \MTC\Location();
        $location->setFind($coordinates);

        $result = $location->getResult();
        $expected = array(
            'address' => 'Av. Sete de Setembro, 2775 - Rebouças, Curitiba - PR, 80230-010, Brazil',
            'latitude' => $latitude,
            'longitude' => $longitude
        );

        $this->assertEquals($expected['address'], $result['address']);
    }

    public function testLocationByCoordinates2()
    {
        $coordinates = new \MTC\Coordinates();
        $coordinates->setLatitude('-25.428401');
        $coordinates->setLongitude('-49.243065');

        $location = new \MTC\Location();
        $location->setFind($coordinates);

        $result = $location->getResult();
        $expected = 'Av. Sete de Setembro, 100 - Alto da Rua Quinze, Curitiba - PR, 80050-100, Brazil';

        $this->assertEquals($expected, $result['address']);
    }

    public function testLocationByAddress()
    {
        $address = new \MTC\Address();
        $address->setAddress('Av. Sete de Setembro, 100 - Alto da Rua Quinze, Curitiba - PR, 80050-100, Brazil');

        $location = new \MTC\Location();
        $location->setFind($address);

        $result = $location->getResult();
        $expected = array('latitude' => '-25.42840', 'longitude' => '-49.24307');

        $this->assertEquals($expected, array('latitude' => $result['latitude'], 'longitude' => $result['longitude']));
    }

    /**
     * @expectedException TypeError
     */
    public function testExceptionParamFindLocation()
    {
        $location = new \MTC\Location();
        $location->setFind('Av. Sete de Setembro, 100 - Alto da Rua Quinze, Curitiba - PR, 80050-100, Brazil');
    }
}
