<?php
spl_autoload_register(function ($class_name){
	$directories = array(
		'../objects/',
		'../controller/',
		'../view/',
		'../entities/'
	);
	foreach($directories as $dir){
		if (file_exists($dir.$class_name.'.php')){
			require_once($dir.$class_name . '.php');
			return;
		}
	}
});
