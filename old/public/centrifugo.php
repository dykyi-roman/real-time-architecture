<?php

use App\Infrastructure\Centrifugo\JWTToken;

require_once "../vendor/autoload.php";

?>

<html dir="ltr" lang="en">
<head>
    <meta charset="utf8">
    <title>Centrifugal</title>

    <script src="//cdn.jsdelivr.net/sockjs/1.1/sockjs.min.js" type="text/javascript"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/json3/3.3.2/json3.min.js" type="text/javascript"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/hmac-sha256.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/components/enc-base64-min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>

<body class="loading">

<div class="token" data-token="<?= $token ?>"></div>

<button class="connect" onclick="connect()">Connect</button>
<button class="disconnect" onclick="disconnect()">Disconnect</button>
<button onclick="getCalculation()">Calculate</button>
<div class="status"></div>
<h1>Centrifugal</h1>
<div id="div1"></div>

<script src="web/centrifuge.js"></script>
<script src="web/client.js"></script>
<script src="web/main.js"></script>

</body>
</html>

