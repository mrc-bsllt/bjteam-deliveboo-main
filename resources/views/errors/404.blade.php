@extends('layouts.guest')

@section('guest-main')
    <div id="container_404">
        <div id="container_404_img">
            <img src="{{ asset('img/404-not-found.jpg') }}" alt="">
            <div class="container_button_to_home">
                <a href="{{ route('home') }}">Home <i class="fas fa-home"></i></a>
            </div>
        </div>
        <div id="container_404_message">
            <h1>Ops!..</h1>
            <h2>Sembra che ci sia stato un problema, ritorna sulla <a href="{{ route('home')}}">home</a></h2>
        </div>
    </div>
@endsection