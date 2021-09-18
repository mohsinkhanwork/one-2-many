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

       <form action="{{route('candidate.store')}}" method="POST" enctype= "multipart/form-data">

        @csrf

            <div class="form-group">
                <label>Candidate Name</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label>Candidate Party Id</label>
                <input type="text" class="form-control" name="candidateId">
            </div>

            <input type="submit" value="Submit" class="btn btn-dark btn-block">
        </form>
    </div>
	
</body>
</html>