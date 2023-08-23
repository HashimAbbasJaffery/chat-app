<!DOCTYPE html>
<html>
    <head>
        <title>Users</title>
    <link rel="stylesheet" href="/style.css" /> 
    </head>
    <body>
        <div id="wrapper">
            <header style="text-align: center; display: flex; justify-content: space-between; align-items: center;">
                <h1>{{ auth()->user()->name }}</h1>
                <div clas="top-buttons">
                    <a href="{{ route("create.group", [ 'user' => auth()->user()->name ]) }}" class="button create-group">Create groups!</a>
                    <a href="{{ route("invitations", [ 'user' => auth()->user()->name ]) }}" class="button create-group">Group Invitations (1)</a>
                
                </div>
            </header>
            <div id="users">
                @foreach ($users as $user)
                    <div class="user" style="margin-bottom: 20px;">
                        <h1>{{ $user->name }}</h1>
                        <a class="button" href="/chatroom/{{ $user->name }}">Message</a>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>