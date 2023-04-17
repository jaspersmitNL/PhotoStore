<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Jobs\ZipPhotosJob;
use App\Mail\OrderConfirmEmail;
use App\Models\Booking;
use App\Models\Order;
use App\Models\Photo;
use Mollie\Laravel\Facades\Mollie;

function totalPrice(Booking $booking, $basket) {

    if (count($basket) > $booking->numof_free_photos) {

        return count($basket) * $booking->price_per_photo;
    }

    return 0;
}

function discount(Booking $booking, $basket) {

    if (count($basket) < $booking->numof_free_photos) {
        return count($basket) * $booking->price_per_photo;
    }

    return $booking->numof_free_photos * $booking->price_per_photo;
}

function usedFreePhotos(Booking $booking, $basket) {
    if (count($basket) < $booking->numof_free_photos) {
        return count($basket);
    }
    return $booking->numof_free_photos;
}


function getTotalCostMinusDiscount($total, $discount) {

    if ($total != 0) {
        return $total - $discount;
    }
    return $total;

}

class CheckoutController extends Controller {
    function checkout($id) {
        $basket = [];
        if (session()->has('basket:' . $id)) {
            $basket = session()->get('basket:' . $id);
        }

        if (count($basket) < 1) {
            return redirect()->route('booking.index', ['id' => $id]);
        }


        $photos = [];

        foreach ($basket as $itemID) {
            $photos[$itemID] = Photo::findOrFail($itemID);
        }


        $booking = Booking::findOrFail($id);
        return view('user.booking.checkout.index', [
            'booking' => $booking,
            'basket' => $basket,
            'photos' => $photos,
            'total_price' => getTotalCostMinusDiscount(totalPrice($booking, $basket), discount($booking, $basket)),
            'discount' => discount($booking, $basket),
            'used_free_photos' => usedFreePhotos($booking, $basket)
        ]);
    }


    function submitForm($id) {
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        $booking = Booking::findOrFail($id);

        $basket = [];
        if (session()->has('basket:' . $id)) {
            $basket = session()->get('basket:' . $id);
        }

        if (count($basket) < 1) {
            return redirect()->route('booking.index', ['id' => $booking->id]);
        }

        $price = sprintf("%.2f", getTotalCostMinusDiscount(totalPrice($booking, $basket), discount($booking, $basket)));;


        // Update the left free photos in the booking
        $booking->numof_free_photos = $booking->numof_free_photos - usedFreePhotos($booking, $basket);
        $booking->save();

        // Create the Order
        $order = Order::create([
            'booking_id' => $booking->id,
            'price' => $price,
            'email' => request()->email,
            'first_name' => request()->first_name,
            'last_name' => request()->last_name,
            'isPaid' => $price == 0,
            'photos' => json_encode($basket)
        ]);


        if ($order->isPaid) {
            // Dispatch the job for a free order before payment.
            $this->dispatch(new ZipPhotosJob($order->id));
            return redirect()->route('mollie.redirect', ['id' => $id]);
        }


        $url = config('app.url');

        if(str_ends_with($url, "/")) {
            $url = substr($url, 0, -1);
        }

        $url = $url."/mollie/webhook";

        // Create the payment
        $payment = Mollie::api()->payments()->create([
            "amount" => [
                "currency" => "EUR",
                "value" => $price
            ],
            "description" => "Bestelling #" . $order->id,
            "redirectUrl" => route('mollie.redirect', ['id' => $id]),
            "webhookUrl" => $url,
            "metadata" => [
                "booking_id" => $booking->id,
                "order_id" => $order->id
            ],
        ]);

        // Sets the mollie payment payment id
        $order->mollie_payment_id = $payment->id;
        $order->save();

        // Send the confirm email
        \Mail::to($order->email)
            ->send(new OrderConfirmEmail($order));

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);

    }
}
