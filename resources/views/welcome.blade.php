
@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row text-center">
        {{-- @if (Route::has('login'))
        <div class="">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endif
        </div>
        @endif --}}

         
                <h2 class="text-info text-center">Welcome in messanger</h2>
                 @if (Route::has('login'))
     
                
           

    </div>  
    <div class="row">
        <div class="">
            @auth
                <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endif
        </div>
        @endif
    </div>
     
</div>
@endsection