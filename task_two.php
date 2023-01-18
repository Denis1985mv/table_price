<?php

require './dbController.php';


function quote_smart($value)
{
    // если magic_quotes_gpc включена - используем stripslashes
    if (get_magic_quotes_gpc()) {
        $value = stripslashes($value);
    }
    // Если переменная - число, то экранировать её не нужно
    // если нет - то окружем её кавычками, и экранируем
    if (!is_numeric($value)) {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}

/*parameters from JS*/
$type1 = $_GET['type1']; 
$type2 = $_GET['type2'];
$from = $_GET['from'];
$to = $_GET['to'];
$count = $_GET['count'];


/*parameters from JS*/
//$type1 = quote_smart($_GET['type1']); 
//$type2 = quote_smart($_GET['type2']);
//$from = quote_smart($_GET['from']);
//$to = quote_smart($_GET['to']);
//$count = quote_smart($_GET['count']);

/*parts of SQL query*/
$searchType = $type1 == "single" ? "`Стоимость, руб`" : "`Стоимость опт, руб`";
$moreLess = $type2 == "less" ? "`Наличие на складе 1, шт`+`Наличие на складе 2, шт` < ".$count."" : "`Наличие на складе 1, шт`+`Наличие на складе 2, шт` > ".$count."";


//$sqlString = "SELECT * FROM main WHERE ".$searchType." > '$from' and 	".$searchType." < '$to' and (".$moreLess.")";
	
$sqlString = sprintf("SELECT * FROM main WHERE ".$searchType." > '$from' and ".$searchType." < '$to' and (".$moreLess.")",
            quote_smart($_GET[".$searchType."]),
            quote_smart($_GET['$from']),
            quote_smart($_GET[".$searchType."]),
            quote_smart($_GET['$to']),
            quote_smart($_GET[".$moreLess."]));

$sql = mysqli_query($link, $sqlString);

$resultArray = array(); 
while ($r = mysqli_fetch_assoc($sql)) {
	$resultArray[] = $r;
}

//class result {};

$result = new stdClass();
$result->list = $resultArray;
header('Content-Type: application/json; charset=utf-8');
echo json_encode($result);

mysqli_close($link);
?>