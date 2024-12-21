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

    <script>
        let recognition;
        let isRecording = false;

        // Check if the browser supports Web Speech API
        if ('webkitSpeechRecognition' in window) {
            recognition = new webkitSpeechRecognition();
            recognition.lang = 'ar-SA'; // Arabic language
            recognition.interimResults = false; // Only show final results
            recognition.continuous = true; // Keep listening until stopped

            // Start recording
            document.getElementById('start-btn').addEventListener('click', () => {
                recognition.start();
                isRecording = true;
                document.getElementById('start-btn').disabled = true;
                document.getElementById('stop-btn').disabled = false;
                document.getElementById('result').innerText = "Listening...";
            });

            // Stop recording
            document.getElementById('stop-btn').addEventListener('click', () => {
                recognition.stop();
                isRecording = false;
                document.getElementById('start-btn').disabled = false;
                document.getElementById('stop-btn').disabled = true;
            });

            // On result
            recognition.onresult = (event) => {
                let transcript = '';
                for (let i = 0; i < event.results.length; i++) {
                    transcript += event.results[i][0].transcript;
                }

                // Display the transcription
                document.getElementById('result').innerText = transcript;

                // Send the transcription to PHP via POST
                fetch('save_transcription.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ text: transcript }),
                })
                .then(response => response.text())
                .then(data => console.log('Saved:', data))
                .catch(error => console.error('Error:', error));
            };

            // On error
            recognition.onerror = (event) => {
                console.error('Speech recognition error:', event.error);
                document.getElementById('result').innerText = "Error occurred. Try again.";
            };
        } else {
            alert('Web Speech API is not supported in this browser. Please use Google Chrome.');
        }
    </script>
</body>
</html>
