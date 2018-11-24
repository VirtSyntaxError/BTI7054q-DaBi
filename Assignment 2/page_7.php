<?php
echo "<h1>".t("CART")."</h1>";
echo "<script>
function add(id){
	$.post(\"additemtocart.php\", {id: id }, function(data){
		alert(data);
	});
}
function sub(id){
	$.post(\"removeitemfromcart.php\", {id: id });
}
</script>";
if (isset($_SESSION['cart'])){
		$cart = $_SESSION['cart'];
		$cart->render();
}
echo "<br>";