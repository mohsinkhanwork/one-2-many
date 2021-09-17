<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

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

       <form action="{{route('party.update', [$party->id])}}" method="POST" enctype= "multipart/form-data"> @csrf

        @method('PUT')

            <div class="form-group">
                <label>Party Name</label>
                <input type="text" class="form-control" value="{{$party->name}}" name="name">
                 @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>

            <div class="form-group">
                <div>
                    
                    <img src="{{asset('party_logos/'. $party->party_logo)}}" width="125px" height="125">

                </div>

                <label>Change Party Logo</label>

                <input type="file" class="form-control" value="{{$party->party_logo}}" name="party_logo">
                 @error('party_logo')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>

            <input type="submit" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
	
</body>
</html>