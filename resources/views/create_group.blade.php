<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
    </script>
    <link rel="stylesheet" href="/style.css" />
</head>

<body>
    <div id="wrapper">
        <div id="chatbox" style="text-align: center;">
            <form action="{{ route('store.group') }}" method="POST" name="create_group" id="create_group">
                <h1>Create group</h1>
                @csrf
                <input type="text" name="group_name" id="group_name" required class="group_name" placeholder="Group name"/>
                <input class="submit_button" type="submit" class="button" style="padding: 10px 10px; margin-left: 10px;" value="Create">
            </form>
            <div class="user-list" id="user-list">
                <h1>Invite members</h1>
                <input type="text" name="group_id" value="" id="group_id"/>
                @foreach($users as $user):    
                    <form method="POST" name="invite" class="group-invitation" id="invite-{{ $user->id }}">
                        <div class="user" style="padding: 10px;">
                            <h3 style="margin: 0px;">{{ $user->name }}</h3>
                            <input type="submit" class="button submit_button" value="Invite!">
                        </div>
                    </form>
                @endforeach
            </div>
            <a href="/groupchatroom/" class="user-list-button button submit_button" style="margin-top: 20px;">Go to chatroom!</a>
        </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js" integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="/create-group.js" type="module"></script>
<script src="/invite.js" type="module"></script>
</body>


</html>