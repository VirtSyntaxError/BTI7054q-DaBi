<?php
class OrderCard {
	private $order;
	private $lang;

	public function __construct(Purchase $order, $lang){
		$this->order = $order;
		$this->lang = $lang;
	}

	private function renderDetails(PurchaseDetail ...$details) {
		echo '<div class="flex-container">';
		echo '<div class="cardfull">';
		$this->renderRaw("descfull", ...$details);
		echo '<p><b>'.t("PRODUCTS").'</b></p>';
		foreach ($details as $detail) {
			$product = Product::getProductById($detail->getProductId(),$this->lang);
			$singleprice = round($product->getPrice()*0.01*(100-$product->getDiscount()));

			echo '<p class="orderarticle"><img src="img/'.$product->getImage().'">'.$product->getName().'</p>';
			echo '<div class="order-detail-container">';
			echo '<div class="order-detail-child">'.t("ARTICLENUMBER").':</div><div class="order-detail-child">'.$detail->getProductId().'</div>';
			echo '<div class="order-detail-child">'.t("STRAPCOLOR").':</div><div class="order-detail-child">'.Strap::getStrapById($detail->getStrapId(),$this->lang)->getName().'</div>';
			echo '<div class="order-detail-child">'.t("WATCHCOLOR").':</div><div class="order-detail-child">'.Color::getColorById($detail->getColorId(),$this->lang)->getName().'</div>';
			echo '<div class="order-detail-child">'.t("COUNT").':</div><div class="order-detail-child">'.$detail->getCount().'</div>';
			echo '<div class="order-detail-child">'.t("SINGLEPRICE").':</div><div class="order-detail-child">'.$singleprice.'.-</div>';
			echo '<div class="order-detail-child">'.t("PRICE").':</div><div class="order-detail-child">'.$detail->getCount()*$singleprice.'.-</div>';
			echo '</div>';
		}	
		echo '</div>';
		echo '</div>';
	}

	private function renderRaw($descclass, PurchaseDetail ...$details) {
		$sum = 0;

		foreach($details as $detail) {
			$product = Product::getProductById($detail->getProductId(),$this->lang);
			$singleprice = round($product->getPrice()*0.01*(100-$product->getDiscount()));
			$sum += $detail->getCount()*$singleprice;
		}

		echo '<p><b>'.t("ORDERNR").': '.$this->order->getID().'</b></p>';
		echo '<p>'.t("DATE").': '.date("H:i d.m.Y",$this->order->getTimestamp()).'</p>';
		echo '<p class="'.$descclass.'">'.$this->order->getDescription().'</p>';
		echo '<p>'.t("STATUS").': '.$this->order->getStatus().'</p>';
  		echo '<p class="price">'.$sum.'.-</p>';
	}
	
	public function render() {
		$details = PurchaseDetail::getPurchaseDetailsByPurchaseId($this->order->getId());		
		echo '<div class="card">';
		echo '<form onSubmit="showOverlay('.$this->order->getId().')" action="javascript:void(0);">';
		$this->renderRaw("desc", ...$details);
		echo '<input type="submit" value="'.t("DETAILS").'">';
		echo '</form>';
		echo '</div>';
		echo '<div class="overlay" id="overlay'.$this->order->getId().'" onClick="noOverlay('.$this->order->getId().')">';
		$this->renderDetails(...$details);
		echo '</div>';
	}
	

}
