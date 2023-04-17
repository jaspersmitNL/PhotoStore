@include('functions')
@php $inBasket = isInBasket($photo->booking->id, $photo->id); @endphp

<div class="col {{getColSize($photo)}}">
    <div class="card shadow-sm" @if(isInBasket($booking->id, $photo->id))  style="border-color: green; border-style: solid;" @endif>
        <img src="{{$photo->toWatermarkedSRC()}}" class="bd-placeholder-img card-img-top"
             id="img-{{$photo->id}}" onclick="openModal('{{$photo->id}}');">

        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">

{{--                @livewire('user.booking.add-to-card', ['photo' => $photo])--}}

                <div>

                    <button  wire:click="addToCard" class="btn {{$inBasket  ? 'btn-outline-success' : 'btn-outline-secondary'}}">

                        <i class="bi bi-{{$inBasket ? 'check' : 'plus'}}"></i>

                        <i class="bi bi-cart4" style="color: {{$inBasket ? 'green' : 'black'}}"></i>
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>
