<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
@if(auth()->user()->role == 'user')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
               {{--  <x-jet-welcome /> --}}
                Welcome User
            </div>
        </div>
    </div>
 @elseif(auth()->user()->role == 'admin')
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

                <div class="row" style="margin-top: 1%;">
                    <div class="col-md-2 col-12">

                    </div>
                    <div class="col-md-8 col-12">
                    <a href="{{route('party.index')}}" class="btn btn-primary" target="_blank">Party Project</a>
                    <br>
                    <br>
                        <a href="{{ route('api.index') }}" class="btn btn-primary" target="_blank">Laravel API</a>
                    </div>




                </div>

@elseif(auth()->user()->role == 'candidate')
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <div class="row" style="margin-top: 1%;">
                    <div class="col-md-2 col-12">

                    </div>
                    <div class="col-md-8 col-12">
                    <a href="{{route('party.index')}}" class="btn btn-primary" target="_blank">Cast Vote</a>
                 
                        
                    </div>




                </div>

@endif




</x-app-layout>
