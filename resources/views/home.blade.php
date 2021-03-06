@extends('layouts.app')

@section('content')
    @if (Auth::check())
        <nav-component :auth-user="{{Auth::user()}}"></nav-component>
        <div class="container">

           
           
            <div class="card">
               
               
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                </div>
            </div>
            
            <home-component  :auth-user="{{Auth::user()}}"> </home-component>
        </div>
    @else 
            <div class="text-center">
                <h3>You have to be logged</h3>
                <a class="" href="/login">login here</a>
            </div>

    @endif

          
     
       
@endsection
