<?php

use App\Models\Geocode;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get( '/search', function ( Request $request ) {
    $query = $request->input('query');

    if (strlen($query) < 3 ) {
        return [];
    }

    $searchField = 'place';

    if ( is_numeric( $query ) || (strlen($query) === 3 && is_numeric($query[1]))) {
        $searchField = 'zipcode';
    }

    return Geocode::where( $searchField, 'like', "%$query%" )->orderBy($searchField)->get();
} );
