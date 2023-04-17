<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class BasketController extends Controller {


    function add(Request $request) {
        session()->push('basket:' . $request->booking, $request->photo);

        return back()->with(['ok' => 'Item is aan uw winkelwagen toegevoegd.']);

    }

    function remove(Request $request) {
        $basket = session()->get('basket:' . $request->booking);
        $idToRemove = $request->photo;


        if (($key = array_search($idToRemove, $basket)) !== false) {
            unset($basket[$key]);
        }


        session()->put('basket:' . $request->booking, $basket);
        return back()->with(['ok' => 'Item is uit uw winkelwagen gehaald.']);
    }


}
