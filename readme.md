#Web real time architecture

1) [Mercure (SSE)](#one)

2) [Centrifugo (WebSocket)](#two)

3) [Redis BLPOP](#three)

4) [Third party resources](#four)

## <a name="one"><h1>Mercure (SSE)</h1></a>

### Description

Mercure is a protocol allowing to push data updates to web browsers and other HTTP clients in a convenient, fast, reliable and battery-efficient way. It is especially useful to publish real-time updates of resources served through web APIs, to reactive web and mobile apps.

<img src="https://github.com/dunglas/mercure/raw/master/spec/subscriptions.png" width="350">

### Pros & Cons

+ Github Fork(49), Star(1190)

+ Docker support
+ Open source (AGPL)
+ Fast, written in Go
+ No lib nor SDK
+ Automatic HTTP/2 and HTTPS support
+ CORS support, CSRF protection mechanism
+ JWT-based authorization
+ Built-in connection re-establishment 
+ Supports GraphQL
+ Message encryption support
+ Can work with old browsers (IE7+)

### Sources

Component: https://github.com/dunglas/mercure

Protokol: https://github.com/dunglas/mercure/blob/master/spec/mercure.md

Website: https://mercure.rocks

Demo: https://demo.mercure.rocks/

## <a name="two"><h1>Centrifugo (WebSocket)</h1></a>

### Description

Centrifugo this is a real-time messaging server and its friends. Centrifugal organization provides a set of tools to add real-time features to your web/mobile/desktop application. It brings together several repositories linked by a common purpose – give you a complete and ready to use solution when you want to add real-time events into your application.

<img src="https://github.com/dykyi-roman/centrifugo-service/blob/master/docs/image.png" width="350">

### Pros & Cons

+ Github Fork(292), Star(3407)

+ Docker support
+ Open source (MIT)
+ Works on Linux, MacOS and Windows
+ Administrative web interface
+ No lib nor SDK
+ JWT-based authorization
+ Scale with Redis PUB/SUB, Redis Sentinel for high availability
+ History information for channels
+ Events channels support
+ Automatically recover missed messages
+ Available dashboard

### Sources

Component: https://github.com/centrifugal/centrifugo

Documentation v1: https://centrifugal.github.io/centrifugo/

Documentation v2: https://github.com/oleh-ozimok/php-centrifugo

Demo: https://centrifugo.herokuapp.com/#/ && https://centrifugo2.herokuapp.com/

## <a name="three"><h1>Redis BLPOP</h1></a>

LPUSH - Insert all the specified values at the head of the list stored at key. If key does not exist, it is created as empty list before performing the push operations. When key holds a value that is not a list, an error is returned.

BLPOP - is a blocking list pop primitive. It is the blocking version of LPOP because it blocks the connection when there are no elements to pop from any of the given lists. An element is popped from the head of the first list that is non-empty, with the given keys being checked in the order that they are given.

<img src="https://storage.googleapis.com/cdn.thenewstack.io/media/2018/05/ebd5ebac-kd31.png" width="350">

### Pros & Cons

+ Github Fork(771), Star(5445)

+ Docker support
+ Open source (MIT)
+ Works on Linux, MacOS and Windows
+ Connections can be established via TCP/IP

### Sources

Documentation: https://redis.io/commands/BLPOP

Example: https://www.tutorialspoint.com/redis/lists_blpop.htm

## <a name="four"><h1>Third party resources</h1></a>

### Pusher (WebSocket)

Easily build scalable realtime graphs, geotracking, multiplayer games, and more in your web and mobile apps with our hosted pub/sub messaging API.

<img src="https://realtimeapi.io/wp-content/uploads/2017/09/trigger_events-1.png" width="350">

#### Pros & Cons

+ Github Fork(213), Star(846)

+ No lib nor SDK
+ Max Concurent Connections: 100 - 10 000
+ Free Limit per/day: 200 000 - 20 000 000 
+ SSL Protection
+ Available support 
+ Available dashboard

#### Sources

Website: www.pusher.com

Component: https://github.com/pusher/pusher-http-php

Documentation: https://pusher.com/docs

### Pubnub (TLS)

Website: https://www.pubnub.com/products/realtime-messaging/

Documentation: https://www.pubnub.com/docs

Demo: https://www.pubnub.com/schedule-a-demo/

## JWT

JSON Web Token (JWT) is an open standard (RFC 7519) that defines a compact and self-contained way for securely transmitting information between parties as a JSON object. Although JWTs can be encrypted to also provide secrecy between parties, we will focus on signed tokens.

### Sources

Website: https://jwt.io/

Documentation: https://jwt.io/introduction/

## Other

https://www.smartspate.com/centrifugo-v2-the-future-of-the-real-time-server/

https://www.quora.com/What-is-the-best-way-to-push-real-time-data-to-a-mobile-app-from-a-backend

Redis: https://thenewstack.io/how-to-build-intelligence-into-your-session-stores-putting-it-all-together/