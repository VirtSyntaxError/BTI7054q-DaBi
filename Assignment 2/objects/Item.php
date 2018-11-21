<?php
class Item {
	private $productid;
	private $strapid;
	private $colorid;
	private $count;
	private $instanceid;

	public function __construct($productid, $strapid, $colorid, $count){
		$this->productid = $productid;
		$this->strapid = $strapid;
		$this->colorid = $colorid;
		$this->count = $count;
		$this->instanceid = "id#".$productid."#".$strapid."#".$colorid;
	}

	public function getId()
    	{
        	return $this->instanceid;
    	}

	public function getColorId() {
		return $this->colorid;
	}

	public function getStrapId() {
		return $this->strapid;
	}
	
	public function getProductId() {
		return $this->productid;
	}

	public function getCount() {
		return $this->count;
	}

	public function setCount($count) {
		$this->count = $count;
	}

	public function equals(Item $otheritem) {
		#return ($this->getProductId() == $otheritem->getProductId() && $this->getColorId() == $otheritem->getColorId() && $this->getStrapId() == $otheritem->getStrapId()) ? true : false;	
		return ($this->getInstanceId() == $otheritem->getInstanceId()) ? true : false;	
	}

}