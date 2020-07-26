<?php


namespace App\Helpers;


use App\Traits\ConsumeExternalServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HelperSearch
{
    public $result = [];
    use ConsumeExternalServices;

    /**
     * METODO QUE HACE LA BUSQUEDA EN EL SERVICIO DE ITUNES
     * @param Request $request
     */
    public function searchItunes(Request $request): void
    {
        $responseMusic = $this->makeRequest(
            config('services.itunes.base_uri'),
            [
                'term' => $request->search,
                'media' => config('services.itunes.music'),

            ]
        );

        $responseMovies = $this->makeRequest(
            config('services.itunes.base_uri'),
            [
                'term' => $request->search,
                'media' => config('services.itunes.movies'),

            ]
        );

        $responseEbook = $this->makeRequest(
            config('services.itunes.base_uri'),
            [
                'term' => $request->search,
                'media' => config('services.itunes.ebook'),

            ]
        );

        $responses = json_decode($responseMusic);
        $this->formatResponseItunesSearch($responses);

        $responses = json_decode($responseMovies);
        $this->formatResponseItunesSearch($responses);

        $responses = json_decode($responseEbook);
        $this->formatResponseItunesSearch($responses);
    }

    /**
     * METODO QUE FORMATEA EL RESULTADO OBTENIDO DEL SERVICIO DE ITUNES
     * @param $responses
     */
    public function formatResponseItunesSearch($responses): void
    {
        foreach ($responses as $response => $value) {
            if ($response == 'results') {
                foreach ($value as $key) {
                    $this->result[] = [
                        'name' => $key->{'artistName'},
                        'category' => $key->{'kind'},
                        'collection' => $key->{'trackName'},
                        'find' => 'https://www.apple.com/v/itunes/home/k/images/overview/itunes_logo__dwjkvx332d0m_large.png'
                    ];
                }
            }
        }
    }


    /**
     * METODO QUE REALIZA LA BUSQUEDA EN TV SHOW
     * @param Request $request
     */
    public function searchTvShow(Request $request): void
    {
        $responseTvShows = $this->makeRequest(
            config('services.tvmaze.base_uri'),
            [
                'q' => $request->search,
            ]
        );

        $responses = json_decode($responseTvShows);
        $this->formatResponseTvShowSearch($responses);
    }

    /**
     * METODO QUE FORMATEA EL RESULTADO DE LA BUSQUEDA DE TV SHOW
     * @param $responses
     */
    public function formatResponseTvShowSearch($responses): void
    {
        foreach ($responses as $response => $value) {
            foreach ($value as $key => $val) {
                if ($key == 'show') {
                    $this->result[] = [
                        'name' => $val->{'name'},
                        'category' => 'tv-show',
                        'collection' => $val->{'name'},
                        'find' => 'https://www.showtv.com.tr/assets/v2/images/desktop/logo/showtv.svg'
                    ];
                }
            }
        }
    }

    /**
     * METODO QUE REALIZA LA BUSQUEDA DE PERSONAS
     * @param  $request
     */
    public function searchPeople(Request $request): void
    {
        $respon = Http::get(
            config('services.searchpeople.base_uri'),
            [
                'soap_method' => config('services.searchpeople.soap_method'),
                'name' => $request->search,
            ]
        );

        $this->formatResponseSearchPeople($respon);
    }

    /**
     * METODO QUE FORMATEA LA RESPUESTA XML DEL SERVICIO SOAP CREANDO UN NUEVO DOMDOCUMENT PARA EXTRAER
     * LOS ELEMENTOS NECESARIOS QUE SERAN MOSTRADOS EN EL RESULTADO DE BUSQUEDA
     * @param \Illuminate\Http\Client\Response $respon
     */
    public function formatResponseSearchPeople(\Illuminate\Http\Client\Response $respon): void
    {
        $doc = new \DOMDocument('1.0', 'utf-8');
        $doc->loadXML($respon);
        $XMLresults = $doc->getElementsByTagName("Name");

        if (count($XMLresults) > 0) {
            for ($i = 0; $i < count($XMLresults); $i++) {
                $this->result[] = [
                    'name' => $XMLresults->item($i)->nodeValue,
                    'category' => 'people',
                    'collection' => $XMLresults->item($i)->nodeValue,
                    'find' => 'https://thumbs.dreamstime.com/z/elemento-del-dise%C3%B1o-de-pin-location-people-icon-logo-97028649.jpg'
                ];
            }
        }


    }

    /**
     * METODO QUE ORDENA ALFABETICAMENTE POR NOMBRE, EL ARREGLO DE RESULTADO DE LA BUSQUEDA
     * @param $array
     * @return mixed
     */
    public function sortArray($array) {

        if (count($array)) {
            array_multisort(array_map(function($element) {
                return $element['name'];
            }, $array), SORT_ASC, $array);
        }

        return $array;
    }

}
