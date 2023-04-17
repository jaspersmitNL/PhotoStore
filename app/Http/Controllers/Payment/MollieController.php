<?php

namespace App\Http\Controllers\Payment;

use App\Jobs\ZipPhotosJob;
use App\Models\Booking;
use App\Models\Order;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller {


    function redirect($id) {
        $booking = Booking::findOrFail($id);
        Booking::


        // Clear the basket
        session()->remove('basket:' . $booking->id);

        return redirect()->route('booking.index', ['id' => $id])->with([
            'ok' => "De bestelling voor boeking $booking->title is nu in behandeling."
        ]);


    }

    function webhook(): string {
        Log::debug('Received mollie webhook!');

        $paymentId = request()->input('id');
        $payment = Mollie::api()->payments()->get($paymentId);

        Log::debug('payment isPaid ' . $payment->isPaid());

        if ($payment->isPaid()) {

            $metadata = $payment->metadata;
            $order_id = $metadata->order_id;


            Order::findOrFail($order_id)->update([
                'isPaid' => $payment->isPaid()
            ]);

            dispatch(new ZipPhotosJob($order_id));
        }


        return "ok";

    }
}
