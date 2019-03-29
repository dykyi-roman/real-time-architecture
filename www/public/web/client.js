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

centrifuge.subscribe('public', function (message) {
    var para = document.createElement('p');
    var obj = JSON.parse(message.data);
    var node = document.createTextNode(obj.time);
    para.appendChild(node);
    
    var element = document.getElementById('div1');
    element.appendChild(para);
});