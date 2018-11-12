<?php
class Cart {
	private $items = [];

	public function addItem(Item $item) {
		$this->items[] = $item;
	}


	public function removeItem(Item $item) {
		if( ! isset($this->items[$item]) ) {
			return;
		}
		if($this->items[$item] <= 0) {
			unset($this->items[$item]);
		}
	}

	public function getItems() {
		return $this->items;
	}
	
	public function isEmpty() {
		return count($this->items) == 0;
	}

	public function render() {
		$columns = array("Product","Count","Price");
		$rows = array();
		$total = 0;
	
		foreach ($this->items as $item) {
			$product = Product::getProductById($item->getProductId());
			$color = Color::getColorById($item->getColorId());
			$strap = Strap::getStrapById($item->getStrapId());
			$price = $item->getCount()*$product->getPrice();
			$productdesc = $product->getName()." (".$strap->getName().", ".$color->getName().")";
			$rows[] = array($productdesc,$item->getCount(),$price);
			$total += $price;
		}	
		$rows[] = array("Total","",$total);

		$table = new Table($rows,$columns);
		$table->render();
	}
}
