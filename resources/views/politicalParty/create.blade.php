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

     

          @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif

       <form action="{{route('party.store')}}" method="POST" enctype= "multipart/form-data">

        @csrf

            <div class="form-group">
                <label>Party Name</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
            </div>

            <div class="form-group">
                <label>Add Party Logo</label>
                <input type="file" class="form-control @error('party_logo') is-invalid @enderror" name="party_logo">
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