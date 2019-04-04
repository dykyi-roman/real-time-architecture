<!DOCTYPE html>
<head>
    <title>RabbitMQ</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/sockjs-client/0.3.4/sockjs.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/stomp.js/2.3.3/stomp.min.js"></script>
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script>
        var timeArr = [];
        var client = null;

        function getCalculation() {

            if (timeArr !== undefined || timeArr.length !== 0) {
                console.log(timeArr.pop() - timeArr[0]);
                timeArr = [];
            }
        }

        function onConnect() {
            console.log('Connected');
             client.subscribe('/queue/notification', function (d) {
                 // console.log(d.body);
                 timeArr.push(new Date().getTime());
             });
        }

        //Send a message to the chat queue
        function sendMsg() {
            var msg = document.getElementById('msg').value;
            client.send('/exchange/web/chat', {'content-type': 'text/plain'}, msg);
        }

        function onError(e) {
            console.log('STOMP ERROR', e);
        }

        function connect() {
            // var ws = new SockJS("http://127.0.0.1:15674/stomp");
            var ws = new WebSocket('ws://127.0.0.1:15674/ws');
            client = Stomp.over(ws);

            // RabbitMQ Web-Stomp does not support heartbeats so disable them
            client.heartbeat.outgoing = 0;
            client.heartbeat.incoming = 0;

            // client.debug = e => console.log(e);

            // Make sure the user has limited access rights
            client.connect('user', 'user', onConnect, onError, '/');
        }

        function disconnect() {
            if (client != null) {
                client.disconnect();
            }
            console.log('Disconnected');
        }

    </script>
</head>
<body>
    <h1>RabbitMQ</h1>
    <div id="div1"></div>
    <button id="connect"
            onclick=connect();>Connect
    </button>
    <button id="disconnect"
            onclick=disconnect();>Disconnect
    </button>

    <button onclick="getCalculation()">Calculate</button>
</body>