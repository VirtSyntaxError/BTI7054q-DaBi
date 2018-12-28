<?php
class ProductCard {
	private $prod;
	private $lang;

	public function __construct(Product $product, $lang){
		$this->prod = $product;
		$this->lang = $lang;
	}

	private function renderRaw($descclass) {
			$categories = array();
			$categoryproducts = CategoryProduct::getCategoryByProductId($this->prod->getID());
			foreach ($categoryproducts as $categoryproduct){
				$category = Category::getCategoryById($categoryproduct->getCategoryId(),$this->lang);
				$categories[] = $category->getName();
			}

  			echo '<h1>'.$this->prod->getName().'</h1>';
			if($this->prod->getOffer()) {
  				echo '<p class="priceoffer">'.round($this->prod->getPrice()*0.01*(100-$this->prod->getDiscount())).'.- <s>'.$this->prod->getPrice().'.-</s></p>';
			} else {
  				echo '<p class="price">'.$this->prod->getPrice().'.-</p>';
			}
  			echo '<p>'.join(", ",$categories).'</p>';
  			echo '<p class="'.$descclass.'">'.$this->prod->getDescription().'</p>';
	}

	public function render() {
		echo '<div class="card">';
		echo '<form method="post" action="index.php?id=3">';
		echo '<p><img src="img/'.$this->prod->getImage().'"></p>';
		$this->renderRaw("desc");
		echo '<input type="hidden" name="articlenumber" value="'.$this->prod->getID().'">';
  		echo '<input type="submit" value="'.t("DETAILS").'">';
		echo '</form>';
		echo '</div>';
	} 

	public function renderDetails() {
		echo '<div class="cardfull">';
		echo '<img onClick="showOverlay()" src="img/'.$this->prod->getImage().'">';
		$this->renderRaw("descfull");
		echo '<p>'.t("ARTICLENUMBER").': '.$this->prod->getID().'</p>';
		echo '<p>'.t("BRAND").': '.Brand::getBrandById($this->prod->getBrand(),$this->lang)->getName().'</p>';
		echo '</div>';
		echo '<div id="overlay" onClick="noOverlay()"><img src="img/'.$this->prod->getImage().'"></div>';
	}

	public function renderOptions() {
		$colorproducts = ColorProduct::getColorByProductId($this->prod->getId());
		$strapproducts = StrapProduct::getStrapByProductId($this->prod->getId());

		echo '<div class="cardfull">';
		echo '<form method="post" action="index.php?id=6">';
		echo '<h1>'.t("STRAPCOLOR").'</h1>';
		echo '<p>';
		foreach ($strapproducts as $strapproduct){
			$strapid = $strapproduct->getStrapId();
			$strap = Strap::getStrapById($strapid, $this->lang);
			echo '<input type="radio" name="strapcolor" value="'.$strap->getId().'" required>'.$strap->getName();
		}
		echo '</p>';
		echo '<h1>'.t("WATCHCOLOR").'</h1>';
		echo '<p>';
		foreach ($colorproducts as $colorproduct){
			$colorid = $colorproduct->getColorId();
			$color = Color::getColorById($colorid, $this->lang);
			echo '<input type="radio" name="watchcolor" value="'.$color->getId().'" required>'.$color->getName();
		}
		echo '</p>';
		echo '<input type="submit" value="'.t("TOCART").'">';
		echo '</form>';
		echo '</div>';
	}
}
