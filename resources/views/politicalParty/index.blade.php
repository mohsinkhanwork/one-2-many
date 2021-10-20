<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Party Dashboard') }}
        </h2>
    </x-slot>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Political Parties</title>
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

.dropdown .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background-color: red;
  color: white;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {
    background-color: #ddd;
}

.show {
    display: block;
}
</style>

 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@if(auth()->user()->role == 'admin')

<div style="display: flex;">
<div>
<a class="btn btn-success" href="{{route('party.create')}}"> Add Party </a>

</div>

<div style="margin-left: auto; margin-right: 20% ;">

<div class="dropdown">

  <button onclick="myFunction()" class="dropbtn">
  Notifications
  @if($candidate_delete_request_Noti)

    <span class="badge"> {{count($candidate_delete_request_Noti)}} </span>

  @elseif($candidate_delete_request_Noti == '')

  
  @endif

  </button>

  <div id="myDropdown" class="dropdown-content">
 @if($candidate_delete_request_Noti != '')
  @foreach($candidate_delete_request_Noti as $key => $deleteRequest)
    <a href="{{ url('/candidateIndex/'. $deleteRequest->party_id)}}" target="_blank"> 
        {{-- {{$key}} --}}
        {{-- {{$deleteRequest->delete_request}} --}}
        {{-- {{$deleteRequest->candidate_id}} --}}
        Delete Candidate Request for <b>{{$deleteRequest->Party->name}}</b>  Party.
    </a>
    
@endforeach
@endif

  </div>


</div>




</div>



</div>

@if( Session::has('success'))
  <div class="alert alert-success">
    <p>{{ Session::get('success') }}</p>
  </div>
@endif


<table class="table table-sm">



<thead>
    <th>Party Name</th>
    <th>Party Logo</th>
    <th>Candidates</th>
    <th>Action</th>


</thead>
<tbody>

    @foreach($parties as $party)
        <tr>
            <td>{{$party->name}}</td>
            <td><img src="{{ asset('party_logo/'. $party->party_logo) }}" alt="image" width="100" height="100"></td>
            <td>
                <a class="btn btn-primary" href="{{route('candidate.can_index', [$party->id])}}"> Show Candidates </a>

            </td>
            <td>

            <form id="party_form_delete" action="{{ route('party.destroy', [$party->id])}}" method="POST">@csrf
                @method('DELETE')
                <a href="{{ route('party.edit', [$party->id])}}"><i class="fas fa-edit"></i></a>
                <a href="{{ route('party.show', [$party->id])}}"><i class="fas fa-eye"></i></a>

             <button type="submit" title="delete" style="border: none; background-color:transparent;">

                <i class="fas fa-trash fa-lg text-danger"></i>

            </button>


            </form>


             </td>
        </tr>
    @endforeach

</tbody>

</table>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

@elseif(auth()->user()->role == 'candidate')


<div style="display: flex;">


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

@if( Session::has('success'))
  <div class="alert alert-success">
    <p>{{ Session::get('success') }}</p>
  </div>
  @endif

<table class="table table-sm">



<thead>
    <th>Party Name</th>
    <th>Party Logo</th>
    <th>Candidates</th>
    <th>Action</th>


</thead>
<tbody>

    @foreach($parties as $party)
        <tr>
            <td>{{$party->name}}</td>
            <td><img src="{{ asset('party_logos/'. $party->party_logo) }}" alt="image" width="100" height="100"></td>
            <td><a class="btn btn-primary" href="{{route('candidate.can_index', [$party->id])}}"> Cast Vote </a></td>
            <td>

                <a href="{{ route('party.show', [$party->id])}}"><i class="fas fa-eye"></i></a>

            


             </td>
        </tr>
    @endforeach

</tbody>

</table>


@endif




</x-app-layout>
