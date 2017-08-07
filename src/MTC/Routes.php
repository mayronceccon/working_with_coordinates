<?php

namespace MTC;


class Routes
{
    public function getInterimPoints(\MTC\Coordinates $start, \MTC\Coordinates $finish)
    {
        if (!$start->validated()) {
            throw new \Exception('Invalid start data');
        }

        if (!$finish->validated()) {
            throw new \Exception('Invalid finish data');
        }

        $geometry = $this->getData($start, $finish);
        $result = $this->decodeGeometry($geometry->routes[0]->geometry);

        return $result;
    }

    private function getData(\MTC\Coordinates $start, \MTC\Coordinates $finish)
    {
        if ($start->validated() and $finish->validated()) {
            $startCoordinates = $start->getLongitude() . ',' . $start->getLatitude();
            $finishCoordinates = $finish->getLongitude() . ',' . $finish->getLatitude();

            $url = "http://router.project-osrm.org/route/v1/driving/{$startCoordinates};{$finishCoordinates}";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, True);
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1');
            $return = curl_exec($curl);
            curl_close($curl);
            return json_decode($return);
        }
    }

    private function decodeGeometry(string $geometry): array
    {
        $len = strlen($geometry) -1;
        $path = [];
        $index = 0;
        $lat = 0;
        $lng = 0;
        while ($index < $len) {
            $result = 1;
            $shift = 0;
            do {
                $b = ord($geometry{$index++}) - 63 - 1;
                $result += $b << $shift;
                $shift += 5;
            } while ($b >= hexdec("0x1f"));
            $lat += ($result & 1) != 0 ? ~($result >> 1) : ($result >> 1);
            $result = 1;
            $shift = 0;
            do {
                $b = ord($geometry{$index++}) - 63 - 1;
                $result += $b << $shift;
                $shift += 5;
            } while ($b >= hexdec("0x1f"));
            $lng += ($result & 1) != 0 ? ~($result >> 1) : ($result >> 1);
            array_push($path, ['latitude' => $lat * 1e-5, 'longitude' => $lng * 1e-5]);
        }
        return $path;
    }
}