<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- favicons
    ================================================== -->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.40/moment-timezone-with-data.min.js"></script>

    <title>Analog Clock Design 1</title>
    <style>
        .clock {
            background: #ececec;
            width: 300px;
            height: 300px;
            margin: 8% auto 0;
            border-radius: 50%;
            border: 14px solid #333;
            position: relative;
            box-shadow: 0 2vw 4vw -1vw rgba(0, 0, 0, 0.8);
        }

        .dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            background: #ccc;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            position: absolute;
            z-index: 10;
            box-shadow: 0 2px 4px -1px black;
        }

        .hour-hand {
            position: absolute;
            z-index: 5;
            width: 4px;
            height: 65px;
            background: #333;
            top: 79px;
            transform-origin: 50% 72px;
            left: 50%;
            margin-left: -2px;
            border-top-left-radius: 50%;
            border-top-right-radius: 50%;
        }

        .minute-hand {
            position: absolute;
            z-index: 6;
            width: 4px;
            height: 100px;
            background: #666;
            top: 46px;
            left: 50%;
            margin-left: -2px;
            border-top-left-radius: 50%;
            border-top-right-radius: 50%;
            transform-origin: 50% 105px;
        }

        .second-hand {
            position: absolute;
            z-index: 7;
            width: 2px;
            height: 120px;
            background: gold;
            top: 26px;
            lefT: 50%;
            margin-left: -1px;
            border-top-left-radius: 50%;
            border-top-right-radius: 50%;
            transform-origin: 50% 125px;
        }

        span {
            display: inline-block;
            position: absolute;
            color: #333;
            font-size: 22px;
            font-family: 'Poiret One';
            font-weight: 700;
            z-index: 4;
        }

        .h12 {
            top: 30px;
            left: 50%;
            margin-left: -9px;
        }

        .h3 {
            top: 140px;
            right: 30px;
        }

        .h6 {
            bottom: 30px;
            left: 50%;
            margin-left: -5px;
        }

        .h9 {
            left: 32px;
            top: 140px;
        }

        .diallines {
            position: absolute;
            z-index: 2;
            width: 2px;
            height: 15px;
            background: #666;
            left: 50%;
            margin-left: -1px;
            transform-origin: 50% 150px;
        }

        .diallines:nth-of-type(5n) {
            position: absolute;
            z-index: 2;
            width: 4px;
            height: 25px;
            background: #666;
            left: 50%;
            margin-left: -1px;
            transform-origin: 50% 150px;
        }

        .info {
            position: absolute;
            width: 120px;
            height: 20px;
            border-radius: 7px;
            background: #ccc;
            text-align: center;
            line-height: 20px;
            color: #000;
            font-size: 11px;
            top: 200px;
            left: 50%;
            margin-left: -60px;
            font-family: "Poiret One";
            font-weight: 700;
            z-index: 3;
            letter-spacing: 3px;
            margin-left: -60px;
            left: 50%;
        }

        .date {
            top: 80px;
        }

        .day {
            top: 200px;
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
    <div class="clock">
        <div>
            <div class="info date"></div>
            <div class="info day"></div>
        </div>
        <div class="dot"></div>
        <div>
            <div class="hour-hand"></div>
            <div class="minute-hand"></div>
            <div class="second-hand"></div>
        </div>
        <div>
            <span class="h3">3</span>
            <span class="h6">6</span>
            <span class="h9">9</span>
            <span class="h12">12</span>
        </div>
        <div class="diallines"></div>

    </div>
    <br>

    <br>
    <br>

    <div style="margin: auto;padding:5%">
        <button class="btn btn-primary" onclick="speakTime()">Speak</button>

        <h1 class="text-center mb-4">Alarm Clock</h1>
        <div class="alarm text-center mb-3">
            <div class="form-group">
                <input type="time" id="alarmTime" class="form-control mb-2" />
                <button id="setAlarm" class="btn btn-success">Set Alarm</button>
            </div>
            <p id="status" class="mt-2"></p>
        </div>
        <audio id="alarmSound" src="alarm.mp3" preload="auto"></audio>
    </div>
</body>
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
    var clockEl = document.getElementsByClassName('clock')[0];
    var lat, long, data; // Global variables to hold lat, long, and fetched data
    let timezone; // Define timezone variable globally

    for (var i = 1; i < 60; i++) {
        clockEl.innerHTML += "<div class='diallines'></div>";
        var dialLines = document.getElementsByClassName('diallines');
        dialLines[i].style.transform = "rotate(" + 6 * i + "deg)";
    }

    // Get user's location and update lat and long
    navigator.geolocation.getCurrentPosition(async (position) => {
        lat = position.coords.latitude;
        long = position.coords.longitude;

        // Fetch the initial time data
        await fetchTimeData();
        // Start the clock
        setInterval(clock, 1000);
    });

    // Function to fetch time data based on lat and long
    async function fetchTimeData() {
        if (lat !== undefined && long !== undefined) {
            const response = await fetch(`https://api.ipgeolocation.io/timezone?apiKey=b970e638b5da4e2884f5686b0aaaf904&lat=${lat}&long=${long}`);
            data = await response.json();
            timezone = data.timezone; // Update the timezone variable with fetched data
            console.log(data);
        }
    }

    function clock() {
        // Fetch updated time data each second
        fetchTimeData().then(() => {
            if (!data) return; // If data is not fetched yet, return

            var weekday = [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday"
                ],
                currentTime = moment().tz(timezone), // Use moment with timezone
                h = currentTime.hours(),
                m = currentTime.minutes(),
                s = currentTime.seconds(),
                date = currentTime.date(),
                month = currentTime.month() + 1,
                year = currentTime.year(),

                hDeg = h * 30 + m * (360 / 720),
                mDeg = m * 6 + s * (360 / 3600),
                sDeg = s * 6,

                hEl = document.querySelector('.hour-hand'),
                mEl = document.querySelector('.minute-hand'),
                sEl = document.querySelector('.second-hand'),
                dateEl = document.querySelector('.date'),
                dayEl = document.querySelector('.day');

            var day = weekday[currentTime.day()];

            if (month < 10) {
                month = "0" + month;
            }

            hEl.style.transform = "rotate(" + hDeg + "deg)";
            mEl.style.transform = "rotate(" + mDeg + "deg)";
            sEl.style.transform = "rotate(" + sDeg + "deg)";
            dateEl.innerHTML = date + "/" + month + "/" + year;
            dayEl.innerHTML = day;
        });
    }

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

</html>