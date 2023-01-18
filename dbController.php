<?php
  $host = 'localhost';  
  $user = 'j29274lh_export';    
  $pass = 'Df56d467'; 
  $db_name = 'j29274lh_export';   
  $link = mysqli_connect($host, $user, $pass, $db_name); 
  

  // Ругаемся, если соединение установить не удалось
  if (!$link) {
    echo 'Не могу соединиться с БД. Код ошибки: ' . mysqli_connect_errno() . ', ошибка: ' . mysqli_connect_error();
    exit;
  }
?>
