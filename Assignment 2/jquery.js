function showAGB() {
$( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Accept": function() {
          $( "#payment_form" ).submit();
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  } );
}

function applyFilter() {
	$( function() {
		$.get("products.php"+window.location.search+"&filter="+$("#filter").val(),function(data) {
			$("#productoutput").html(data);
		});
	});
}

function add(id){
	$( function() {
		$.post("ajax/additemtocart.php", {id: id });
	});
	refreshCart();
}

function sub(id){
	$( function() {
		$.post("ajax/removeitemfromcart.php", {id: id });
	});
	refreshCart();
}

function refreshCart(){
	$( function() {
		$.get("ajax/refreshcart.php", function(data)  {
			$("#cartcount").html(data);
		});
		$.get("ajax/loadcart.php", function(data)  {
			$("#cart").html(data);
		});
	});
}

