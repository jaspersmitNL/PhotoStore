<div>
    <style>
        .search {
            float: right;
            width: 25%;
        }

    </style>
    <div class="card" style="width: 100%; min-height: 70%">

        <div class="card-header mb1">
            Boekingen
        </div>
        <div class="card-body table-responsive">

            <input wire:model="search" class="form-control search" type="text" placeholder="Zoeken" width="25%">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Naam</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Acties</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td style="width: 40%">
                            {{$booking->title}}
                        </td>
                        <td style="width: 33%">
                            {{$booking->date}}
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdown{{explode('-', $booking->id)[0]}}"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    Acties
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdown{{explode('-', $booking->id)[0]}}">
                                    <li><a class="dropdown-item"
                                           href="{{route('admin.booking.photo.index', ['id' => $booking->id])}}">Fotos</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                           href="{{route('booking.index', ['id' => $booking->id])}}">Klant</a></li>
                                    <li><a class="dropdown-item"
                                           href="{{route('admin.booking.edit', ['id' => $booking->id])}}">Bewerk</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

