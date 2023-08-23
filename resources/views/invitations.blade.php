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
                @foreach ($groups[0] as $group)
                    <div class="user" style="margin-bottom: 20px;">
                        <h1>{{ $group->group_name }}</h1>
                        <div clas="top-buttons">
                            <form method="POST" style="display: inline-block;" name="accept" id="accept" action="{{ route('accept', [ 'group' => $group->unique_id ]) }}">
                                {{ method_field("PUT") }}
                                @csrf
                                <button type="submit" class="button create-group options accept">Accept</button>
                            </form>
                            <form method="POST" style="display: inline-block;" name="reject" id="reject" action="{{ route('reject', [ 'group' => $group->unique_id ]) }}">
                                {{ method_field("DELETE") }}
                                @csrf
                                <button class="button create-group options reject">Reject</button>
                            </form>    
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </body>
</html>