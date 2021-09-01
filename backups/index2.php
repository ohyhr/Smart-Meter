<?php
    include('functions.php');
    changeJson(file_get_contents("getData.json"));
?>
<!DOCTYPE html>
<html lang="en" style="width:1280px;height:720px;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hub</title>
    <link rel="stylesheet" href="../styles/styles.css">
    <?php
        $todayweather = weatherAPI(time());
//        echo "<br>Today's Weather: ".getSummary($todayweather)."<br>";
        if (getSummary($todayweather) == "clear") {
            echo "<style> body {background-image:url(../images/clear-day.jpg);} </style>";
        }
        elseif (getSummary($todayweather) == "rain") {
            echo "<style> body {background-image:url(../images/Rain.jpg);} </style>";
        }
        elseif (getSummary($todayweather) == "snow") {
            echo "<style> body {background-image:url(../images/Snow.jpg);} </style>";
        }
        elseif (getSummary($todayweather) == "wind") {
            echo "<style> body {background-image:url(../images/Wind.jpg);} </style>";
        }
        elseif (getSummary($todayweather) == "fog") {
            echo "<style> body {background-image:url(../images/Fog.jpg);} </style>";
        }
        elseif (getSummary($todayweather) == "cloudy") {
            echo "<style> body {background-image:url(../images/cloudy.jpg);} </style>";
        }
        else {
            echo "<style> body {background-color: white;}</style>";
        }
    ?>
</head>
<body>
<div class="row header">
    <h1 id="temperature" style="font-size:80px;">
        <?php
            $todayweather = weatherAPI(time());
            echo "".getTemperature($todayweather)."°C";
        ?>
    </h1>
</div>
<div class="row middle-row">
    <div class="content">
        <h1>Current Usage</h1>
        <h2>Electricity</h2>
        <p>
            <?php
                $elec = getLiveElec();
            ?>
        </p>
        <h2>Gas</h2>
        <p>
            <?php
            $gas = getLiveGas();
            ?>
        </p>
    </div>
        <div class="content">
            <h1>Estimated Energy Bill</h1>
            <h2>Electricity</h2>
            <p>
                <?php
                $eleccost = energyTariff($elec);
                ?>
            </p>
            <h2>Gas</h2>
            <p>
                <?php
                $gascost = gasTariff($gas);
                ?>
            </p>
        </div>
</div>

<div class="row buttons">
    <img style="height:150px" onclick="window.location.href = 'comparison.php';" src="/Images/comparison-button.png">
    <img style="height:150px" onclick="window.location.href = 'predicted.php';" src="Images/PowerUsage-button.png">
</div>
</body>
</html>