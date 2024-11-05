<html>
    <head>
        <title>Redis PubSub</title>
        <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
        <script type="text/javascript">
            var timeArr = [];
            function fetch() {
                var sock = io("http://127.0.0.1:8000");
                console.log(sock);
                sock.on('notification-pubsub', function(msg) {
                    timeArr.push(new Date().getTime());
                    console.log('x');
                    console.log(msg);
                });
            }

            function getCalculation() {

                if (timeArr !== undefined || timeArr.length !== 0) {
                    console.log(timeArr.pop() - timeArr[0]);
                    timeArr = [];
                }
            }

            fetch();
        </script>
    </head>
    <body>
        <h1>Redis PubSub</h1>
        <div id="div1"></div>
        <button onclick="getCalculation()">Calculate</button>
    </body>
</html>