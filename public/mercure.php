<html dir="ltr"
      lang="en">
    <head>
        <meta charset="utf8">
        <title>Mercure</title>
        <script>
            // The subscriber subscribes to updates for the https://example.com/users/dunglas topic
            // and to any topic matching https://example.com/books/{id}
            const url = new URL('http://localhost/hub');
            url.searchParams.append('topic', 'http://localhost/demo/books/1.jsonld');

            var timeArr = [];
            const eventSource = new EventSource(url);

            eventSource.onmessage = e => {
                timeArr.push(new Date().getTime());
                console.log('x');
                // var para = document.createElement("p");
                // var node = document.createTextNode(JSON.stringify(e.data));
                // para.appendChild(node);
                //
                // var element = document.getElementById("div1");
                // element.appendChild(para);
            };

            function getCalculation(timeArr) {

                if (timeArr !== undefined || timeArr.length !== 0) {
                    console.log(timeArr.pop() - timeArr[0]);
                    timeArr = [];
                }
            }
        </script>
    </head>

    <body class="loading">
        <h1>Mercure</h1>
        <div id="div1"></div>
        <button onclick="getCalculation(timeArr)">Calculate</button>
    </body>
</html>

