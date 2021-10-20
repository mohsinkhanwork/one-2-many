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

   <div class="alert alert-success deleted_searched">
    <p></p>
  </div>

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




<form >

 <meta name="csrf-token" content="{{ csrf_token() }}">

<button class="deleteProduct" data-id="{{ $candidate_id->id }}" data-token="{{ csrf_token() }}" >Delete Task</button>
    

    
</form>



             </td> 
        </tr>
 @php $i++; @endphp
@endif
  
</tbody>

</table>



@endif

<script type="text/javascript">

  
$(".deleteProduct").click(function(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$.ajax(
{
    url: "{{'DeleteCandidateID/'. $candidate_id->id}}",
    type: 'delete', // Just delete Latter Capital Is Working Fine
    dataType: "JSON",
    data: {
        "id": id // method and token not needed in data
    },
    success: function (response)
    {
        console.log(response); // see the reponse sent
    },
    error: function(xhr) {
     console.log(xhr.responseText); // this line will save you tons of hours while debugging
    // do something here because of error
   }
});

});


</script>








</x-app-layout>

