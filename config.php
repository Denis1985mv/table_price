<?php
define('PATH_SITE',__DIR__);
define('URL_SITE','http://j29274lh.beget.tech/export');

define('DB_HOST','localhost');
define('DB_USER','j29274lh_export');
define('DB_PASSWORD','Df56d467');
define('DB_NAME','j29274lh_export');
  $link = mysqli_connect($host, $user, $pass, $db_name);
class Config {
	
	public $cells = array(
							'A'=>'Наименование товара',
							'B'=>'Стоимость, руб',
							'C'=>'Стоимость опт, руб',
							'D'=>'Наличие на складе 1, шт',
							'E'=>'Наличие на складе 2, шт',
							'F'=>'Страна производства',
						
				
				
				
							
							);
}
?>