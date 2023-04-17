<?php

namespace App\Http\Livewire\Admin;

use App\Models\Photo;
use Livewire\Component;
use Livewire\WithPagination;


class PhotoTable extends Component {

    use WithPagination;

    public $booking;
    public $search = '';
    public $photosPerPage = 25;
    protected $paginationTheme = 'bootstrap';


    public function perPage($val) {
        $this->photosPerPage = $val;
        $this->resetPage();
    }

    public function render() {
        return view('livewire.admin.photo-table', [
            'photos' => Photo::where([
                ['booking_id', '=', $this->booking->id],
                ['originalFileName', 'like', '%' . $this->search . '%']
            ])->paginate($this->photosPerPage)
        ]);
    }
}
