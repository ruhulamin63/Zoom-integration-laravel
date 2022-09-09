<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <div>
        <a href="{{ route('zoom.create') }}" type="button" class="btn btn-success">Create</a>
    </div>
    <table class="table">
        <br>
        <thead>
        <tr>
            <th>Meeting_Id</th>
            <th>Topic</th>
            <th>Start Time</th>
            <th>Duration</th>
            <th>Password</th>
            <th>Start Url</th>
            <th>Join Url</th>
        </tr>
        </thead>
        <tbody>
            @foreach($zoomData as $data)
                <tr>
                    <td>{{ $data->meeting_id }}</td>
                    <td>{{ $data->topic }}</td>
                    <td>{{ $data->start_time }}</td>
                    <td>{{ $data->duration }}</td>
                    <td>{{ $data->password }}</td>
                    <td>
                        <a href="{{$data->start_url}}" class="btn btn-primary">Start</a>
                    </td>
                    <td>
                        <a href="{{$data->join_url}}" class="btn btn-primary">Join</a>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

</body>
</html>
