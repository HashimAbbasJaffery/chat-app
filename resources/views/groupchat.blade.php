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
        <div id="chatbox">
            <div class="message-wrapper">
                <div class="message message-style">
                    <div class="name" style="margin-bottom: 10px;"><b>Hashim</b></div>
                    <div class="user-message">Hey there!</div>
                </div>
            </div>
        </div>
        <input type="text" id="message" name="message">
        <button onclick="send()">Click!</button>
    </div>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
    integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function send() {
        const message = document.getElementById("message");
        axios.post("/api/group", {
            message: message.value,
            sender_id: {{ auth()->user()->id }},
            reciever_id: `{{ $group->unique_id }}`
        })
            .then(res => {
                message.value = "";
            })
            .catch(err => {
                console.log(err);
            })
    }

    var pusher = new Pusher('4df466d966a05206294a', {
        cluster: 'ap2',
        encrypted: true
    });
    const channelAddress = `channel-{{ $group->unique_id }}`;
    var channel = pusher.subscribe(channelAddress);
    const chatbox = document.getElementById("chatbox");

    channel.bind('groupChatEvent', function (data) {
        console.log(data);
        let type = "sender";
        const name = `{{ auth()->user()->name }}`;
        const msgUsername = data.username;
        if( name !== msgUsername ) {
            type = "message-reciever";
        }
        chatbox.innerHTML += `
            <div class="message-wrapper ${type}">
                <div class="message message-style" style="margin-bottom: 10px">
                    <div class="name" style="margin-bottom: 10px;"><b>${data.username}</b></div>
                    <div class="user-message">${data.message}</div>
                </div>
            </div>
        `
    }); 
</script>
<script type="module" src="/typing.js"></script>

</html>