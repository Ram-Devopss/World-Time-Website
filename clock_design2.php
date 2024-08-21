<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analog Clock Design 2</title>
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/styles.css">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.40/moment-timezone-with-data.min.js"></script>

    <style>
        :root {
            --main-bg-color: #fff;
            --main-text-color: #888888;
        }

        [data-theme="dark"] {
            --main-bg-color: #1e1f26;
            --main-text-color: #ccc;
            --alarm-head: #ccc;
        }

        * {
            box-sizing: border-box;
            /* 		transition: all ease 0.2s; */
        }

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            background-color: var(--main-bg-color);
            position: relative;
            transition: all ease 0.2s;
        }

        .page-header {
            font-size: 2rem;
            color: var(--main-text-color);
            padding: 2rem 0;
            font-family: monospace;
            text-transform: uppercase;
            letter-spacing: 4px;
            transition: all ease 0.2s;
        }

        .clock {
            min-height: 18em;
            min-width: 18em;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: var(--main-bg-color);
            background-image: url("https://imvpn22.github.io/analog-clock/clock.png");
            background-position: center center;
            background-size: cover;
            border-radius: 50%;
            border: 4px solid var(--main-bg-color);
            box-shadow: 0 -15px 15px rgba(255, 255, 255, 0.05), inset 0 -15px 15px rgba(255, 255, 255, 0.05), 0 15px 15px rgba(0, 0, 0, 0.3), inset 0 15px 15px rgba(0, 0, 0, 0.3);
            transition: all ease 0.2s;
        }

        .clock:before {
            content: "";
            height: 0.75rem;
            width: 0.75rem;
            background-color: var(--main-text-color);
            border: 2px solid var(--main-bg-color);
            position: absolute;
            border-radius: 50%;
            z-index: 1000;
            transition: all ease 0.2s;
        }

        .hour,
        .min,
        .sec {
            position: absolute;
            display: flex;
            justify-content: center;
            border-radius: 50%;
        }

        .hour {
            height: 10em;
            width: 10em;
        }

        .hour:before {
            content: "";
            position: absolute;
            height: 50%;
            width: 6px;
            background-color: var(--main-text-color);
            border-radius: 6px;
        }

        .min {
            height: 12em;
            width: 12em;
        }

        .min:before {
            content: "";
            height: 50%;
            width: 4px;
            background-color: var(--main-text-color);
            border-radius: 4px;
        }

        .sec {
            height: 13em;
            width: 13em;
        }

        .sec:before {
            content: "";
            height: 60%;
            width: 2px;
            background-color: #f00;
            border-radius: 2px;
        }

        /* Style for theme switch btn */

        .switch-cont {
            margin: 2em auto;
            /* position: absolute; */
            bottom: 0;
        }

        .switch-cont .switch-btn {
            font-family: monospace;
            text-transform: uppercase;
            outline: none;
            padding: 0.5rem 1rem;
            background-color: var(--main-bg-color);
            color: var(--main-text-color);
            border: 1px solid var(--main-text-color);
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all ease 0.3s;
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


    <div class="page-header"> Analog Clock </div>
    <div class="clock">
        <div class="hour"></div>
        <div class="min"></div>
        <div class="sec"></div>
    </div>
    <div class="switch-cont">
        <button class="switch-btn"> Light </button>
    </div>

    <div>
        <button class="switch-btn" onclick="speakTime()">speak</button>
    </div>
    <h1 class="alarm-head">Alarm Clock</h1>
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
    <script>
        // Global variables to hold lat, long, and fetched data
        var lat, long, data;
        let timezone;

        // Constants for clock calculations
        const deg = 6;
        const hour = document.querySelector(".hour");
        const min = document.querySelector(".min");
        const sec = document.querySelector(".sec");

        // Function to fetch time data based on lat and long
        async function fetchTimeData() {
            if (lat !== undefined && long !== undefined) {
                try {
                    const response = await fetch(`https://api.ipgeolocation.io/timezone?apiKey=b970e638b5da4e2884f5686b0aaaf904&lat=${lat}&long=${long}`);
                    data = await response.json();
                    timezone = data.timezone; // Update the timezone variable with fetched data
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
            setClock(); // Set initial clock state

            // Start the clock
            setInterval(setClock, 1000); // Update every second
        });

        // Function to update the clock hands
        async function setClock() {
            await fetchTimeData(); // Fetch latest data
            if (!data) return;

            let currentTime = moment().tz(timezone);
            let hh = currentTime.hours() * 30; // Calculate hour hand rotation
            let mm = currentTime.minutes() * deg; // Calculate minute hand rotation
            let ss = currentTime.seconds() * deg; // Calculate second hand rotation

            hour.style.transform = `rotate(${hh + mm / 12}deg)`; // Set hour hand position
            min.style.transform = `rotate(${mm}deg)`; // Set minute hand position
            sec.style.transform = `rotate(${ss}deg)`; // Set second hand position
        }

        // Function to switch themes
        const switchTheme = (evt) => {
            const switchBtn = evt.target;
            if (switchBtn.textContent.toLowerCase() === "dark") {
                switchBtn.textContent = "light";
                document.documentElement.setAttribute("data-theme", "dark");
            } else {
                switchBtn.textContent = "dark";
                document.documentElement.setAttribute("data-theme", "light");
            }
        };

        // Add event listener for the theme switch button
        const switchModeBtn = document.querySelector(".switch-btn");
        switchModeBtn.addEventListener("click", switchTheme);

        // Set initial theme
        let currentTheme = "dark";
        document.documentElement.setAttribute("data-theme", currentTheme);
        switchModeBtn.textContent = currentTheme;

        function speakTime() {
            if (data) {
                const currentTime = moment().tz(timezone);
                const formattedTime = currentTime.format('dddd, MMMM Do YYYY, h:mm a');
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
</body>

</html>