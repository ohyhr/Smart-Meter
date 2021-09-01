<!DOCTYPE html>
<html lang="en" style="width:1280px;height:720px;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hub</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
<form>
    <?php
    include 'functions.php';
    $elec = getLiveElec();
    $gas = getLiveGas();


    $eleccost = energyTariff($elec);
    $gascost = gasTariff($gas);




    $yesterday = getYesterdayDate();
    echo "Yesterday's Total Elec Usage: ".getPastElec($yesterday,"00:00:00",$yesterday,"23:00:00","PT1H","ELEC")."<br>";
    echo "Yesterday's Total Gas Usage: ".getPastGas($yesterday,"00:00:00",$yesterday,"23:00:00","PT1H","GAS");

    $tommorowweather = weatherAPI(time()+86400);
    $todayweather = weatherAPI(time());
    $yesterdayweather = weatherAPI(time()-86400);

    echo "<br>Today's Weather: ".getSummary($todayweather)."<br>";
    echo "Current Temperature: ".getTemperature($todayweather);
    echo "<br>Tommorow's Weather: ".getSummary($tommorowweather)."<br>";
    echo "Tommorow's Temperature: ".getTemperature($tommorowweather);
    echo "<br>Yesterday's Weather: ".getSummary($yesterdayweather)."<br>";
    echo "Yesterday's Temperature: ".getTemperature($yesterdayweather)."<br>";



    echo "<br>"."Tommorow's Estimated Elec Usage: ".round(compareUsage(getTemperature($yesterdayweather),
            getPastElec($yesterday,"00:00:00",$yesterday,"23:00:00","PT1H","ELEC"),
            getTemperature($tommorowweather)),2.)."<br>";


    changeJson(file_get_contents("getData.json"));
    ?>
    <br>
    <input type="button" onclick="window.location.href = 'chart.php';" value="Chart"/>
</form>

</body>
</html>