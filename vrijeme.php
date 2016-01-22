<!Doctype-html>
<html>
<head>
<title>Vremenski uvjeti u Osijeku</title>
<meta name="description" content="Podaci o vremenu u Osijeku">
<meta name="keywords" content="vrijeme, Osijek, temperautra, tlak zraka, vlažnost, vjetar">
<meta charset="UTF-8">

<link rel="stylesheet" type="text/css" href="stil.css">


</head>

<body>

<h1>VREMENSKI UVJETI U OSIJEKU</h1>
<img class="sl" src="vremenska-prognoza.gif">
<br>
<form method="post" action="">
<input type="submit" class="dugme" name="dugme" value="Osvježi nove podatke">

</form>
<br>


<?php
include 'connection.php';



$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, 'api.openweathermap.org/data/2.5/weather?lat=45.5600028&lon=18.6758848&appid=b0712999b16e0837f37ede29ae28c1a9');
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$data=curl_exec($ch);
curl_close($ch);

$podaci=json_decode($data);

function celzijus($a)

{

$b=$a-273.15;
return $b;

}

$kelvin=$podaci->main->temp;
// temperatura u stupnjevima Celzijusa
$celzijus=celzijus($kelvin);

$tlak=$podaci->main->pressure;
$vlaznost=$podaci->main->humidity;
$vjetar=$podaci->wind->speed;

if (isset($_POST["dugme"])) {
	

$pdo =new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
$query= 'INSERT INTO vrijeme_osijek (temperatura_C, temperatura_K,
	vlaznost, tlak, vjetar) VALUES (?, ?, ?, ?, ?)';
$stmt=$pdo->prepare($query);
$stmt->bindParam(1, $celzijus);
$stmt->bindParam(2, $kelvin);
$stmt->bindParam(3, $vlaznost);
$stmt->bindParam(4, $tlak);
$stmt->bindParam(5, $vjetar);
$stmt->execute();

unset($pdo);	
}// kraj if isset

// prikaz zadnjih vremenskih podataka
$pdo =new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
$query='SELECT * FROM vrijeme_osijek ORDER BY vrijeme DESC';
$stmt=$pdo->query($query);

$rezultat=$stmt->fetch(PDO::FETCH_OBJ);

echo '<table class="tablica" border=1>';
echo '<tr>';
echo '<th>Vrijeme:</th>';
echo '<th>Temperatura: (Celzijus)</th>
<th>Temperatura: (Kelvin)</th>
<th>Vlažnost zraka:</th>
<th>Tlak zraka:</th>
<th>Brzina Vjetra:</th>';
echo '</tr>';

echo '<tr>';
echo '<td>'.$rezultat->vrijeme.'</td>';
echo '<td>'.$rezultat->temperatura_C.' °C</td>';
echo '<td>'.$rezultat->temperatura_K.' °K</td>';
echo '<td>'.$rezultat->vlaznost.' %</td>';
echo '<td>'.$rezultat->tlak.' hPa</td>';
echo '<td>'.$rezultat->vjetar.' m/s</td>';
	
echo '</tr>';
echo '</table>';
unset($pdo);

// grafički prikaz temperature

$pdo=new PDO ("mysql:host=$host; dbname=$baza", $user, $pass);
$query='SELECT * FROM (SELECT * FROM vrijeme_osijek ORDER BY vrijeme DESC LIMIT 6) tmp ORDER BY vrijeme ASC';
$stmt=$pdo->query($query);
$rezultat=$stmt->fetchAll(PDO::FETCH_OBJ);

?>

<br>
 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["imagelinechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Vrijeme', 'Temperatura °C'],
          
        <?php foreach ($rezultat as $key => $value) {
        	echo "['".$value->vrijeme."', ".$value->temperatura_C."],";
        }  ?>
        ]);




        var chart = new google.visualization.ImageLineChart(document.getElementById('chart_div'));

        chart.draw(data, {width: 750, height: 300, min: 0, colors: ['#FF0000']});
      }
    </script>
<div id="chart_div" style="width: 400px; height: 240px;"></div>


</body>

</html>