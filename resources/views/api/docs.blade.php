
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


<div>

<ul>
    <li>
            Create api routes or go to api routes. or click below <br>
            <details>
                <div>
                    Route::get('/party', function () {

                        return Party::all();

                        });

                        Route::post('/party', function () {

                                return Party::create([
                                    'name' => 'PTI',
                                    'party_logo' => 'BAT'
                                ]);
                        });

                </div>
            </details>
    </li>

    <li>
            link for get and post (postman) <br>
            a. <a href="http://localhost:8000/api/party"> GET Request</a> <br>
            b. <a href="http://localhost:8000/api/party"> POST Request</a>

    </li>
</ul>

</div>




</body>
</html>


