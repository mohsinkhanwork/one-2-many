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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
<div class="alert" id="message" style="display: none"></div>
       <form  method="post" id="party_create_form"  enctype="multipart/form-data">

        @csrf

            <div class="form-group">
                <label>Party Name</label>
                <input type="text" class="form-control" name="name" >

            </div>

            <div class="form-group">
                <label>Add Party Logo</label>
                <input type="file" class="form-control " name="party_logo">
       
            </div>

            <button type="submit" class="btn btn-dark btn-block"> submit </button>
        </form>
    </div>

<script type="text/javascript">   
$(document).ready(function(){
    $('#party_create_form').on('submit', function(e){
        e.preventDefault();

         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{route('party.store')}}",
            type: "POST",
            data:new FormData(this),
            dataType:'JSON',
            cache: false,
            contentType: false,
            processData: false,        
            success: function(data) {
           
                swal({
                      title: "Good job!",
                      text: "Party Added SuccessFully!",
                      icon: "success",
                      button: "Ok",
                    }).then((willDelete) => {

                        if (willDelete) {
                        window.location = "{{ url('/party') }}";
                    }

                    });
            },
            error: function(data) {

                swal({
                      title: "Sorry..!",
                      text: "The Party name has already been taken",
                      icon: "warning",
                      button: "OK",
                      dangerMode: true,
                    });
            }

        });
    });
});
</script>
	
</x-app-layout>