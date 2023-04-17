<?php

namespace App\Http\Livewire\User\Booking;

use Livewire\Component;


function isInBasket($booking, $id) {

    if ($booking == null || $id == null) {
        return false;
    }

    if (!session()->has('basket:' . $booking)) {
        return false;
    }

    $basket = session()->get('basket:' . $booking);

    if (in_array($id, $basket)) {
        return true;
    }
    return false;
}

class Photo extends Component {

    public $photo;
    public $booking;



    public function mount() {
        $this->booking = $this->photo->booking;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render() {
        return view('livewire.user.booking.photo');
    }

    public function addToCard() {

        $photo = $this->photo;
        $booking = $photo->booking;



        if (!isInBasket($booking->id, $photo->id)) {
            session()->push('basket:' . $booking->id, $photo->id);
            $this->dispatchBrowserEvent('toast', 'Foto is aan uw winkelwagen toegevoegd.');
        } else {
            $basket = session()->get('basket:' . $booking->id);

            if (($key = array_search($photo->id, $basket)) !== false) {
                unset($basket[$key]);
            }

            session()->put('basket:' . $booking->id, $basket);

            $this->dispatchBrowserEvent('toast', 'Foto is uit uw winkelwagen verwijderd.');

        }

    }
}
