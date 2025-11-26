<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>429 Too Many Requests</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Press+Start+2P");
        html, body { width: 100%; height: 100%; margin: 0; }
        * { font-family: 'Press Start 2P', cursive; box-sizing: border-box; }
        #app {
            padding: 1rem;
            background: black;
            display: flex;
            height: 100%;
            justify-content: center;
            align-items: center;
            color: #FF9F9F;
            text-shadow: 0 0 10px #FF9F9F;
            font-size: 5rem;
            flex-direction: column;
        }
        #app .txt { font-size: 1.6rem; text-align: center; }
        @keyframes blink { 0%,49%{opacity:0;} 50%,100%{opacity:1;} }
        .blink { animation: blink 1s infinite; }
    </style>
</head>
<body>
    <div id="app">
        <div>429</div>
        <div class="txt"> Too Many Requests<span class="blink">_</span></div>
    </div>
</body>
</html>
