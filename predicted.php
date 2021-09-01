<?php
include ('functions.php');
changeJson(file_get_contents("getData.json"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Predicted</title>
    <link rel="stylesheet" href="styles/main.css">
    <?php
    $tommorowweather = weatherAPI(time()+86400);
    if (getSummary($tommorowweather) == "clear") {
        echo "<style> body {background-image:url(images/clear-day.jpg);} </style>";
    }
    elseif (getSummary($tommorowweather) == "rain") {
        echo "<style> body {background-image:url(images/rain.jpg);} </style>";
    }
    elseif (getSummary($tommorowweather) == "snow") {
        echo "<style> body {background-image:url(images/snow.jpg);} </style>";
    }
    elseif (getSummary($tommorowweather) == "wind") {
        echo "<style> body {background-image:url(images/wind.jpg);} </style>";
    }
    elseif (getSummary($tommorowweather) == "fog") {
        echo "<style> body {background-image:url(images/fog.jpg);} </style>";
    }
    elseif (getSummary($tommorowweather) == "cloudy") {
        echo "<style> body {background-image:url(images/cloudy.jpg);} </style>";
    }
    else {
        echo "<style> body {background-color: white;}</style>";
    }
    ?>
</head>
<body>
<div class="grid-container-predicted">
    <header class="back-button">
        <img class="up-button" onclick="window.location.href = 'index.php';" src="/Images/up-button.png" alt="Back">
    </header>
    <section class="meter">
        <?php
                    $todayweather = weatherAPI(time());
                    $yesterday = getYesterdayDate();
                    $yesterdayweather = weatherAPI(time()-86400);
                    $tommorowweather = weatherAPI (time()+86400);
                    $predicted = round(compareUsage(getTemperature($yesterdayweather),
                            getPastElec($yesterday,"00:00:00",$yesterday,"23:00:00","PT1H","ELEC"),
                            getTemperature($tommorowweather)),2)." kWh";;

                    if ($predicted < 15) {
                        echo "<img src='images/low-meter.png')>";
                    }
                    elseif ($predicted < 40) {
                        echo "<img src='images/medium-meter.png')>";
                    }
                    elseif ($predicted < 999) {
                        echo "<img src='images/high-meter.png')>";
                    }
                    ?>
    </section>
    <section class="predicted-usage">
        <h1>Predicted Energy Usage for Tomorrow</h1>
        <h2>Electricity:
            <?php
            $todayweather = weatherAPI(time());
            $yesterday = getYesterdayDate();
            $yesterdayweather = weatherAPI(time()-86400);
            $tommorowweather = weatherAPI (time()+86400);
            echo "".round(compareUsage(getTemperature($yesterdayweather),
                    getPastElec($yesterday,"00:00:00",$yesterday,"23:00:00","PT1H","ELEC"),
                    getTemperature($tommorowweather)),2)." kWh";
            ?> </h2>
    </section>
</div>
</body>
</html>