<div>
    <style>
        .search {
            float: right;
            width: 25%;
        }

    </style>
    <div class="card" style="width: 100%; min-height: 70%">

        <div class="card-header mb1">
            Bestellingen
        </div>
        <div class="card-body table-responsive">

            <input wire:model="search" class="form-control search" type="text" placeholder="Zoeken" width="25%">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Boeking</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Email</th>
                    <th scope="col">Bedrag</th>
                    <th scope="col">Betaald</th>
                    <th scope="col">Mollie ID</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->booking->title}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->email}}</td>
                        <td>€ {{$order->price}}</td>
                        <td>
                            @if(intval($order->price) == 0) <span class="badge bg-secondary">Gratis</span>
                            @elseif($order->isPaid) <span class="badge bg-success">Ja</span>
                            @else
                                <span class="badge bg-danger">Nee</span>
                            @endif
                        </td>
                        <td>{{$order->mollie_payment_id ? :'geen'}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

