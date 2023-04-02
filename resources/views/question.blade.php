<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
      document.addEventListener('DOMContentLoaded', function() {
          // STOPWATCH
          const stopwatch = document.getElementById('clock');

          // INITIALIZE STOPWATCH VARIABLE
          let seconds = 0;

          function updateStopwatch() {
              seconds++;

              stopwatch.innerHTML = `${seconds.toString().padStart(2, '0')}`;
            }

            window.onload = function() {
                timer = setInterval(updateStopwatch, 1000);
            }

            // GET AND VALIDATE IMAGE COORDINATES
            var img = document.getElementById('myImage');
            var x_start = {!! json_encode($question->x_start) !!};
            var x_end = {!! json_encode($question->x_end) !!};
            var y_start = {!! json_encode($question->y_start) !!};
            var y_end = {!! json_encode($question->y_end) !!};
            const myButton = document.getElementById("submit");

            img.addEventListener('click', function(e){
              var pos = img.getBoundingClientRect();
              var x = e.clientX - pos.left;
              const y = e.clientY - pos.top;

              if(x >= x_start && x<=x_end && y >= y_start && y<=y_end)
              {
                  console.log("Your Answer is Correct");
                  clearInterval(timer);
                  document.getElementById('time').value = seconds;
                  myButton.style.display = 'block';
              }
              console.log("x: " + x + " y: " + y);
            });
          });
    </script>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
      *{
        box-sizing: border-box;
      }
      body{
        background-color: #b8c6db;
        background-image: linear-gradient(315deg, #b8c6db 0%, #f5f7f7 100%);
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
        margin: 0;
      }
      .quiz-container{
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px 2px rgba(100, 100, 100, 0.1);
        width: auto;
        overflow: hidden;
      }
      .quiz-header
      {
          padding: 4rem;
          max-width: 800px;
          text-align: center;
      }
      h2{
        padding: 1rem;
        text-align: center;
        margin: 0;
      }
      button{
        background-color: #03cae4;
        color: #fff;
        border: none;
        display: block;
        width: 100%;
        cursor: pointer;
        font-size: 1.1rem;
        font-family: inherit;
        padding: 1.3rem;
      }
      button:hover{
        background-color: #04adc4;
      }
      button:focus{
        outline: none;
        background-color: #44b927;
      }
      img {
          margin-top: 30px;
      }
    </style>
</head>
<body>
    <div class="quiz-container" id="quiz">
        <div class="quiz-header">
            <p>{{$question->question}}</p>
            <p>Waktu Jawab :</p>
            <p id="clock">00</p>
            <img id="myImage" src="{{$question->question_img}}" alt="test_image" width="640" height="360">
        </div>
        <form method="post" action="{{ route('questions.store', ['questionIndex' => $nextQuestionIndex])}}">
            @csrf
            <input type="hidden" name="time" id="time">
            <button id="submit" style="display: none">Submit</button>
        </form>
  </div>
</body>
</html>
