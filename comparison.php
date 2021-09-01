<?php
    include ('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var jsonData = $.ajax({
                url: "getData.php",
                dataType: "json",
                async: false
            }).responseText;
            var options = {'title':"Last Week's Energy Breakdown",
                'width':400,
                'height':300};
            var data = new google.visualization.DataTable(jsonData);
            var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }

    </script>
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
<div class="grid-container-comparison">
    <header class="back-button2">
        <img class="up-button" onclick="window.location.href = 'index.php';" src="/Images/up-button.png" alt="Back">
    </header>
    <section class="today">
        <h1>Today's Energy Usage</h1>
        <h2>Electricity:
            <?php
            $elec = getLiveElec();
            ?> </h2>
        <h2>Gas:
            <?php
            $gas = getLiveGas();
            ?> </h2>
    </section>
    <section class="yesterday">
        <h1>Yesterdays Energy Usage</h1>
        <h2>Electricity:
            <?php
            $yesterday = getYesterdayDate();
            echo "".getPastElec($yesterday,"00:00:00",$yesterday,"23:00:00","PT1H","ELEC")." kWh";
            ?> </h2>
        <h2>Gas:
            <?php
            $yesterday = getYesterdayDate();
            echo "".getPastGas($yesterday,"00:00:00",$yesterday,"23:00:00","PT1H","GAS")." kWh";
            ?> </h2>
    </section>
    <section class="graph">
        <div id="chart_div"></div>
    </section>
</div>
</body>
</html>