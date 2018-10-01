<?php
	$product_array = array(
		array("name" => "Fossil Q Venture Smartwatch",
			  "price" => 999,
			  "sex" => "male/female",
			  "cat" => "Smartwatch",
			  "brand" => "Fossil"),
		array("name" => "Certina DS Action Lady Precidrive",
			  "price" => 888,
			  "sex" => "female",
			  "cat" => "Dive Watch",
			  "brand" => "Certina"),
		array("name" => "Rolex SUBMARINER",
			  "price" => 1999,
			  "sex" => "male",
			  "cat" => "Dive Watch",
			  "brand" => "Rolex"),
		array("name" => "Rolex SUBMARINER DATE",
			  "price" => 2000,
			  "sex" => "male",
			  "cat" => "Dive Watch",
			  "brand" => "Rolex"),
		array("name" => "SKY_DWELLER",
			  "price" => 9999,
			  "sex" => "male",
			  "cat" => "Dress Watch",
			  "brand" => "Rolex")
		);
	echo "<ul>";
	foreach ($product_array as $product){
		echo "<li>".$product["name"];
		echo "<ul>";
		echo "<li> Sex: ".$product["sex"]."</li>";
		echo "<li> Price: ".$product["price"]."</li>";
		echo "<li> Category: ".$product["cat"]."</li>";
		echo "<li> Brand: ".$product["brand"]."</li>";
		echo "</ul>";
		echo "</li>";
	}
	echo "</ul>"; 