<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IceAndFireController extends Controller
{
    public function getBooks()
    {
        $response = Http::get('https://www.anapioficeandfire.com/api/books');
   
        $jsonData = $response->json();

        return response()->json([
            "data" => $jsonData,
        ], 200);
         
        // dd($jsonData);

    }

    
}
