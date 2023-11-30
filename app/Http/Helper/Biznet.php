<?php

namespace App\Http\Helper;

use Illuminate\Support\Facades\Http;

class Biznet
{
    public static function identify($base64image)
    {
        $response = Http::withHeaders([
            'Accesstoken' => env('BIZNET_TOKEN'),
        ])->post(env('BIZNET_ENDPOINT') . '/risetai/face-api/facegallery/identify-face', [
            'facegallery_id' => env('BIZNET_FG'),
            'trx_id' => env('BIZNET_TRX'),
            'image' => $base64image,
        ]);

        return $response->json();
    }
}
