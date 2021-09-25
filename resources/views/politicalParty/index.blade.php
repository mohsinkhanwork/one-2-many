<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Party Dashboard') }}
        </h2>
    </x-slot>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Political Parties</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



<div style="display: flex;">
<div>
<a class="btn btn-success" href="{{route('party.create')}}"> Add Party </a>

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
            <td><a class="btn btn-primary" href="{{route('candidate.index', [$party->id])}}"> Show Candidates </a></td>
            <td>

            <form action="{{ route('party.destroy', [$party->id])}}" method="POST">@csrf
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

</x-app-layout>