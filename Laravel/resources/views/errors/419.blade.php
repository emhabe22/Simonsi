<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 Page Expired</title>
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
            color: #FFD93D;
            text-shadow: 0 0 10px #FFD93D;
            font-size: 5rem;
            flex-direction: column;
        }
        #app .txt { font-size: 1.7rem; }
        @keyframes blink { 0%,49%{opacity:0;} 50%,100%{opacity:1;} }
        .blink { animation: blink 1s infinite; }
    </style>
</head>
<body>
    <div id="app">
        <div>419</div>
        <div class="txt"> Page Expired<span class="blink">_</span></div>
    </div>
</body>
</html>
