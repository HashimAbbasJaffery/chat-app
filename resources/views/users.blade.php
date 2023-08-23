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
                    <form action="/userLogout" style="display: inline-block;" method="POST">
                        @csrf
                        <button type="submit" class="button create-group">Logout</button>
                    </form>
                </div>
            </header>
            <div id="users">
                <h3>Users</h3>
                @foreach ($users as $user)
                    <div class="user" style="margin-bottom: 20px;">
                        <h1>{{ $user->name }}</h1>
                        <a class="button" href="/chatroom/{{ $user->name }}">Message</a>
                    </div>
                @endforeach
            </div>
            <div id="groups">
                <h3>Groups</h3>
                @foreach ($groups[0] as $group)
                    <div class="user" style="margin-bottom: 20px;">
                        <h1>{{ $group->group_name }}</h1>
                        <a class="button" href="/groupchatroom/{{ $group->unique_id }}">Message</a>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>