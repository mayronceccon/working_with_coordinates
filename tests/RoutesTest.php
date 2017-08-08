<?php

use PHPUnit\Framework\TestCase;

class RoutesTest extends TestCase
{
    public function testReturnCoordinates()
    {
        $latitude = -25.3771036;
        $longitude = -49.1327806;
        $coordinatesStart = new \MTC\Coordinates();
        $coordinatesStart->setLatitude($latitude);
        $coordinatesStart->setLongitude($longitude);

        $latitude = -25.3655216;
        $longitude = -49.1842127;
        $coordinatesFinish = new \MTC\Coordinates();
        $coordinatesFinish->setLatitude($latitude);
        $coordinatesFinish->setLongitude($longitude);

        $routes = new \MTC\Routes();
        $result = $routes->getInterimPoints($coordinatesStart, $coordinatesFinish);
        $this->assertTrue(is_array($result));
    }
}
