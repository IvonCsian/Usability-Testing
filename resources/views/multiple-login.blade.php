<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiple Login Detected</title>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&display=swap');
      *{
        box-sizing: border-box;
      }
      body{
        background-color: #a6cdd7;
        background-image: linear-gradient(315deg, #0081a7 30%, #00afb9 70%);
        font-family: 'Poppins', sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        overflow: hidden;
        margin: 0;
      }
      .outro-box{
        width: auto;
        background: #fff;
        border-radius: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        padding: 0 30px 30px;
        color: #333;
      }
      .outro-box img{
        width: 100px;
        margin-top: -50px;
        border-radius: 50%;
        object-position: top;
        color: #2c8a0f;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        padding-top: 5px;
        padding-left: 5px;
        padding-bottom: 5px;
        padding-right: 5px;
      }
      .outro-box button{
        width: 100%;
        margin-top: 50px;
        padding: 10px 0;
        background: #03cae4;
        color: #fff;
        border: 0;
        outline: none;
        font-size: 15px;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
      }
      .outro-box button:hover{
        background-color: #04adc4;
      }
    </style>
</head>
<body>
        <div class="outro-box">
            <img src="https://cdn.discordapp.com/attachments/886646657784098879/1097167078345166928/false.png">
            <h2 id="outro-1">Oops!</h2>
            <p class="teks-2">{{$message}}</p>
            <button type="button" onclick="window.location.href='/auth/admin'">Kembali ke Halaman Login</button>
        </div>
</body>
</html>
