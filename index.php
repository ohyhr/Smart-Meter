<?php
    include ('functions.php');
    changeJson(file_get_contents("getData.json"));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hub</title>
    <link rel="stylesheet" href="styles/main.css">
    <?php
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
<div class="grid-container">
    <header>
        <h1>
            <?php
            $todayweather = weatherAPI(time());
            echo "".getTemperature($todayweather)."°C";
            ?>
        </h1>
    </header>
    <section class="usage">
        <h1>Current Energy Usage</h1>
        <h2>Electricity:
            <?php
            $elec = getLiveElec();
            ?> </h2>
        <h2>Gas:
            <?php
            $gas = getLiveGas();
            ?> </h2>
    </section>
    <section class="bill">
        <h1>Estimated Energy Bill</h1>
        <h2>Electricity:
            <?php
            $eleccost = energyTariff($elec);
            ?> </h2>
        <h2>Gas:
            <?php
            $gascost = gasTariff($gas);
            ?> </h2>
    </section>
    <section class="buttons">
            <img class="comparison" onclick="window.location.href = 'comparison.php';" src="/Images/comparison-button.png" alt="Comparison">
            <img class="predicted" onclick="window.location.href = 'predicted.php';" src="Images/PowerUsage-button.png" alt="Predicted">
    </section>
</div>
</body>
</html>