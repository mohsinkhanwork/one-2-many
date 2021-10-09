<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Party Dashboard') }}
        </h2>
    </x-slot>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

    <style>
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  width: 456px;
  overflow: auto;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>




	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

@if(auth()->user()->role == 'admin')

	<div style="display: flex;">
<div>
<a class="btn btn-success" href="{{route('party.index')}}"> Main Page </a>
</div>




</div>
	
    <div style="display: flex;">
<div style="width: 50%;text-align: right;margin-right: 10%;">
    <h1>Party Name</h1>
    @isset($candidate_id)
    <p>{{$candidate_id->Party->name}}</p>
    @endisset
</div>


<div style="width: 50%;text-align: left;">
    <h1>Party Logo</h1>
    @isset($candidate_id)
    <p><img src="{{ asset('party_logos/'. $candidate_id->Party->party_logo) }}" alt="image" width="150" height="150"></p>
    @endisset
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
    <th>Candidate Name</th>
    <th>Candidate ID</th>
    <th>Action</th>
    

</thead>
<tbody>
    
    @php $i=1; @endphp
@if($candidate_id != '')
        <tr>
            <td>{{$i}}</td> 
            <td>{{$candidate_id->name}}</td>
            <td>{{$candidate_id->candidate_id}}</td>
            
            <td>


    <form method="POST" action="{{ route('candidate.DeleteCandidateID', ['CanDelID' => $candidate_id->id]) }}">
   @csrf
   {{ method_field('DELETE') }}
   <button type="submit" class="btn btn-primary">Delete candidate</button>
</form>

             </td> 
        </tr>
 @php $i++; @endphp
@endif
  
</tbody>

</table>
</div>




@endif


</x-app-layout>

