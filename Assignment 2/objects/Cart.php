<?php
class Cart {
	private $items = [];
	private $quantity = 0;

	public function addItem(Item $item) {
		foreach ($this->items as $itemold) {
			if($item->equals($itemold)){
				$itemold->setCount($itemold->getCount()+1);	
				unset($item);
				$this->quantity += 1;
				return;	
			}	
		}
		$this->items[] = $item;
		$this->quantity += 1;
	}


	public function removeItem(Item $item) {
		foreach ($this->items as $itemold) {
			if($item->equals($itemold)){
				if ($itemold->getCount() <= 0) {
					unset($this->items[$itemold]);
				} else {
					$itemold->setCount($itemold->getCount()+1);	
				}
				return;
			}	
		}
	}

	public function getItems() {
		return $this->items;
	}
	
	public function getQuantity() {
		return $this->quantity;
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
