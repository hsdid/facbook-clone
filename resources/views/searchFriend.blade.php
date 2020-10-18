@extends('layouts.app')

@section('content')
<div class="container">
    
            {{-- <div class="card ">
                <div class="card-header"></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   
                    
                </div>
            </div> --}}
            
       <searchfriend-component :auth-user="{{Auth::user()}}"> </searchfriend-component>
       
     
</div>
@endsection
