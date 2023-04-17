@extends('layouts.app')
@section('title', 'Boeking '.$booking->title)
@include('functions')


@section('content')

    @livewire('utils.toast')

    <style>
        .picture-close {
            position: absolute;
            right: 5px;
            top: 5px;
        }

        .sticky-basket {
            font-size: 24px;
            position: fixed;
            z-index: 99;
            right: 50px;
            bottom: 50px;
            width: 60px;
            height: 60px;
            border-radius: 90px;
            background: indigo;
        }

        .sticky-basket a {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 25%;
            color: white !important;
            text-decoration: none;

        }
        .sticky-basket { cursor: pointer; }


    </style>
    <div class="sticky-basket" onclick="window.location.href = '{{route('booking.checkout', ['id' => $booking->id])}}'">
        <a class="bi bi-basket"></a>
    </div>

    <div class="container mt-5">

        @include('components.alert')

        <div class="modal fade mt-sm-5" id="photoModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button type="button" class="btn-close picture-close btn-lg" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    <img src="#" id="previewImage">
                </div>
            </div>
        </div>

        <div class="row g-5" style="margin-bottom: 25px;">
            @foreach($photos['landscape'] as $photo)
                @livewire("user.booking.photo", ['photo' => $photo])
            @endforeach
        </div>

        <div class="row g-5" style="margin-bottom: 25px;">
            @foreach($photos['square'] as $photo)
                @livewire("user.booking.photo", ['photo' => $photo])
            @endforeach
        </div>

        <div class="row g-5" style="margin-bottom: 25px;">
            @foreach($photos['portrait'] as $photo)
                @livewire("user.booking.photo", ['photo' => $photo])
            @endforeach
        </div>

    </div>
@endsection



@section('scripts')
    <script>
        function openModal(id) {
            console.log(`id ${id}`)
            let src = $(`#img-${id}`).attr('src');
            $("#previewImage").attr("src", src);
            let myModal = new bootstrap.Modal(document.getElementById('photoModal'));
            myModal.toggle()
        }
    </script>
@endsection
