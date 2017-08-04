<?php

use PHPUnit\Framework\TestCase;

class LocationTest extends TestCase
{
    public function testLocationByCoordinates()
    {
        $coordinates = new \MTC\Coordinates();
        $coordinates->setLatitude('-25.437979');
        $coordinates->setLongitude('-49.266488');

        $location = new \MTC\Location();
        $location->setFindAddress($coordinates);

        $result = $location->getResult();
        $expected = 'Av. Sete de Setembro, 2775 - Rebouças, Curitiba - PR, 80230-010, Brazil';

        $this->assertEquals($expected, $result);
    }

    public function testLocationByCoordinates2()
    {
        $coordinates = new \MTC\Coordinates();
        $coordinates->setLatitude('-25.428401');
        $coordinates->setLongitude('-49.243065');

        $location = new \MTC\Location();
        $location->setFindAddress($coordinates);

        $result = $location->getResult();
        $expected = 'Av. Sete de Setembro, 100 - Alto da Rua Quinze, Curitiba - PR, 80050-100, Brazil';

        $this->assertEquals($expected, $result);
    }
}
