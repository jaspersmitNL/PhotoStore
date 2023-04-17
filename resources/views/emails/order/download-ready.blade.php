{{--@formatter:off--}}
@php $link = route('download', ['id'=> $order->id]); @endphp
@component('mail::message')
# Download van order #{{$order->id}}

@component('mail::button', ['url' => $link])
Download fotos
@endcomponent


<a href="{{$link}}">{{$link}}</a>
<br>
Dankjewel,<br>
{{ config('app.name') }}
@endcomponent
{{--@formatter:on--}}
