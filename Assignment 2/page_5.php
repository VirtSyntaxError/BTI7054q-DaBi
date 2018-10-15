<h1><?php echo t("CONFIRMATION")?></h1>
<p>ProductInfo blabla</p>
<p><?php echo t("ADDRESS")?>:</p>
<p><?php echo $_POST["name"]?></p>
<p><?php echo $_POST["street"]." ".$_POST["str_nr"]?></p>
<p><?php echo $_POST["zip"]." ".$_POST["city"]?></p>
<input type="submit" value="OK"/>
