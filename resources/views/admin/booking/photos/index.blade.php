@extends('layouts.admin')
@section('title', "Admin - Boeking ". $booking->title. " Fotos")

@section('head')
    <script src="{{asset('js/dropzone.js')}}"></script>
    <link rel="stylesheet" href="{{asset('/css/dropzone.css')}}">
@endsection


<style>
    .my-dropzone-col {
        max-height: 45%;
        overflow-y: scroll;
    }
</style>

@section('admin-content')


    <div class="container">

        @include('components.alert')

        <h1>Fotos beheren van boeking {{$booking->title}}</h1>
        <div class="mt-5 col col-sm-12 my-dropzone-col">

            <form action="{{route('admin.booking.photo.upload', ['id' => $booking->id])}}" method="post"
                  class="dropzone" id="my-dropzone">
                @csrf

                <div class="fallback">
                    <input name="file" type="file" multiple accept="image/*"/>
                </div>

            </form>
        </div>

        @livewire('admin.photo-table', ['booking' => $booking])

    </div>

@endsection

@section('scripts')
    <script>
        Dropzone.autoDiscover = false;
        const notyf = new Notyf({
            position: {x: 'right', y: 'top'},
            dismissible: true
        });


        $(function () {
            // Now that the DOM is fully loaded, create the dropzone, and setup the
            // event listeners
            const myDropzone = new Dropzone("#my-dropzone", {
                acceptedFiles: 'image/*',
                timeout: 10000000000,
                dictDefaultMessage: 'Sleep fotos hier om ze te uploaden.',
                autoProcessQueue: true,
                parallelUploads: 10,
            });

            myDropzone.on('queuecomplete', function () {
                notyf.success('Upload is successvol, de pagina word herladen...');
                setTimeout(()=> {
                    window.location.reload(true);
                }, 1000)
            })
        })
    </script>
@endsection
