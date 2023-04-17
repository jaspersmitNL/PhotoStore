<div>
    <style>
        .search {
            float: right;
            width: 25%;
        }

    </style>
    <div class="card" style="width: 100%; min-height: 70%">

        <div class="card-header mb1">
            Fotos
        </div>
        <div class="card-body table-responsive">

            <input wire:model="search" class="form-control search" type="text" placeholder="Zoeken" width="25%">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">Preview</th>
                    <th scope="col">Boeking</th>
                    <th scope="col">Bestand</th>
                    <th scope="col">Acties</th>
                </tr>
                </thead>
                <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <th><img width="100" height="100" src="{{$photo->toWatermarkedSRC()}}" alt=""></th>
                        <th scope="row">{{$photo->booking->title}}</th>
                        <th scope="row">{{$photo->originalFileName}}</th>
                        <th>
                            <div class="dropdown">
                                <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdown{{explode('-', $photo->id)[0]}}"
                                   data-bs-toggle="dropdown" aria-expanded="false">
                                    Acties
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdown{{explode('-', $photo->id)[0]}}">
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{route('admin.booking.photo.delete', ['id' => $photo->id])}}">Verwijder</a>
                                    </li>
                                </ul>
                            </div>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


   <div class="mt-3">
       {{$photos->links()}}
   </div>

    <div class="mb-5">
        Fotos per pagina:
        <select wire:change="perPage($event.target.value)" class="form-select" aria-label="Default select example" style="width: 10%">
            <option value="10" selected>10</option>
            <option value="25">25</option>
            <option value="100">100</option>
            <option value="1000">1000</option>
        </select>
    </div>


</div>
