<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>World Time App</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
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

        #clockCanvas {
            border: 2px solid black;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <h1>Current Time</h1>
    <p id="time">Fetching time...</p>
    <button onclick="speakTime()">Speak Time</button>

    <h1>Alarm Clock</h1>
    <div class="alarm">
        <input type="time" id="alarmTime" />
        <button id="setAlarm">Set Alarm</button>
        <p id="status"></p>
    </div>
    <audio id="alarmSound" src="alarm.mp3" preload="auto"></audio>

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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.34/moment-timezone-with-data.min.js"></script>
    <script>
        // Get user's location
        navigator.geolocation.getCurrentPosition(async (position) => {
            const lat = position.coords.latitude;
            const long = position.coords.longitude;

            // Use a service to get the timezone from lat and long
            const response = await fetch(`https://api.ipgeolocation.io/timezone?apiKey=6c06b9c448f04419a76a70cc1b0aac67&lat=${lat}&long=${long}`);
            const data = await response.json();
            // const timezone = data.timezone;

            // Display the current time
            let timezone; // Set your default timezone here

            // Function to fetch timezone data
            async function fetchTimezone() {
                // Simulate fetching timezone data
                // Replace this with actual fetching logic if needed
                const response = await fetch(`https://api.ipgeolocation.io/timezone?apiKey=6c06b9c448f04419a76a70cc1b0aac67&lat=${lat}&long=${long}`);
                const data = await response.json();
                timezone = data.timezone; // Update the timezone variable with fetched data
            }

            // Call fetchTimezone to get the timezone initially
            fetchTimezone().then(() => {
                setInterval(() => {
                    const currentTime = moment().tz(timezone).format('MMMM Do YYYY, h:mm:ss a');
                    document.getElementById('time').innerText = currentTime;
                    console.log(currentTime)
                }, 1000);
            });
        });


        // Function to speak the current time
        function speakTime() {
            const time = document.getElementById('time').innerText;
            const msg = new SpeechSynthesisUtterance(`The time is ${time}`);

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

        // Ensure voices are loaded before trying to access them
        window.speechSynthesis.onvoiceschanged = () => {
            // Optional: you can list all voices here for debugging
            console.log(window.speechSynthesis.getVoices());
        };
    </script>
</body>

</html>