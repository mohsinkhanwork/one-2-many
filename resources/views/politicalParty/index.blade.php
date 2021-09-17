<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Political Parties</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<a class="btn btn-primary" href="{{route('party.create')}}"> Add Party </a>
<a class="btn btn-primary" href="{{route('candidate.create')}}"> Add Candidates </a>

<div>
       <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
</div>

<table class="table table-sm">


@if(Session::has('msg'))
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            <strong>Congratulations!</strong> {!!Session::get('msg')!!}
        </div>
    @endif


<thead>
    <th>Party Name</th>
    <th>Party Logo</th>
    <th>Action</th>
    

</thead>
<tbody>
    
    @foreach($parties as $party)
        <tr>
            <td>{{$party->name}}</td> 
            <td><img src="{{ asset('party_logos/'. $party->party_logo) }}" alt="image" width="100" height="100"></td>
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




    
</body>
</html>