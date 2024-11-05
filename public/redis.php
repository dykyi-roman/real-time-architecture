<!DOCTYPE html>
<head>
    <title>Redis</title>
    <script
            src="https://code.jquery.com/jquery-3.3.1.js"
            integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
            crossorigin="anonymous"></script>
    <script>
        var timeArr = [];

        function getCalculation() {

            if (timeArr !== undefined || timeArr.length !== 0) {
                console.log(timeArr.pop() - timeArr[0]);
                timeArr = [];
            }
        }

        function fetch() {
            $.ajax({
                type: 'GET',
                url: '/redis/take',
                error: function () {
                    console.warn('ajax error response');
                },
                success: function (data) {
                    if (data.length > 1) {
                        timeArr.push(new Date().getTime());
                        console.log('x');
                        // var para = document.createElement('p');
                        // var node = document.createTextNode(JSON.stringify(data));
                        // para.appendChild(node);
                        // var element = document.getElementById('div1');
                        // element.appendChild(para);
                    }

                    fetch();
                }
            });
        }
        fetch();
    </script>
</head>
<body>
    <h1>Redis</h1>
    <div id="div1"></div>
    <button onclick="getCalculation()">Calculate</button>
</body>