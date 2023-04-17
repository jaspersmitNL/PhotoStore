<?php

use App\Models\User;
use Illuminate\Support\Facades\Session;


if (!function_exists('functionBlade')) {

    function isAdmin(): bool {
        return Session::exists('currentUser');
    }

    function currentUser(): ?User {
        return User::find(Session::get('currentUser'));
    }

    function hasBasket(): bool {
        return Session::exists('basket');
    }


    function isInBasket($booking, $id) {

        if ($booking == null || $id == null) {
            return false;
        }

        if (!Session::has('basket:' . $booking)) {
            return false;
        }

        $basket = Session::get('basket:' . $booking);

        if (in_array($id, $basket)) {
            return true;
        }
        return false;
    }

    function getColSize($photo): string {

        switch ($photo->mode) {
            case "landscape":
                return "col-12 col-md-4";
            case "portrait":
                return "col-6 col-md-3";
        }

        return "col-6 col-md-4";
    }


    function functionBlade(): string {
        return "functions.blade.php";
    }

}




