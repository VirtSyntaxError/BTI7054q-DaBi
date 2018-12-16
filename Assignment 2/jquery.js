function sticky_relocate() {
      var window_top = $(window).scrollTop();
      var div_top = $('#beforenav').offset().top;
      if (window_top > div_top) {
        $('#nav').addClass('stick');
      } else {
        $('#nav').removeClass('stick');
      }
}

$(document).ready(function() {
      	$(window).scroll(sticky_relocate);
      	sticky_relocate();
});

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

function addItem(id){
	$( function() {
		$.post("ajax/additemtocart.php", {id: id });
	});
	refreshCart();
}

function subItem(id){
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

function emptyCart(){
	$( function() {
		$.post("ajax/emptycart.php");
	});
	refreshCart();

}

function refreshSite() {
	$( function() {
		location.reload();
	});
}

function changeLang(lang) {
	$( function() {
		$.ajax({
        		type: "POST",
        		url: "ajax/changelang.php",
        		async: false,
			data: { lang: lang },
        		success : function(data) {
            			refreshSite();
        		}
		});
	});
}

