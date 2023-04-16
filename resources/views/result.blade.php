<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
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
            <img src="https://cdn.discordapp.com/attachments/1039521075580645486/1092325807843725372/404-tick.png">
            <h2 id="outro-1">Terima Kasih! {{$name}}</h2>
            <p class="teks-2">Jawaban Anda telah tersimpan</p>
            @php
                $seconds = $total_time ?? 0;

                $hours = floor($seconds / 3600); // Get the number of hours
                $minutes = floor(($seconds % 3600) / 60); // Get the number of minutes
                $seconds = $seconds % 60; // Get the number of seconds

                // Check if the number of minutes exceeds 60
                if ($minutes >= 60) {
                    $hours += floor($minutes / 60);
                    $minutes = $minutes % 60;
                }

                // Check if the number of seconds exceeds 60
                if ($seconds >= 60) {
                    $minutes += floor($seconds / 60);
                    $seconds = $seconds % 60;
                }

                // Format the result
                if ($hours > 0) {
                    $time = sprintf('%02d Jam, %02d Menit, %02d Detik', $hours, $minutes, $seconds);
                } else if ($minutes) {
                    $time = sprintf('%02d Menit, %02d Detik', $minutes, $seconds);
                } else {
                    $time = sprintf('%02d Detik', $seconds);
                }
            @endphp
            <p class="teks-3">Waktu Pengerjaan Anda</p>
            <h3>{{$time}}</h3>
            <button type="button" onclick="window.location.href='/'">Kembali ke Halaman Utama</button>
        </div>
</body>
</html>
