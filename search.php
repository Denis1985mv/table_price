<?php
require './dbController.php';


//  $sql = mysqli_query($link, 'SELECT  `Стоимость, руб` FROM `main`');

        
?>

<?php


    $existOnStore1 = 0; // на складе 1 
	$existOnStore2 = 0; // на складе 2
	$countOfWholePrice = 0; // цена оптовая
    $countOfSinglePrice = 0; // цена за единицу
    $wholesalePrice = 0; // средняя оптовая цена
    $singlePrice = 0; // средняя цена за единицу
    $selectMaxPriceID = mysqli_query($link, 'SELECT `ID` FROM `main` WHERE `Стоимость, руб`=(SELECT max(`Стоимость, руб`) FROM `main`)');
    $selectMinPriceID = mysqli_query($link, 'SELECT `ID` FROM `main` WHERE `Стоимость опт, руб`=(SELECT min(`Стоимость опт, руб`) FROM `main`)');

   // $sql = mysqli_query($link, 'SELECT `ID`, `Наименование товара`,`Стоимость, руб`,`Стоимость опт, руб`,`Наличие на складе 1, шт`,`Наличие на складе 2, шт`, `Страна производства` FROM `main`');

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
    
        $sqll = sprintf("SELECT `ID`, `Наименование товара`,`Стоимость, руб`,`Стоимость опт, руб`,`Наличие на складе 1, шт`,`Наличие на складе 2, шт`, `Страна производства` FROM `main`",
        quote_smart($_GET["Наименование товара"]),
        quote_smart($_GET['Стоимость, руб']),
        quote_smart($_GET["Стоимость опт, руб"]),
        quote_smart($_GET['Наличие на складе 1, шт']),
        quote_smart($_GET["Наличие на складе 2, шт"]));
    
        $sql = mysqli_query($link, $sqll);


        while ($obj = mysqli_fetch_row($selectMaxPriceID)) {
        		$maxPriceID = $obj[0];
        	}
        //echo $maxPriceID;
        	while ($obj = mysqli_fetch_row($selectMinPriceID)) {
        		$minPriceID = $obj[0];
        	}
        	// WHERE (`Стоимость опт, руб` > 0)

?>





<html>
    <head>
        <meta charset="UTF-8">
        <title> Задание №2 AJAX </title>
        
        <link rel="stylesheet" type="text/css" href="/style/style.css">
        <script src="js/ajax.js"></script>
        	<style>
		 
		   .select {
			
			font-weight: bold; 
		   }
		   </style>
		   
	
        
    </head>
    <body>
        
        <script>
	
         function makeTable(list){
        
                /*for (let key in list) {
                    // ключи
                    document.write( key );  // name, age, isAdmin
                    // значения ключей
                    document.write( list[key] ); // John, 30, true
                    console.log(key);
                }*/
                const table = document.getElementById('mainTable');
                table.innerHTML =''
               // let table = document.createElement('table');
               // document.body.append(table);
                document.getElementById("ttt").appendChild(table);
                let rowHeader = table.insertRow();
                for(let prop in list[0]) {
                    if(list[0].hasOwnProperty(prop) && prop.toString().toLowerCase() !== 'id'){
        
                        let cell = rowHeader.insertCell();
                        cell.innerText = prop;
                        console.log(prop);
                     }
                }
           /* && key.toString().toLowerCase() !== 'id'*/
                for(let i = 0; i < list.length; i++) {
                    let row = table.insertRow();
                    for(let prop in list[i]) {
                        if(list[0].hasOwnProperty(prop) && prop.toString().toLowerCase() !== 'id') {
                            let cell = row.insertCell();
                            cell.innerText = list[i][prop];
                        }
        
                    }
                }
        
            }
		   


       </script> 
        
        <form>
        	<label>Показать товары, у которых</label>
            <select id="searchType1">
                <option value="single">Розничная цена</option>
                <option value="wholesale">Оптовая цена</option>
            </select>
            <label>от</label>
            <input type="number" id="searchFrom"  value="1000" />
            <label>до</label>
            <input type="number" id="searchTo" value="3000" />
            <label>рублей, и на складе</label>
            <select id="searchType2">
                <option value="more">Более</option>
                <option value="less">Менее</option>
            </select>
             <input type="number" id="search2Count" value="20" />
             <input type="button" id="searchButton" value="Показать товары">
        </form>
        
          <script src=""></script>
       <!-- <input id="btnGet" type="button" value="Get Info" />-->
          <p id="output"></p>
        
   <div class="table-scroll" id="ttt">
		    <table id="mainTable">
		        <tr>
		            <th>Наименование товара</th>
		            <th>Стоимость, руб</th>
		            <th>Стоимость опт, руб</th>
		            <th>Наличие на складе 1, шт</th>
		            <th>Наличие на складе 2, шт</th>
		            <th>Страна производства</th>
		            <th>Примечание</th>
		        </tr>

		        <?php 
		        	while ($result = mysqli_fetch_array($sql)) {
				  		$existOnStore1 += $result['Наличие на складе 1, шт'];
					    $existOnStore2 += $result['Наличие на складе 2, шт'];
						    
					   // $maxPriceID == $result['Стоимость, руб'];

				  		$className = '';
				  		if($result['ID'] == $maxPriceID){
				  			$className .= ' red';
				  		}

						if($result['ID'] == $minPriceID){
				  			$className .= ' green';
					}
				  		
				  	    if($result['Стоимость, руб'] > 0 && $result['Стоимость, руб'] < 293){
				  			$className .= ' yellow';
				  		}


					    if ($result['Стоимость опт, руб'] > 0){
					        $wholesalePrice += $result['Стоимость опт, руб'];
					        $countOfWholePrice++;
					    }
					    
					    if ($result['Стоимость, руб'] > 0){  
					        $singlePrice += $result['Стоимость, руб'];
					        $countOfSinglePrice++;
					    }

					   	if(($result['Наличие на складе 1, шт'] + $result['Наличие на складе 2, шт']) < 20){
					    	$option = 'Осталось мало! Срочно докупите';
					   	}else{
					    	$option = ' ';
					    } 
					    
					    if(($result['Стоимость, руб'] + $result['Стоимость опт, руб']) == 0){
					    	$option = 'Проверить прайс!';
					   	}

				  		echo "<tr class=\"$className\">
					        <td>{$result['Наименование товара']}</td>
					        <td>{$result['Стоимость, руб']}</td>
					        <td>{$result['Стоимость опт, руб']}</td>
					        <td>{$result['Наличие на складе 1, шт']}</td>
					        <td>{$result['Наличие на складе 2, шт']}</td>
					        <td>{$result['Страна производства']}</td>
					        <td>$option</td>
					    </tr>";  
				  	}
		        ?>
			</table>
			
			
			
		</div>
		
		<div class="dop-info">
			<?php
			$midleWholePrice = round($wholesalePrice / $countOfWholePrice, 2);
			$midleSinglePrice = round($singlePrice / $countOfSinglePrice, 2);

			echo "<p>Наличие на складе 1, шт: $existOnStore1 </p>";   
		   	echo "<p>Наличие на складе 2, шт: $existOnStore2  </p>";
		   	echo "<p>Средняя стоимость опт, руб: $midleWholePrice </p>";
		   	echo "<p>Средняя стоимость, руб: $midleSinglePrice </p>";
		 // echo "Максимальное значение: $max <br>";
		   ?>
		</div>
		
		<form action="http://j29274lh.beget.tech" method="post">
         <input type="submit" value="Назад" /> 
        </form>
       
  </body>
</html>