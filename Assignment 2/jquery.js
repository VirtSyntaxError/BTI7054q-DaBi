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
		$.get("products.php"+window.location.search+"&filter="+$("#filter").val(),function(data){$("#productoutput").html(data);});
	} );
}

function add(id){
	$( function() {
		$.post("additemtocart.php", {id: id }, function(data){
			alert(data);
		});
	});
}
function sub(id){
	$( function() {
		$.post("removeitemfromcart.php", {id: id });
	});
}

