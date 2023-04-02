<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
      *{
        box-sizing: border-box;
      }
      body{
        background-color: #a6cdd7;
        background-image: linear-gradient(315deg, #cad7eb 0%, #d4f3f3 100%);
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
        margin: 0;
      }
      .quiz-container{
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 0 10px 2px rgba(100, 100, 100, 0.1);
        width: auto;
        overflow: hidden;
      }
      .quiz-header{
        padding: 4rem;
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
      .input-box{
          background-color: #ffffff;
          position: relative;
          margin: 30px 0;
          width: 310px;
          border-bottom: 2px solid #000000;
      }
      .input-box label{
        position: absolute;
        top: 25%;
        left: 5px;
        transform: translateY(25%);
        color: #000000;
        font-size: 1em;
        pointer-events: none;
        transition: .5s;
      }
      input:focus ~ label,
      input:valid ~ label{
        top: -10px;
      }
      .input-box input{
        width: 100px;
        height: 50px;
        background: transparent;
        border: none;
        outline: none;
        font-size: 1em;
        padding-top: 35px;
        padding-right: 5px;
        padding-bottom: 13px;
        padding-left: 5px;
        color: #000000;
      }
      .input-box ion-icon{
        position: absolute;
        right: 8px;
        color: #000000;
        font-size: 1.5em;
        top: 20px;
      }
    </style>
</head>
<body>
    <div class="quiz-container" id="quiz">
    <div class="quiz-header">
      <h2>Usability Test</h2>
      <form method="post" action="/intro">
          @csrf
        <div class="input-box">
          <ion-icon name="person-circle-outline"></ion-icon>
          <input id="name" name="name" type="text" required>
          <label for="">Nama</label>
        </div>
          <button id="submit">Submit</button>
    </form>
    </div>
  </div>
</body>
</html>
