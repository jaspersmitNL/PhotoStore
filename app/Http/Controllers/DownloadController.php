<?php

namespace App\Http\Controllers;

use App\Models\Order;

class DownloadController extends Controller {

    function download($id) {
        $order = Order::findOrFail($id);

        if ($order->isPaid && $order->updated_at >= now()->subDays()) {
            return response()->download(storage_path("app/zips/" . $order->id . ".zip"), $order->booking->title . ".zip");
        }

        abort(404);
    }
}
