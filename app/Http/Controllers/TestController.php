<?php

namespace App\Http\Controllers;

class TestController extends Controller {
    public function index() {
        return view('test');
    }


    public function upload() {
        $request = request();

        $request = request();

        $files = $request->file('file');

        \Log::debug($files);
    }
}
