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
				return $itemold->getCount();
			}	
		}
		$this->items[] = $item;
		$this->quantity += 1;
	}


	public function removeItem(Item $item) {
		foreach ($this->items as $itemold) {
			if($item->equals($itemold)){
				if ($itemold->getCount() == 1) {
					$this->deleteItem($itemold->getId());
					$this->quantity -= 1;
					return 0;
				} else {
					$itemold->setCount($itemold->getCount()-1);
					$this->quantity -= 1;
				}
				return $itemold->getCount();
			}
		}
	}

	public function deleteItem($id){
		foreach ($this->items as $key => $it){
			if ($it->getId() == $id){
				unset($this->items[$key]);
			}
		}
	}

	public function deleteAll(){
		foreach ($this->items as $key => $it){
				unset($this->items[$key]);
		}
		$this->quantity = 0;
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
		if ($this->isEmpty()) {
			echo t("NOTHINGINCART");
		} else {
			$columns = array("product","singleprice","count","price");
			$rows = array();
			$total = 0;
			$ids = array();
		
			foreach ($this->items as $item) {
				$product = Product::getProductById($item->getProductId());
				$color = Color::getColorById($item->getColorId());
				$strap = Strap::getStrapById($item->getStrapId());
				$price = $item->getCount()*$product->getPrice();
				$productdesc = $product->getName()." (".$strap->getName().", ".$color->getName().")";
				$rows[] = array($productdesc,$product->getPrice(),$item->getCount(),$price);
				$total += $price;
				$ids[] = $item->getId();
			}	
			$rows[] = array(t("TOTAL"),"","",$total);

			$table = new Table($rows,$columns);
			$table->renderCart($ids);
		}
	}
}
