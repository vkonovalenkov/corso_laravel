@extends('templates.default')
@section('title','Blog')
@section('content')
    <h1>blog</h1>
    @component('components.card',
    [
        'img_title'=>  'Image Blog',
        'img_url' => 'http://lorempixel.com/400/200'
    ]
    )
<p>This is a good image i took in New York</p>
    @endcomponent


    @component('components.card')
        @slot('img_url','http://lorempixel.com/400/200')
        @slot('img_title','Second Image')
        <p>This is a good image and i  took it in Panama</p>
    @endcomponent
@endsection
    @include('components.card',
    [
        'img_title'=>  'Image Blog Include',
        'img_url' => 'http://lorempixel.com/400/200'
    ])
@section('footer')
    @parent
@endsection
