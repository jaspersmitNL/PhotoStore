<?php

namespace App\Http\Livewire\Admin;

use App\Models\Booking;
use Livewire\Component;

class BookingTable extends Component {

    public $bookings = [];

    public $search = '';


    public function render() {

        $this->bookings = Booking::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('date', 'like', '%' . $this->search . '%')
            ->get()->all();

        return view('livewire.admin.booking-table', ['bookings' => $this->bookings]);
    }

    public function increment() {
        $this->counter++;
    }
}
