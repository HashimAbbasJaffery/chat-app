<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/style.css" />
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
    </script>
</head>

<body>
    <div id="chatbox">
        <div class="message">
            <div class="name" style="margin-bottom: 10px;"><b>Hashim</b></div>
            <div class="user-message">Hey there!</div>
        </div>
        <hr>
    </div>
    <input type="text" id="message" name="message">
    <button onclick="send()">Click!</button>

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.4.0/axios.min.js"
    integrity="sha512-uMtXmF28A2Ab/JJO2t/vYhlaa/3ahUOgj1Zf27M5rOo8/+fcTUVH0/E0ll68njmjrLqOBjXM3V9NiPFL5ywWPQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function send() {
        const message = document.getElementById("message");
        axios.post("/api/message", {
            message: message.value
        })
            .then(res => {
                console.log(res);
                message.value = "";
            })
            .catch(err => {
                console.log(err);
            })
    }
    Pusher.logToConsole = true;

    var pusher = new Pusher('4df466d966a05206294a', {
        cluster: 'ap2',
        encrypted: true
    });

    var channel = pusher.subscribe('chatapp');
    console.log(channel);
    channel.bind('pusher:subscription_succeeded', function (data) {
        // This callback is called when the subscription succeeds
        console.log('Subscription succeeded');
    });
    const chatbox = document.getElementById("chatbox");
    channel.bind('message', function (data) {
        console.log(data.message);
        chatbox.innerHTML += `
            <div class="message" style="margin-bottom: 10px">
                <div class="name" style="margin-bottom: 10px;"><b>${data.username}</b></div>
                <div class="user-message">${data.message}</div>
            </div>
        `
    });
</script>

</html>