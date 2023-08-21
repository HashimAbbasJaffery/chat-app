<!DOCTYPE html>
<html>
    <head>
        <title>Users</title>
    <link rel="stylesheet" href="/style.css" /> 
    </head>
    <body>
        <div id="wrapper">
            <header style="text-align: center;">
                <h1>{{ auth()->user()->name }}</h1>
            </header>
            <div id="users">
                @foreach ($users as $user)
                    <div class="user" style="margin-bottom: 20px;">
                        <h1>{{ $user->name }}</h1>
                        <a href="/chatroom/{{ $user->name }}">Message</a>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>