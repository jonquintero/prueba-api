<?php


namespace App\Traits;


use Illuminate\Support\Facades\Http;

trait ConsumeExternalServices
{

    /**
     * METODO QUE PERMITE LA CONEXION A LOS DIFERENTES SERVICIOS
     * @param $baseUri
     * @param array $queryParams
     * @return \Illuminate\Http\Client\Response
     */
    public function makeRequest ($baseUri, $queryParams = [])
    {
        return Http::get($baseUri, $queryParams);
    }
}
