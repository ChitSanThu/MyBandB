
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>print</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<table class="table table-bordered table-sm table-info">
    <caption>Daily Check In List</caption>
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col"> Number</th>
        <th scope="col">Name</th>
        <th scope="col">Father</th>
        <th scope="col">Nrc</th>
        <th scope="col">Age</th>
        <th scope="col">Gender</th>
        <th scope="col">Nation</th>
        <th scope="col">Address</th>
        <th scope="col">Job</th>
    </tr>
    </thead>
    <tbody>
    @foreach($guests as $guest)
        <tr>
            <th scope="row">{{$guest->id}}</th>
            <td>{{$guest->room_number}}</td>
            <td>{{$guest->name}}</td>
            <td>{{$guest->father_name}}</td>
            <td>{{$guest->nrc}}</td>
            <td>{{$guest->age}}</td>
            <td>{{$guest->gender}}</td>
            <td>{{$guest->nation}}</td>
            <td>{{$guest->state}}</td>
            <td>{{$guest->job}}</td>


        </tr>
    @endforeach
    </tbody>
</table>
<script>
    window.print();
</script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
