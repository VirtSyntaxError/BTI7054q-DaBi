<?php
class ProductGrid {
	private $prods = [];
	private $count;
	private $lang;

	public function __construct($lang, Product ...$products){
		$this->prods = $products;
		$this->count = count($products);
		$this->lang = $lang;
	}

	public function addProd(Product $prod) {
		$this->prods[] = $prod;
		$this->count += 1;
	}

	public function getProds() {
		return $this->prods;
	}
	
	public function getCount() {
		return $this->count;
	}
	
	public function render() {
		echo '<div class="flex-container">';
		$cards = 0;
		
		foreach ($this->prods as $prod){
			$card = new ProductCard($prod, $this->lang);
			$card->render();
	
		}
		echo '</div>';		
	}
}
