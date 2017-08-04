<?php
/**
 * Created by PhpStorm.
 * User: mayron
 * Date: 04/08/17
 * Time: 14:53
 */

use PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{
    public function testValidationCoordinates()
    {
        $latitude = '-25.4284';
        $longitude = '-49.2733';

        $coordinates = new \MTC\Coordinates();
        $coordinates->setLatitude($latitude);
        $coordinates->setLongitude($longitude);

        $this->assertTrue($coordinates->validated());
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionValidationCoordinates()
    {
        $latitude = '-25.4284';
        $longitude = '';

        $coordinates = new \MTC\Coordinates();
        $coordinates->setLatitude($latitude);
        $coordinates->setLongitude($longitude);

        $coordinates->validated();

        $this->expectExceptionMessage('Latitude or longitude should not be empty');
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionLatitudeInvalid()
    {
        $latitude = '-8989898';
        $longitude = '-49.2733';

        $coordinates = new \MTC\Coordinates();
        $coordinates->setLatitude($latitude);
        $coordinates->setLongitude($longitude);

        $coordinates->validated();

        $this->expectExceptionMessage('Latitude is not valid');
    }

    /**
     * @expectedException Exception
     */
    public function testExceptionLongitudeInvalid()
    {

        $latitude = '-25.4284';
        $longitude = '-200.2733';

        $coordinates = new \MTC\Coordinates();
        $coordinates->setLatitude($latitude);
        $coordinates->setLongitude($longitude);

        $coordinates->validated();

        $this->expectExceptionMessage('Longitude is not valid');
    }
}
