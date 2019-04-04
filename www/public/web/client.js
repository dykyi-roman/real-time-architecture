const centrifuge = new Centrifuge('ws://127.0.0.1:8001/connection/websocket');
centrifuge.setToken($('.token').data('token'));

centrifuge.on('connect', function () {
    $('.status').html('Connect: ' + centrifuge.isConnected());
});

centrifuge.on('disconnect', function (context) {
    console.log(context);
    $('.status').html('Connect: ' + centrifuge.isConnected());
});

centrifuge.on('error', function (e) {
    console.log(e);
});

function getCalculation() {
    
    if (timeArr !== undefined || timeArr.length !== 0) {
        console.log(timeArr.pop() - timeArr[0]);
        timeArr = [];
    }
}

var timeArr=[];

centrifuge.subscribe('public', function (message) {
    timeArr.push(new Date().getTime());
    console.log('x');
    // var para = document.createElement('p');
    // var obj = JSON.parse(message.data);
    // var node = document.createTextNode(obj.time);
    // para.appendChild(node);
    //
    // var element = document.getElementById('div1');
    // element.appendChild(para);
});