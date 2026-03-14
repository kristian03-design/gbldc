<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZipLookupController extends Controller
{
    public function lookup(Request $request)
    {
        $cityCode = (string) $request->query('city_code', '');
        $cityName = (string) $request->query('city_name', '');

        $zip = null;
        $source = null;

        $byCode = (array) config('zip_by_city.by_code', []);
        if ($cityCode !== '' && array_key_exists($cityCode, $byCode)) {
            $zip = (string) $byCode[$cityCode];
            $source = 'code';
        }

        if ($zip === null) {
            $byName = (array) config('zip_by_city.by_name', []);
            if ($cityName !== '' && array_key_exists($cityName, $byName)) {
                $zip = (string) $byName[$cityName];
                $source = 'name';
            }
        }

        return response()->json([
            'zip' => $zip,
            'source' => $source,
        ]);
    }
}

