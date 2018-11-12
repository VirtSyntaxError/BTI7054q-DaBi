<?php
class Cart {
	private $items = [];
	private $count = 0;

	public function addItem(Item $item) {
		$this->items[] = $item;
	}


	public function removeItem(Item $item, $num) {
		if( ! isset($this->items[$item]) ) {
			return;
		}
		$this->items[$item] -= $num;
		$count--;
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
			$prize = $item->getCount()*$product->getPrize();
			$rows[] = array($product->getName(),$item->getCount(),$prize);
			$total += $prize;
		}	
		$rows[] = array("Total","",$total);

		$table = new Table($rows,$columns);
		$table->render();
	}
}
