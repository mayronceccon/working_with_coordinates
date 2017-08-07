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

        $expected = array(
            array('latitude' => -25.37705, 'longitude' => -49.1317),
            array('latitude' => -25.376, 'longitude' => -49.12817),
            array('latitude' => -25.37417, 'longitude' => -49.12884),
            array('latitude' => -25.37212, 'longitude' => -49.12863),
            array('latitude' => -25.37084, 'longitude' => -49.12899),
            array('latitude' => -25.37156, 'longitude' => -49.13214),
            array('latitude' => -25.37321, 'longitude' => -49.14407),
            array('latitude' => -25.38321, 'longitude' => -49.16767),
            array('latitude' => -25.38398, 'longitude' => -49.16987),
            array('latitude' => -25.3842, 'longitude' => -49.17335),
            array('latitude' => -25.38065, 'longitude' => -49.17363),
            array('latitude' => -25.38068, 'longitude' => -49.17579),
            array('latitude' => -25.37951, 'longitude' => -49.17653),
            array('latitude' => -25.37987, 'longitude' => -49.17743),
            array('latitude' => -25.37864, 'longitude' => -49.17834),
            array('latitude' => -25.37709, 'longitude' => -49.17829),
            array('latitude' => -25.3762, 'longitude' => -49.17884),
            array('latitude' => -25.37397, 'longitude' => -49.17848),
            array('latitude' => -25.37179, 'longitude' => -49.17969),
            array('latitude' => -25.36848, 'longitude' => -49.17925),
            array('latitude' => -25.36807, 'longitude' => -49.18119),
            array('latitude' => -25.36497, 'longitude' => -49.18374),
            array('latitude' => -25.36535, 'longitude' => -49.18434),
        );

        $this->assertEquals($expected, $result);
    }
}
