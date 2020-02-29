<!DOCTYPE HTML>
<html lang="pl">

<head>
    <title>Zadanie - speed</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div id="strona">
        <div id="header">
            <img src="" alt="">
        </div>

        <div id="content">
            <div id="flexbox">
                <div class="flex">
                    <h1>Speed</h1>

<!-- PHP -->
<?php
    $jednostka = new mysqli('localhost', 'zlotowska', 'zaq1', 'rekrut');
    $jednostka->query('SET NAMES utf8');
    $results=$jednostka->query('SELECT trips.id from trips;'); 
    $rows=mysqli_num_rows($results);
    echo '<p>Aktualna liczba tripów: '.$rows.'</p>';
    // Pętla dla każdego z 3 tripów
    echo "<table><tr><td>Trip</td><td>Distance</td><td>Measure Interval</td><td>AVG speed</td><td>MAX speed</td></tr>";                    
    for ($m=0; $m<$rows; $m++)
    {   $id=$m+1;
        $wywolanie="SELECT distance from trip_measures WHERE trip_measures.trip_id=$id;";
        $result_loop=$jednostka->query($wywolanie);
        $row_loop=mysqli_num_rows($result_loop);
        $tablica_loop[0]=0;
        $x=0;
        // Tworzenie tablicy tymczasowej na distance z trip o określonym id
        while($wyni=$result_loop->fetch_assoc())
            {
                $tablica_loop[$x]=$wyni['distance']; 
                $x++;
            }
        // Obliczanie średnich prędkości
        $tab_result[0]=0;
        $max=0;
        $distance[0]=0;
        $dl_tab=count($tablica_loop);
     echo $dl_tab;
        for ($i=0; $i<$dl_tab-1; $i+=1)
            {
                $numer=$i+1;
                $czas_ob=$jednostka->query("SELECT trips.measure_interval from trips WHERE trips.id=$id;");
                $czas=$czas_ob->fetch_assoc();
                $tab_result[$i]=(3600*($tablica_loop[$numer]-$tablica_loop[$i]))/$czas['measure_interval'];
                if ($tab_result[$i]>$max)
                {
                    $max=$tab_result[$i];
                    $max=round($max);
                }
                $distance[$m]=$tablica_loop[$numer];
                
            }
            $suma=0;
            for ($i=0; $i<count($tab_result); $i++)
                {
                    $suma=$suma+$tab_result[$i];
                }
            $srednia=$suma/count($tab_result);
     // Wyświetlanie rzędu tabeli, finally
     
     echo " <tr>
            <td>Trip $id</td>
            <td>".$distance[$m]."</td>
            <td>".$czas['measure_interval']."</td>
            <td>$srednia</td>
            <td>$max</td>
            </tr>";
    }
    echo "</table></div></div></div></div></body></html>";
?>

</div></div></div></div></body></html>
                        
