<?php
class OrderGrid {
	private $orders = [];
	private $count;
	private $lang;

	public function __construct($lang, Purchase ...$orders){
		$this->orders = $orders;
		$this->count = count($orders);
		$this->lang = $lang;
	}

	public function addOrder(Purchase $order) {
		$this->orders[] = $order;
		$this->count += 1;
	}

	public function getOrders() {
		return $this->orders;
	}
	
	public function getCount() {
		return $this->count;
	}
	
	public function render() {
		if($this->count == 0) {
			echo t("NOORDERS");
		} else {
			echo '<div class="flex-container">';
		
			foreach ($this->orders as $order){
				$card = new OrderCard($order, $this->lang);
				$card->render();
			}
			echo '</div>';		
		}
	}
}
