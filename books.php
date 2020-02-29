<!DOCTYPE HTML>
<html lang="pl">

<head>
    <title>Zadanie - books and reviews</title>
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
                    <h1>Book</h1>

<!-- PHP -->
<?php
    $fraza=$_POST['fraza'];
    $zapytanie=explode("|", $fraza);
    $jednostka = new mysqli('localhost', 'zlotowska', 'zaq1', 'rekrut');
    $jednostka->query('SET NAMES utf8');
    $checkin="select books.id from books where books.name='$zapytanie[0]';";
    $results=$jednostka->query($checkin); 
//if
    $row = mysqli_num_rows($results);
    if ($row!=0)
    {
        $kwerenda="SELECT books.name, 
            books.book_date,
            AVG(CASE sex WHEN 'm' THEN reviews.age END) `avg-m`,
            AVG(CASE sex WHEN 'f' THEN reviews.age END) `avg-f`
            FROM     books, reviews
            WHERE books.name='$zapytanie[0]' and books.id=reviews.book_id and reviews.".$zapytanie[1].";";
        $result=$jednostka->query($kwerenda); 
        echo "<table><tr><td>Book</td><td>Compatibility</td><td>Book Date</td><td>Female AVG age</td><td>Male AVG age</td></tr><tr>";

        while ($wynik=$result->fetch_assoc())
        {
            echo "<td>".$wynik['name']."</td>";
            echo "<td>100%</td>";
            echo "<td>".$wynik['book_date']."</td>";
            echo "<td>".$wynik['avg-m']."</td>";
            echo "<td>".$wynik['avg-f']."</td>";
        }
        echo "</tr></table></div></div></div></div></body></html>";
        echo $kwerenda;
    } 
    else /*not found*/ 
    {
        $kwerenda2="SELECT books.name, 
             books.book_date,
             AVG(CASE sex WHEN 'm' THEN reviews.age END) `avg-m`,
             AVG(CASE sex WHEN 'f' THEN reviews.age END) `avg-f`
             FROM     books, reviews
             WHERE    reviews.".$zapytanie[1]." and books.id=reviews.book_id group by books.name;";
        $result=$jednostka->query($kwerenda2);

        echo "<table><tr><td>Book2</td><td>Compatibility</td><td>Book Date</td><td>Female AVG age</td><td>Male AVG age</td></tr>";
        $index=0;
        $tablica = array();
        $calling[0]='';
        while ($wynik=$result->fetch_assoc())
        {
        $compa[$index]=similar_text(mb_strtolower($zapytanie[0]), mb_strtolower($wynik['name']), $perc);
            echo "<tr>";
            echo "<td>".$wynik['name']."</td>";
            echo "<td>".round($perc,2)."</td>";
            echo "<td>".$wynik['book_date']."</td>";
            echo "<td>".$wynik['avg-m']."</td>";
            echo "<td>".$wynik['avg-f']."</td>";
            echo "</tr>";
            //
            $calling[$index]= "<tr><td>".$wynik['name']."</td><td>".round($perc,2)."</td><td>".$wynik['book_date']."</td><td>".$wynik['avg-m']."</td><td>".$wynik['avg-f']."</td></tr>";
            $poma[$index]=round($perc,2);
            $index++;
        }
        echo $perc[0];
        $tablica=array(
               "0" => array('podo'=>$poma[0], 'wywol'=>"$calling[0]"),
               "1" => array('podo'=>$poma[1], 'wywol'=>"$calling[1]"),
               "2" => array('podo'=>$poma[2], 'wywol'=>"$calling[2]"),
               "3" => array('podo'=>$poma[3], 'wywol'=>"$calling[3]"),
               "4" => array('podo'=>$poma[4], 'wywol'=>"$calling[4]"),
            );
        rsort($tablica);
        echo $kwerenda2;
        echo "<br><br>";
        
        echo "<p>Uprzedzam z góry, że algorytm działa tylko w przypadku 5 wyników zapytania - z powodu natłoku nauki nie zdążyłam napisać dynamicznego tworzenia arraya.</p>";
        echo "</tr></table></div></div></div></div></body></html>";
        echo "<table><tr><td>Book2</td><td>Compatibility</td><td>Book Date</td><td>Female AVG age</td><td>Male AVG age</td></tr>";
        for ($i=0;$i<5;$i++){
            echo $tablica[$i]['wywol'];
        }
        echo "</tr></table></div></div></div></div></body></html>";
    }                    
?>


                        
