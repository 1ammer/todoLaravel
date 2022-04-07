<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @yield('title')
    </title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
</head>

<body>

<nav class="navbar navbar-light bg-light">
    <div class="container">
    @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        <a href="/"><span class="navbar-brand mb-0 h1">Todo</span></a>
        <a href="/create"><span class="btn btn-primary">Create Todo</span></a>
    </div>
</nav>

<div class="container">
@if($current_time_zone=Session::get('current_time_zone'))@endif
<input type="hidden" id="hd_current_time_zone" value="{{{$current_time_zone}}}">
    @yield('content')

</div>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
      if($('#hd_current_time_zone').val() ==""){  
          var current_date = new Date();
          curent_zone =  current_date.getTimezoneOffset();
          console.log(current_date);
          var token = "{{csrf_token()}}";
          $.ajax({
            method: "POST",
            url: "{{URL::to('/setUserTimeZone')}}",
            data: {  '_token':token, curent_zone: curent_zone } 
          }).done(function( data ){
        });   
      }       
});
 
</script>