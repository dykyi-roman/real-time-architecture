<!DOCTYPE html>
<head>
    <title>Pusher</title>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('c4b1bceb4964a0422ced', {
            cluster: 'eu',
            forceTLS: true
        });
        var timeArr = [];
        var channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {
            timeArr.push(new Date().getTime());
            console.log('x');
            // var para = document.createElement("p");
            // var node = document.createTextNode(JSON.stringify(data));
            // para.appendChild(node);
            //
            // var element = document.getElementById("div1");
            // element.appendChild(para);
        });

        function getCalculation(timeArr) {

            if (timeArr !== undefined || timeArr.length !== 0) {
                console.log(timeArr.pop() - timeArr[0]);
                timeArr = [];
            }
        }
    </script>
</head>
<body>
    <h1>Pusher</h1>
    <div id="div1"></div>
    <button onclick="getCalculation(timeArr)">Calculate</button>
</body>