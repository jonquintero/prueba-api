<?php

namespace App\Http\Controllers;

use App\Helpers\HelperSearch;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    protected $lists = [];

    /**
     * METODO QUE MUESTRA EL LISTADO DE BUSQUEDA
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('search');
    }

    /*
     * METODO QUE REALIZA LA BUSQUEDA
     */
    public function search(Request $request)
    {
         // Valida que el input de busqueda no este vacio
        $rules = [
            'search' => ['required']
        ];

        $request->validate($rules);

        // Crea un intancia de HelperSearch
        $helperSearch = new HelperSearch();

        $helperSearch->searchItunes($request);
        $helperSearch->searchTvShow($request);
        $helperSearch->searchPeople($request);

        return response()->json(
            [
                'success' => true,
                'message' => "Good Search",
                'lists' => $helperSearch->sortArray($helperSearch->result),
            ]
        );

    }

}
