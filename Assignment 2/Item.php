<?php
class Item {
	private $productid;
	private $strapid;
	private $colorid;
	private $count;

	public function __construct($productid, $strapid, $colorid, $count){
		$this->productid = $productid;
		$this->strapid = $strapid;
		$this->colorid = $colorid;
		$this->count = $count;
	}

	public function getColorId() {
		return $this->colorid;
	}

	public function getStrapId() {
		return $this->colorid;
	}
	
	public function getProductId() {
		return $this->colorid;
	}

	public function getCount() {
		return $this->count;
	}

	public function setCount($count) {
		$this->count = $count;
	}

}
