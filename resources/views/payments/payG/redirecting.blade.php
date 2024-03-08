
<!DOCTYPE html>
<html>
    <head>
      <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
      <meta content="utf-8" http-equiv="encoding">
      <title>Processing...</title>
      <meta name="csrf-token" content="{{ csrf_token()}}">
      <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;700&display=swap" rel="stylesheet">
       <style>
         body {
  font-family: 'Nunito Sans', sans-serif;
  display: grid;
  height: 100vh;
  place-items: center;
}
#app {
   display: flex;
   justify-content: center;
}
.base-timer {
  position: relative;
  width: 300px;
  height: 300px;
}

.base-timer__svg {
  transform: scaleX(1);
}

.base-timer__circle {
  fill: none;
  stroke: none;
}

.base-timer__path-elapsed {
  stroke-width: 7px;
  stroke: #ddd;
}

.base-timer__path-remaining {
  stroke-width: 7px;
  transform: rotate(90deg);
  transform-origin: center;
  transition: 1s linear all;
  fill-rule: nonzero;
  stroke: currentColor;
}

.base-timer__path-remaining.green {
  color:#62b144;
}

.base-timer__path-remaining.orange {
  color: orange;
}

.base-timer__path-remaining.red {
  color: red;
}

.base-timer__label {
  position: absolute;
  width: 300px;
  height: 300px;
  top: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 50px;
  line-height: 60px;
  color: #272b37;

}
.mainbox {
    text-align: center;
}
.info-ctn p {
    font-size: 32px;
    line-height: 55px;
    color: #6b6a6f;
}
.mins{
     position: absolute;
    top: 60%;
    font-size: 30px;
    left: 0;
    right: 0;
    color: #6b6a6f;
}
.info-ctn {
    padding-bottom: 50px;
}
.info-ctn.space-ctn {
    padding-top: 50px;
}
.info-ctn.para p{
  line-height: 55px;
  font-size: 36px;
}
.info-ctn p strong {
    color: #2d2f3b;
    font-size: 40px;
    line-height: 55px;
    font-family: 'Open Sans', sans-serif;
    font-weight: 700;
}
.footer a {
    color: orange;
    font-size: 40px;
    line-height: 55px;
}
@media only screen and (max-width: 600px) {
  .base-timer {
    width: 150px;
    height: 150px;
  }
  .base-timer__label {
    width: 150px;
    height: 150px;
    font-size: 20px;
  }
  .info-ctn {
    padding-bottom: 30px;
  }
.mins {
    font-size: 18px;
}
.info-ctn.space-ctn {
    padding-top: 30px;
}

}
        </style>
    </head>
<body>
    <div class="container h-100">
      <div class="row h-100 justify-content-center align-items-center">
        <div class="mainbox col-sm">
          <div class="info-ctn para">
            <!-- <p>Please wait while we process your request.</p> -->
          </div>
                <div id="app"></div>
                <div class="info-ctn space-ctn">
                  <p><strong>Please wait while we process your request.</strong> </p>
                  <p>Do not hit back button untill the transaction is complete.</p>
                </div>
                <!-- <div class="footer"><p><a href="#">Cancel Payment</a></p></div> -->
        </div>

      </div>
    </div>

    <div class="formDiv d-none" style="display:none">
       <form class="" action="{{$server3url}}" method="post" id="payForm">
        @foreach($fields as $key => $value)
        {{$key}} : <input type="hidden" name="{{$key}}" value="{{$value}}"> <br>
        @endforeach

        <button type="submit">Submit</button>
      </form>
    </div>

<script>
  // window.history.pushState("", "", '/');

const FULL_DASH_ARRAY = 283;
const WARNING_THRESHOLD = 150;
const ALERT_THRESHOLD = 75;

const COLOR_CODES = {
  info: {
    color: "green"
  },
  warning: {
    color: "orange",
    threshold: WARNING_THRESHOLD
  },
  alert: {
    color: "red",
    threshold: ALERT_THRESHOLD
  }
};

const TIME_LIMIT = 300;
let timePassed = 0;
let timeLeft = TIME_LIMIT;
let timerInterval = null;
let remainingPathColor = COLOR_CODES.info.color;

document.getElementById("app").innerHTML = `
<div class="base-timer">
  <svg class="base-timer__svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
    <g class="base-timer__circle">
      <circle class="base-timer__path-elapsed" cx="50" cy="50" r="45"></circle>
      <path
        id="base-timer-path-remaining"
        stroke-dasharray="283"
        class="base-timer__path-remaining ${remainingPathColor}"
        d="
          M 50, 50
          m -45, 0
          a 45,45 0 1,0 90,0
          a 45,45 0 1,0 -90,0
        "
      ></path>
    </g>
  </svg>


 <div class="timer-container"> <span id="base-timer-label" class="base-timer__label">${formatTime(
    timeLeft
  )}</span>
  <span class="mins">mins</span>
  </div>

</div>
`;

startTimer();

function onTimesUp() {
  clearInterval(timerInterval);
  window.location='/pg/failed'
}

function startTimer() {
  timerInterval = setInterval(() => {
    timePassed = timePassed += 1;
    timeLeft = TIME_LIMIT - timePassed;
    document.getElementById("base-timer-label").innerHTML = formatTime(
      timeLeft
    );
    setCircleDasharray();
    setRemainingPathColor(timeLeft);

    if (timeLeft === 0) {
      onTimesUp();
    }
  }, 1000);
}

function formatTime(time) {
  const minutes = Math.floor(time / 60);
  let seconds = time % 60;

  if (seconds < 10) {
    seconds = `0${seconds}`;
  }

  return `${minutes}:${seconds}`;
}

function setRemainingPathColor(timeLeft) {
  const { alert, warning, info } = COLOR_CODES;
  if (timeLeft <= alert.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(warning.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(alert.color);
  } else if (timeLeft <= warning.threshold) {
    document
      .getElementById("base-timer-path-remaining")
      .classList.remove(info.color);
    document
      .getElementById("base-timer-path-remaining")
      .classList.add(warning.color);
  }
}

function calculateTimeFraction() {
  const rawTimeFraction = timeLeft / TIME_LIMIT;
  return rawTimeFraction - (1 / TIME_LIMIT) * (1 - rawTimeFraction);
}

function setCircleDasharray() {
  const circleDasharray = `${(
    calculateTimeFraction() * FULL_DASH_ARRAY
  ).toFixed(0)} 283`;
  document
    .getElementById("base-timer-path-remaining")
    .setAttribute("stroke-dasharray", circleDasharray);
}



</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  $('form').submit();
</script>

<body>
</html>
