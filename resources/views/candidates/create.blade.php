<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Party Dashboard') }}
        </h2>
    </x-slot>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">


 <div class="container mt-5">

        <!-- Success message -->
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif



          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif

       <form action="{{route('candidate.store')}}" method="POST" enctype= "multipart/form-data">

        <input type="hidden" name="party_id" value="{{$party->id}}">
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

        {{-- {{dd(auth()->user()->id)}} --}}


        @csrf

            <div class="form-group">
                <label>Your Name</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label>NIC (National ID Card # )</label>   
                
                <input type="text" class="form-control" name="candidate_id">
            </div>
              @error('party_logo')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                @enderror

            <input type="submit" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
</x-app-layout>