# Web Real-Time Architecture

[Mercure (SSE)](#one)

[Centrifugo (WebSocket)](#two)

[Long Polling + Data Storage](#three)

[Pusher.com](#four)

[RabbitMQ (STOMP)](#five)

[JWT](#jwt)

## <a name="one"><h1>Mercure (SSE)</h1></a>

### Description

Mercure is a protocol allowing to push data updates to web browsers and other HTTP clients in a convenient, fast, reliable and battery-efficient way. It is especially useful to publish real-time updates of resources served through web APIs, to reactive web and mobile apps.

### Pros & Cons

+ Docker image avalible
+ Open source (AGPL)
+ Fast, written in Go
+ No lib nor SDK
+ Automatic HTTP/2 and HTTPS support
+ CORS support, CSRF protection mechanism
+ JWT-based authorization
+ Built-in connection re-establishment 
+ Supports GraphQL
+ Message encryption support
+ Can work with old browsers (IE7+) Using EventSource polifill

### Sources
* Component: https://github.com/dunglas/mercure
* Protokol: https://github.com/dunglas/mercure/blob/master/spec/mercure.md
* Website: https://mercure.rocks
* Demo: https://demo.mercure.rocks/

## <a name="two"><h1>Centrifugo (WebSocket)</h1></a>

### Description

Centrifugo - is a real-time messaging server and its friends. Centrifugal organization provides a set of tools to add real-time features to your web/mobile/desktop application. It brings together several repositories linked by a common purpose – give you a complete and ready to use solution when you want to add real-time events into your application.

<img src="https://github.com/dykyi-roman/centrifugo-service/blob/master/docs/image.png" width="350">

### Pros & Cons
+ Docker image avalible
+ Open source (MIT)
+ No lib nor SDK
+ JWT-based authorization
+ Single persistent connection
+ Scale with Redis PUB/SUB, Redis Sentinel for high availability
+ History information for channels
+ Events channels support
+ Automatically recover missed messages
+ Available dashboard

### Sources
* Component: https://github.com/centrifugal/centrifugo
* Documentation v1: https://centrifugal.github.io/centrifugo/
* Documentation v2: https://github.com/oleh-ozimok/php-centrifugo
* Demo: https://centrifugo.herokuapp.com/#/ && https://centrifugo2.herokuapp.com/

## <a name="three"><h1>Long Polling + Data Storage</h1></a>

### Description

<img src="https://storage.googleapis.com/cdn.thenewstack.io/media/2018/05/ebd5ebac-kd31.png" width="350">

Long Polling is a technique where the client sends a request to the server and waits for a response. The server holds the request open until it has new data to send back or until a timeout occurs. Long Polling is a low-overhead approach suitable for projects with a low volume of clients and a low frequency of updates.

## <a name="four"><h1>Pusher.com</h1></a>

### Description

Easily build scalable realtime graphs, geotracking, multiplayer games, and more in your web and mobile apps with our hosted pub/sub messaging API.

### Pros & Cons
+ No lib nor SDK
+ Max Concurent Connections: 100 - 10 000
+ Free Limit per/day: 200 000 - 20 000 000 
+ SSL Protection
+ Available support 
+ Available dashboard

### Sources
* Website: www.pusher.com
* Component: https://github.com/pusher/pusher-http-php
* Documentation: https://pusher.com/docs

## <a name="five"><h1>RabbiMQ (STOMP)</h1></a>

### Description

RabbitMQ is an open-source message-broker software (sometimes called message-oriented middleware) that originally implemented the Advanced Message Queuing Protocol (AMQP) and has since been extended with a plug-in architecture to support Streaming Text Oriented Messaging Protocol (STOMP), Message Queuing Telemetry Transport (MQTT), and other protocols.

### Pros & Cons
+ Very fasten
+ High performance
+ Docker image avalible
+ Asynchronous messag delivery
+ Available dashboard
+ Gateways for AMQP, HTTP, STOMP, and MQTT protocols
+ Automated connection recovery mechanisms
+ Need a lib
+ Difficult to maintain
+ Not secure (have an open user credential)

### Sources
* Website: https://www.rabbitmq.com/
* Component: https://github.com/php-amqplib/php-amqplib
* Documentation: https://www.rabbitmq.com/documentation.html

## <a name="jwt"><h1>JWT</h1></a>

JSON Web Token (JWT) is an open standard (RFC 7519) that defines a compact and self-contained way for securely transmitting information between parties as a JSON object. Although JWTs can be encrypted to also provide secrecy between parties, we will focus on signed tokens.

### Sources
* Website: https://jwt.io/
* Documentation: https://jwt.io/introduction/

## Author
[Dykyi Roman](https://www.linkedin.com/in/roman-dykyi-43428543/), e-mail: [mr.dukuy@gmail.com](mailto:mr.dukuy@gmail.com)
