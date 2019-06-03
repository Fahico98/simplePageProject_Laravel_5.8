
@extends('layouts.mainTemplate')

@section('title')
    @if ($userName != "")
        {{ $userName }} profile
    @else
        Profile page
    @endif
@endsection

@section('bodyContent')
    <h2 style="color: rgb(30, 30, 170); font-family: 'Dosis', sans-serif;" class="text-center">
        @if ($userId != 0)
            @if ($userName != "")
                This is the {{ $userName }}'s page, {{ $userId }} is its User Id...!
            @else
                This is the page with User Id {{ $userId }}...!
            @endif
        @else
            This is a no User Id page...!
        @endif
    </h2>
@endsection
