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
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<div style="display: flex;">
<div>
<a class="btn btn-success" href="{{route('candidate.CreateCandidate', [$party->id])}}"> Add Candidate in this party </a>
<a class="btn btn-success" href="{{route('party.index')}}"> Main Page </a>

</div>

<div style="margin-left: auto; margin-right: 0 ;">

       <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                   <div class="btn btn-danger"> {{ __('Log Out') }}</div>
                                </x-jet-dropdown-link>
            </form>
</div>
</div>
	
	
<div style="display: flex;">
<div style="width: 50%;text-align: right;margin-right: 10%;">
	<h1>Party Name</h1>
	<p>{{$party->name}}</p>
</div>


<div style="width: 50%;text-align: left;">
	<h1>Party Logo</h1>
	<p><img src="{{ asset('party_logos/'. $party->party_logo) }}" alt="image" width="150" height="150"></p>
</div>
</div>
@if( Session::has('success'))
  <div class="alert alert-success">
    <p>{{ Session::get('success') }}</p>
  </div>
  @endif

<table class="table table-sm">



<thead>
    <th>#</th>
    <th>Candidates</th>
    <th>Candidate ID</th>
    <th>Action</th>
    

</thead>
<tbody>
    
    @php $i=1; @endphp
@foreach($candidates as $candidate)
        <tr>
            <td>{{$i}}</td> 
            <td>{{$candidate->name}}</td>
            <td>{{$candidate->candidate_id}}</td>
            
            <td>

            <form action="{{ route('candidate.destroy', [$candidate->id])}}" method="POST">@csrf
                @method('DELETE')
                <a href="{{ route('candidate.edit', [$candidate->id, $party->id])}}"><i class="fas fa-edit"></i></a>
                <a href="{{ route('candidate.show', [$candidate->id])}}"><i class="fas fa-eye"></i></a>

             <button type="submit" title="delete" style="border: none; background-color:transparent;">
                <i class="fas fa-trash fa-lg text-danger"></i>

            </button>
                

            </form>


             </td> 
        </tr>
 @php $i++; @endphp
@endforeach
  
</tbody>

</table>

</div>
</x-app-layout>

