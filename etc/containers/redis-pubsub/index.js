var express = require('express');
var app = express();
var http = require('http').Server(app);
var redis = require('redis');
var client = redis.createClient("redis://127.1.1.1:6379");

var io = require('socket.io')(http)

app.use('/', express.static('www'));

http.listen(8000, function(){
    console.log('listening on *:8000');
});

client.on('message', function(chan, msg) {
	console.log(chan);
	console.log(msg);
  	io.sockets.emit(chan, msg);
});

client.subscribe('notification-pubsub');
