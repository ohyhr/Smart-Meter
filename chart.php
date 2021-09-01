
<!DOCTYPE html>
<html lang="en" style="width:1280px;height:720px;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hub</title>
    <link rel="stylesheet" href="styles/styles.css">

    <?php
    include ('functions.php');
    $todayweather = weatherAPI(time());
    //        echo "<br>Today's Weather: ".getSummary($todayweather)."<br>";
    if (getSummary($todayweather) == "clear") {
        echo "<style> body {background-image:url(images/clear-day.jpg);} </style>";
    }
    elseif (getSummary($todayweather) == "rain") {
        echo "<style> body {background-image:url(images/rain.jpg);} </style>";
    }
    elseif (getSummary($todayweather) == "snow") {
        echo "<style> body {background-image:url(images/snow.jpg);} </style>";
    }
    elseif (getSummary($todayweather) == "wind") {
        echo "<style> body {background-image:url(images/wind.jpg);} </style>";
    }
    elseif (getSummary($todayweather) == "fog") {
        echo "<style> body {background-image:url(images/fog.jpg);} </style>";
    }
    elseif (getSummary($todayweather) == "cloudy") {
        echo "<style> body {background-image:url(images/cloudy.jpg);} </style>";
    }
    else {
        echo "<style> body {background-color: white;}</style>";
    }
    ?>
</head>
<body>
<div class="row header">
    <img style="height:50px" onclick="window.location.href = 'comparison.php';" src="/Images/up-button.png">
</div>
<div class="row middle-row">

</div>

<div class="row buttons">

</div>
</body>
</html>
