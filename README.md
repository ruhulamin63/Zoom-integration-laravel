# Laravel Zoom
### Using this domo project

```bash
git clone https://github.com/ruhulamin63/Zoom-integration-laravel.git
```
```bash
composer install
```
```bash
cp .env.example .env
```
```bash
php artisan key:generate
```
#### create database and change .env file DB_DATABASE=laravel to DB_DATABASE=xxx
```bash
php artisan migate:fresh --seed
```
## Zoom JWT Setup

Login zoom account
```bash
https://www.zoom.us/
```

Goto zoom marketplace & create App credentials then goto here JWT option
```bash
https://marketplace.zoom.us/develop/create
```
## Or

Goto create app credentials and copy (API Key) & (API Secret) insert into <br>
You need to add ZOOM_CLIENT_KEY and ZOOM_CLIENT_SECRET insert into your .env file.

```bash
https://marketplace.zoom.us/develop/apps/idw-K0NASLmpKlm9ldj17w/credentials
```

### ==================== Enjoy git project ==================

## On the other hand laravel Zoom API Client New Setup
Laravel Zoom API Package

## Installation

```bash
composer create-project --prefer-dist laravel/laravel:^8 zoom-project
```

You can install the package via composer:

```bash
composer require macsidigital/laravel-zoom
```

### Configuration file

Publish the configuration file

```bash
php artisan vendor:publish --provider="MacsiDigital\Zoom\Providers\ZoomServiceProvider"
```

This will create a zoom.php config file within your config directory:-

```php
return [
    'apiKey' => env('ZOOM_CLIENT_KEY'),
    'apiSecret' => env('ZOOM_CLIENT_SECRET'),
    'baseUrl' => 'https://api.zoom.us/v2/',
    'token_life' => 60 * 60 * 24 * 7, // In seconds, default 1 week
    'authentication_method' => 'jwt', // Only jwt compatible at present
    'max_api_calls_per_request' => '5' // how many times can we hit the api to return results for an all() request
];
```

You need to add ZOOM_CLIENT_KEY and ZOOM_CLIENT_SECRET into your .env file.

Also note the tokenLife, there were numerous users of the old API who said the token expired to quickly, so we have set for a longer lifeTime by default and more importantly made it customisable.

That should be it.

## Zoom JWT Setup

Login zoom account
```bash
https://www.zoom.us/
```

Goto zoom marketplace & create App credentials then goto here JWT option
```bash
https://marketplace.zoom.us/develop/create
```
## Or

Goto create app credentials and copy (API Key) & (API Secret) insert into <br>
You need to add ZOOM_CLIENT_KEY and ZOOM_CLIENT_SECRET into your .env file.

```bash
https://marketplace.zoom.us/develop/apps/idw-K0NASLmpKlm9ldj17w/credentials
```

### Create view index.blade.php file
```php
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

```
### Create add.blade.php file
```php
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
            <input type="datetime-local" class="form-control" id="start_time" name="start_time">
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

```

### Create Controllers

```bash
php artisan make:controller zoom/ZoomController
```

### How to create function insert into app/Http Traits folders MeetingZoomTrait.php class
```php
 public function createMeeting($request){
        $user = Zoom::user()->first();

        $meetingData = [
            'topic' => $request->topic,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_time' => $request->start_time,
            //'timezone' => config('zoom.timezone'),
            'timezone' => 'Asia/Dhaka',
        ];

        $meeting = Zoom::meeting()->make($meetingData);

        $meeting->settings()->make([
           'join_before_host'=> false,
           'host_video'=> false,
           'participant_video'=> false,
           'mute_upon_entry'=> true,
           'waiting_room'=> true,
           'approval_type'=> config('zoom.approval_type'),
           'audio'=> config('zoom.audio'),
           'auto_recording'=> config('zoom.auto_recording'),
        ]);

        return $user->meetings()->save($meeting);
    }
```

### insert function into controller
```php
class ZoomController extends Controller
{
    use MeetingZoomTrait;
    
    public function index()
    {
        $zoomData = Test::all();
        return view('zoom', compact('zoomData'));
    }
    
    public function create()
    {
        return view('add_zoom');
    }
    
    public function store(Request $request)
    {
        try{
            //return response()->json($request->all());

            $meeting = $this->createMeeting($request);

            //dd('test');

            Test::create([
                'user_id'=> 1,
                'meeting_id'=> $meeting->id,
                'topic'=> $request->topic,
                'start_time'=> $request->start_time,
                'duration'=> $meeting->duration,
                'password'=> $meeting->password,
                'start_url'=> $meeting->start_url,
                'join_url'=> $meeting->join_url,
            ]);

            return redirect()->route('zoom.index');
        } catch (\Exception $e){
            //dd('error');

            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
```
### Create route
```php
Route::get('/zoom', [ZoomController::class, 'index'])->name('zoom.index');
Route::get('/create-zoom', [ZoomController::class, 'create'])->name('zoom.create');
Route::post('/store-zoom', [ZoomController::class, 'store'])->name('zoom.store');
```
#### ========================== Enjoy coding =====================

### Reference gitHub link
```bash
https://github.com/MacsiDigital/laravel-zoom
```

*** Copyright@reserved by [**rahridoy.com**](https://rahridoy.com/) ***
