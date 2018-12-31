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

	public static function withID($id){
		$ids = explode("#",$id);
		$instance = new self($ids[1],$ids[2],$ids[3]);
		return $instance;
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
		return ($this->getId() == $otheritem->getId()) ? true : false;	
	}
	
}
