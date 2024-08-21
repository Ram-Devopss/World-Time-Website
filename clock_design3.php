<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

    <title>Analog Clock Design 3</title>
    <style>
        body {
            font-family: 'liquid_crystalregular', sans-serif;
            user-select: none;
            user-drag: none;
        }

        .clock {
            height: 100px;
            width: 70%;
            line-height: 100px;
            margin: 150px auto 0;
            padding: 0 50px;
            background: #222;
            color: #eee;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 0 7px #222;
            text-shadow: 0 0 3px #fff;
            font-size: 2em;
            /* Adjust font size as needed */
        }

        .alarm {
            margin: 20px;
        }

        #alarmTime {
            margin: 10px;
        }

        #setAlarm {
            padding: 5px 15px;
        }
    </style>
</head>

<body>

    <div id="clock" class="clock text-center mb-3">loading ...</div>
    <div class="text-center mb-3">
        <button class="btn btn-primary" onclick="speakTime()">Speak</button>
    </div>
    <h1 class="text-center mb-4">Alarm Clock</h1>
    <div class="alarm text-center mb-3">
        <div class="form-group">
            <input type="time" id="alarmTime" class="form-control mb-2" />
            <button id="setAlarm" class="btn btn-success">Set Alarm</button>
        </div>
        <p id="status" class="mt-2"></p>
    </div>
    <audio id="alarmSound" src="alarm.mp3" preload="auto"></audio>

    <script>
        // Global variables to hold lat, long, and fetched data
        var lat, long, data;

        // Function to fetch time data based on lat and long
        async function fetchTimeData() {
            if (lat !== undefined && long !== undefined) {
                try {
                    const response = await fetch(`https://api.ipgeolocation.io/timezone?apiKey=b970e638b5da4e2884f5686b0aaaf904&lat=${lat}&long=${long}`);
                    data = await response.json();

                    // Update the digital clock
                    updateClock();
                } catch (error) {
                    console.error("Error fetching time data:", error);
                }
            }
        }

        // Initialize location and start the clock
        navigator.geolocation.getCurrentPosition(async (position) => {
            lat = position.coords.latitude;
            long = position.coords.longitude;

            // Fetch the initial time data
            await fetchTimeData();
            updateClock();

            // Update the clock every second
            setInterval(async () => {
                await fetchTimeData(); // Fetch updated time data
                updateClock(); // Update the digital clock
            }, 1000); // Update every second
        });

        // Function to update the digital clock display
        function updateClock() {
            if (data) {
                const date = new Date(data.date_time);
                const formattedTime = date.toLocaleString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: true
                });
                document.getElementById('clock').innerText = formattedTime;
            }
        }

        // Function to speak the current time
        function speakTime() {
            if (data) {
                const date = new Date(data.date_time);
                const formattedTime = date.toLocaleString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });
                const msg = new SpeechSynthesisUtterance(`The time is ${formattedTime}`);

                // Get all available voices
                const voices = window.speechSynthesis.getVoices();

                // Select a female voice
                const femaleVoice = voices.find(voice => voice.name.includes("Female") || voice.name.includes("female") || voice.gender === "female");

                // Set the voice if a female voice is found
                if (femaleVoice) {
                    msg.voice = femaleVoice;
                }

                window.speechSynthesis.speak(msg);
            }
        }
    </script>

    <script>
        // Global variable to store the alarm time
        let alarmTime = null;

        // Set up event listener for the set alarm button
        document.getElementById('setAlarm').addEventListener('click', () => {
            const timeInput = document.getElementById('alarmTime').value;
            if (timeInput) {
                alarmTime = timeInput;
                document.getElementById('status').innerText = `Alarm set for ${alarmTime}`;
            }
        });

        // Function to check if the current time matches the alarm time
        function checkAlarm() {
            const now = new Date();
            const currentTime = now.toTimeString().slice(0, 5);
            if (alarmTime === currentTime) {
                document.getElementById('alarmSound').play();
                document.getElementById('status').innerText = 'Alarm ringing!';
                alarmTime = null; // Clear the alarm after it rings
            }
        }

        // Check the alarm every second
        setInterval(checkAlarm, 1000);
    </script>
</body>

</html>