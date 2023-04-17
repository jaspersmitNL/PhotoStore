<?php

namespace App\Jobs;

use App\Mail\OrderDownloadReadyEmail;
use App\Models\Order;
use App\Models\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;

class ZipPhotosJob implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $booking_id;
    protected $order_id;

    /**
     * ZipPhotosJob constructor.
     * @param $order_id
     */
    public function __construct($order_id) {
        $this->order_id = $order_id;
    }

    /**
     * Create a new job instance.
     *
     * @return void
     */


    /**
     * Execute the job.
     *
     * @return void
     * @noinspection PhpComposerExtensionStubsInspection
     */
    public function handle() {
        $order = Order::findOrFail($this->order_id);
        $booking = $order->booking;
        Log::debug('Executing zip job for booking ' . $booking->title);

        Log::debug(gettype($order->photos));

        $zip = new \ZipArchive();
        $zip->open(storage_path("app/zips/" . $order->id . ".zip"), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        foreach (json_decode($order->photos) as $photoID) {
            $photo = Photo::findOrFail($photoID);
            $zip->addFile(storage_path('app/uploads/' . $photo->fileName), $photo->originalFileName);
        }

        $zip->close();

        sleep(2);


        Log::debug('Zip job finished.');

        \Mail::to($order->email)->send(new OrderDownloadReadyEmail($order));

    }
}
