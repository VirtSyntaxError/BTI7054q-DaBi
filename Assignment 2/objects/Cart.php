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

	public function render($readonly) {
		$readonly = (bool) $readonly;

		if(!isset($_SESSION)){ 
			session_start(); 
		}
		$lang = $_SESSION['lang'];

		if ($this->isEmpty()) {
			echo '<p>'.t("NOTHINGINCART").'</p>';
		} else {
			$total = 0;
			$ids = array();

			
			foreach ($this->items as $item) {
				$product = Product::getProductById($item->getProductId(),$lang);
				$color = Color::getColorById($item->getColorId(),$lang);
				$strap = Strap::getStrapById($item->getStrapId(),$lang);
				$singleprice = round($product->getPrice()*0.01*(100-$product->getDiscount()));
				$price = $item->getCount()*$singleprice;
				$productdesc = $product->getName()." (".$strap->getName().", ".$color->getName().")";
				$total += $price;
				$ids[] = $item->getId();
				echo "<form name='addorremove' action='ajax/addorremove.php' method='post'>";
				echo "<input type='hidden' name='prev' value=".$_SERVER['REQUEST_URI'].">";
				echo '<div class="order-detail-container">';
				echo '<div class="order-detail-child"><img src="img/'.$product->getImage().'"></div><div class="order-detail-child">'.$product->getName().'</div>';
				echo '<div class="order-detail-child">'.t("STRAPCOLOR").':</div><div class="order-detail-child">'.$strap->getName().'</div>';
				echo '<div class="order-detail-child">'.t("WATCHCOLOR").':</div><div class="order-detail-child">'.$color->getName().'</div>';
				echo '<div class="order-detail-child">'.t("COUNT").':</div>';
				echo '<div class="order-detail-child">';
				echo '<div class="flex-container">';
				if(!$readonly) {
					echo '<div><input type="hidden" name="id" value="'.$item->getId().'"><input id="button" type="Submit" name="rem" value="-" onclick="subItem(\''.$item->getId().'\');return false;"></div>';
				}
				echo $item->getCount();
				if(!$readonly) {
					echo '<div><input type="hidden" name="id" value="'.$item->getId().'"><input id="button" type="Submit" name="add" value="+" onclick="addItem(\''.$item->getId().'\');return false;"></div>';
				}
				echo '</div>';
				echo '</div>';
				echo '<div class="order-detail-child">'.t("SINGLEPRICE").':</div><div class="order-detail-child">'.$singleprice.'.-</div>';
				echo '<div class="order-detail-child">'.t("PRICE").':</div><div class="order-detail-child">'.$price.'.-</div>';
				echo '</div>';	
				echo '</form>';
			}	
  			echo '<p class="price">'.t("TOTAL").': '.$total.'.-</p>';
		}
	}
}
