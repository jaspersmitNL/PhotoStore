<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class OrderTable extends Component {

    public $search = '';

    public function render() {
        $orders = Order
            ::where('email', 'like', '%' . $this->search . '%')
            ->orWhere('created_at', 'like', '%' . $this->search . '%')
            ->orWhere('mollie_payment_id', 'like', '%' . $this->search . '%')
            ->orWhereHas('booking', function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%');
            })
            ->with('booking')
            ->get()->all();

        return view('livewire.admin.order-table', [
            'orders' => $orders
        ]);
    }
}
