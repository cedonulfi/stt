<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speech to Text (Arabic)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }
        #result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            background: #f9f9f9;
            font-size: 1.2em;
            min-height: 50px;
        }
        button {
            padding: 10px 20px;
            font-size: 1em;
            margin: 10px;
        }
    </style>
</head>
<body>
    <h1>Speech to Text (Arabic)</h1>
    <p>Click the button and speak in Arabic to see the transcription.</p>
    <button id="start-btn">Start Recording</button>
    <button id="stop-btn" disabled>Stop Recording</button>

    <div id="result">Your transcribed text will appear here...</div>

    <script src="webspeech.js"></script> 
</body>
</html>
