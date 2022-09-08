<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Zoom Add interface</h2>
    <form action="{{ route('zoom.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="start_time">Start Date/Time</label>
            <input type="date" class="form-control" id="start_time" name="start_time">
        </div>
        <div class="form-group">
            <label for="topic">Topic</label>
            <input type="type" class="form-control" id="topic" name="topic">
        </div>
        <div class="form-group">
            <label for="duration">Duration</label>
            <input type=number class="form-control" id="duration" name="duration">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

</body>
</html>
