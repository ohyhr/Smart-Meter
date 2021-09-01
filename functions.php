<?php

function printArray($array)
{
    foreach ($array as $item)
    {
        if (is_int($item))
        {
            epochConverter($item);
        }
        else {
           echo "$item <br>";
        }

    }
}

function printArrayInArray($array)
{

    for ($x = 0; $x <= count($array['data']['data'])-1; $x++)
    {
        printArray($array['data']['data'][$x]);

    }
}
 function epochConverter($epoch)
 {
     $dt = new DateTime("@$epoch");
     echo $dt->format('d-m-y H:i:s');
     echo "<br>";

 }

 function getElec($datefrom,$timefrom,$dateto,$timeto,$period,$type)
 {
     $url = "https://adhocapi.energyhive.com/hive/ac89ccdce8e878e227a93f050413c7d8/type/".$type."/?units=kWh&from=".$datefrom."T".$timefrom."&to=".$dateto."T".$timeto."&offset=-0&period=".$period."&function=sum";
     //echo $url;
     $apiKey = '78c4da90ba4a93adc4f50e89427caef9';
     $headers = array(
         'X-Auth-Token: '.$apiKey
     );

     $ch = curl_init($url);

     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

     $response = curl_exec($ch);
     if ($response === false)
     {
         print_r('Curl error: ' . curl_error($ch));
     }

     curl_close($ch);


     $results = json_decode($response, true);
     //echo '<pre>' . print_r($results, true) . '</pre>';
     //printArrayinArray($results);
     return $results;
 }

 function getLiveElec()
 {
     date_default_timezone_set('Europe/London');
     $today = date('Y-m-d');
     $now = date('H:i:s');
     $array = getElec($today,"00:00:00",$today,$now,"PT1H","ELEC");

     $counter = 0;
     for ($x = 0; $x <= count($array['data']['data'])-1; $x++)
     {
         $counter = $counter + ($array['data']['data'][$x][1]);

     }
     $counter = round($counter,2);
     echo "".$counter." kWh";
     return $counter;
 }

function getGas($datefrom,$timefrom,$dateto,$timeto,$period,$type)
{
    $url = "https://adhocapi.energyhive.com/hive/ac89ccdce8e878e227a93f050413c7d8/type/".$type."/?units=kWh&from=".$datefrom."T".$timefrom."&to=".$dateto."T".$timeto."&offset=-0&period=".$period."&function=sum";
    //echo $url;
    $apiKey = '78c4da90ba4a93adc4f50e89427caef9';
    $headers = array(
        'X-Auth-Token: '.$apiKey
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    if ($response === false)
    {
        print_r('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);


    $results = json_decode($response, true);
    //echo '<pre>' . print_r($results, true) . '</pre>';
    //printArrayinArray($results);
    return $results;
}

function getLiveGas()
{
    date_default_timezone_set('Europe/London');
    $today = date('Y-m-d');
    $now = date('H:i:s');
    $array = getGas($today,"00:00:00",$today,$now,"PT1H","GAS");

    $counter = 0;
    for ($x = 0; $x <= count($array['data']['data'])-1; $x++)
    {
        $counter = $counter + ($array['data']['data'][$x][1]);

    }
    $counter = round($counter,2);
    echo "".$counter. " kWh";
    return $counter;
}

function getYesterdayDate()
{
    $today = time();
    echo "";
    //echo "Todays epoch ".$today."<br>";
    $yesterdayepoch = $today - 86400;
    //echo "\n Yesterdays Epoch ".$yesterdayepoch."<br>";
    $yesterday = date('Y-m-d',$yesterdayepoch);
    //echo $yesterday;
    return $yesterday;

}

function getPastElec($datefrom,$timefrom,$dateto,$timeto,$period,$type)
{
    $url = "https://adhocapi.energyhive.com/hive/ac89ccdce8e878e227a93f050413c7d8/type/".$type."/?units=kWh&from=".$datefrom."T".$timefrom."&to=".$dateto."T".$timeto."&offset=-0&period=".$period."&function=sum";
    //echo $url;
    $apiKey = '78c4da90ba4a93adc4f50e89427caef9';
    $headers = array(
        'X-Auth-Token: '.$apiKey
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    if ($response === false)
    {
        print_r('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);


    $results = json_decode($response, true);
    //echo '<pre>' . print_r($results, true) . '</pre>';
    //printArrayinArray($results);
    $counter = 0;
    for ($x = 0; $x <= count($results['data']['data'])-1; $x++)
    {
        $counter = $counter + ($results['data']['data'][$x][1]);
        //echo $counter;

    }

    return round($counter,2);
}

function getPastGas($datefrom,$timefrom,$dateto,$timeto,$period,$type)
{
    $url = "https://adhocapi.energyhive.com/hive/ac89ccdce8e878e227a93f050413c7d8/type/".$type."/?units=kWh&from=".$datefrom."T".$timefrom."&to=".$dateto."T".$timeto."&offset=-0&period=".$period."&function=sum";
    //echo $url;
    $apiKey = '78c4da90ba4a93adc4f50e89427caef9';
    $headers = array(
        'X-Auth-Token: '.$apiKey
    );

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    if ($response === false)
    {
        print_r('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);


    $results = json_decode($response, true);
    //echo '<pre>' . print_r($results, true) . '</pre>';
    //printArrayinArray($results);
    $counter = 0;
    for ($x = 0; $x <= count($results['data']['data'])-1; $x++)
    {
        $counter = $counter + ($results['data']['data'][$x][1]);

    }
    return round($counter,2);
}

function energyTariff($usage)
{
    $costp = 25.001 + ($usage*20.001);
    $cost = $costp / 100;
    echo "";
    $cost = round($cost,2.);
    echo "£".$cost;
    return $cost;
}

function gasTariff($usage)
{
    $costp = 24.78 + ($usage*3.669);
    $cost = $costp / 100;
    echo "";
    $cost = round($cost,2.);
    echo "£".$cost;
    return $cost;
}

function weatherAPI($time)
{
    $url = "https://api.darksky.net/forecast/56d6cb57c78edf1b1615889a5f0c44fc/53.4864,2.2734,".$time."?exclude=minutely,hourly,daily,alerts,flags";
    //echo $url;
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($ch);
    if ($response === false)
    {
        print_r('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);


    $results = json_decode($response, true);
    //echo '<pre>' . print_r($results, true) . '</pre>';
    return $results;
}

function getSummary($array)
{
    $summary = $array['currently']['icon'];
    list($summary) = explode('-',$summary);
    if ($summary == "partly")
    {
        return "cloudy";
    }
    else
    {
        return $summary;
    }
}

function getTemperature($array)
{
    $temperature = $array['currently']['temperature'];
    $temperature = ($temperature - 32)*(5/9);
    return round($temperature,2.);
}

function compareUsage($yesterdaytemp,$yesterdayusage,$tommorowtemp)
{
    return ($yesterdayusage/$yesterdaytemp) *$tommorowtemp;
}



function getMon()
{
    $today = date('D');
    $counter = 1;
    //echo $today;
    switch($today) {
        case "Mon":
            $counter = 0;
            break;
        case "Tue":
            $counter = 1;
            break;
        case "Wed":
            $counter = 2;
            break;
        case "Thu":
            $counter = 3;
            break;
        case "Fri":
            $counter = 4;
            break;
        case "Sat":
            $counter = 5;
            break;
        case "Sun":
            $counter = 6;
            break;
    }
    $date = time() - (86400*$counter)-604800;
    //echo $date;
    $date = date('Y-m-d',$date);
    //echo $date;
    $result = getPastElec($date,"00:00:00",$date,"23:00:00","PT1H","ELEC");

    return $result;
}

function getTue()
{
    $today = date('D');
    $counter = 1;
    //echo $today;
    switch ($today) {
        case "Mon":
            $counter = -1;
            break;
        case "Tue":
            $counter = 0;
            break;
        case "Wed":
            $counter = 2;
            break;
        case "Thu":
            $counter = 3;
            break;
        case "Fri":
            $counter = 4;
            break;
        case "Sat":
            $counter = 5;
            break;
        case "Sun":
            $counter = 6;
            break;
    }
    $date = time() - (86400 * $counter) - 604800;
    // echo $date;
    $date = date('Y-m-d',$date);
    //echo $date;
    $result = getPastElec($date, "00:00:00", $date, "23:00:00", "PT1H", "ELEC");
    return $result;
}

function getWed()
{
    $today = date('D');
    $counter = 1;
    //echo $today;
    switch ($today) {
        case "Mon":
            $counter = -2;
            break;
        case "Tue":
            $counter = -1;
            break;
        case "Wed":
            $counter = 0;
            break;
        case "Thu":
            $counter = 1;
            break;
        case "Fri":
            $counter = 2;
            break;
        case "Sat":
            $counter = 3;
            break;
        case "Sun":
            $counter = 4;
            break;
    }
    $date = time() - (86400 * $counter) - 604800;
    // echo $date;
    $date = date('Y-m-d',$date);
    //echo $date;
    $result = getPastElec($date, "00:00:00", $date, "23:00:00", "PT1H", "ELEC");
    return $result;
}

function getThu()
{
    $today = date('D');
    $counter = 1;
    //echo $today;
    switch ($today) {
        case "Mon":
            $counter = -3;
            break;
        case "Tue":
            $counter = -2;
            break;
        case "Wed":
            $counter = -1;
            break;
        case "Thu":
            $counter = 0;
            break;
        case "Fri":
            $counter = 1;
            break;
        case "Sat":
            $counter = 2;
            break;
        case "Sun":
            $counter = 3;
            break;
    }
    $date = time() - (86400 * $counter) - 604800;
    // echo $date;
    $date = date('Y-m-d',$date);
   // echo $date;
    $result = getPastElec($date, "00:00:00", $date, "23:00:00", "PT1H", "ELEC");
    return $result;
}
function getFri()
{
    $today = date('D');
    $counter = 1;
    //echo $today;
    switch ($today) {
        case "Mon":
            $counter = -4;
            break;
        case "Tue":
            $counter = -3;
            break;
        case "Wed":
            $counter = -2;
            break;
        case "Thu":
            $counter = -1;
            break;
        case "Fri":
            $counter = 0;
            break;
        case "Sat":
            $counter = 1;
            break;
        case "Sun":
            $counter = 2;
            break;
    }
    $date = time() - (86400 * $counter) - 604800;
    // echo $date;
    $date = date('Y-m-d',$date);
    //echo $date;
    $result = getPastElec($date, "00:00:00", $date, "23:00:00", "PT1H", "ELEC");
    return $result;
}
function getSat()
{
    $today = date('D');
    $counter = 1;
    //echo $today;
    switch ($today) {
        case "Mon":
            $counter = -5;
            break;
        case "Tue":
            $counter = -4;
            break;
        case "Wed":
            $counter = -3;
            break;
        case "Thu":
            $counter = -2;
            break;
        case "Fri":
            $counter = -1;
            break;
        case "Sat":
            $counter = 0;
            break;
        case "Sun":
            $counter = 1;
            break;
    }
    $date = time() - (86400 * $counter) - 604800;

    $date = date('Y-m-d',$date);
    //echo $date;
    $result = getPastElec($date, "00:00:00", $date, "23:00:00", "PT1H", "ELEC");
    return $result;
}

function getSun()
{
    $today = date('D');
    $counter = 1;
    //echo $today;
    switch ($today) {
        case "Mon":
            $counter = -6;
            break;
        case "Tue":
            $counter = -5;
            break;
        case "Wed":
            $counter = -4;
            break;
        case "Thu":
            $counter = -3;
            break;
        case "Fri":
            $counter = -2;
            break;
        case "Sat":
            $counter = -1;
            break;
        case "Sun":
            $counter = 0;
            break;
    }
    $date = time() - (86400 * $counter) - 604800;
    // echo $date;
    $date = date('Y-m-d',$date);
    //echo $date;
    $result = getPastElec($date, "00:00:00", $date, "23:00:00", "PT1H", "ELEC");
    return $result;
}



function changeJson($string)
{
    $results = json_decode($string, true);
    $counter = 0;
    //echo '<pre>' . print_r($results, true) . '</pre>';
    for ($x = 0; $x <= count($results['rows'])-1; $x++)
    {
        if ($x == 0)
        {
            $results['rows'][$x]['c'][1]['v'] = getMon();
        }

        elseif ($x==1)
        {
            $results['rows'][$x]['c'][1]['v'] = getTue();
        }
        elseif ($x==2)
        {
            $results['rows'][$x]['c'][1]['v'] = getWed();
        }
        elseif ($x==3)
        {
            $results['rows'][$x]['c'][1]['v'] = getThu();
        }
        elseif ($x==4)
        {
            $results['rows'][$x]['c'][1]['v'] = getFri();
        }
        elseif ($x==5)
        {
            $results['rows'][$x]['c'][1]['v'] = getSat();
        }
        elseif ($x==6)
        {
            $results['rows'][$x]['c'][1]['v'] = getSun();
        }
    }
    //echo '<pre>' . print_r($results, true) . '</pre>';
    $fp = fopen('data.json','w');
    fwrite($fp, json_encode($results));
}








?>