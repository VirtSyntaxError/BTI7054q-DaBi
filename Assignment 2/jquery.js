function sticky_relocate() {
      var window_top = $(window).scrollTop();
      var div_top = $('#beforenav').offset().top + 40;
      if (window_top > div_top) {
        $('#nav').addClass('stick');
      } else if (window_top < div_top - 40) {
        $('#nav').removeClass('stick');
      }
}

$(document).ready(function() {
      	$(window).scroll(sticky_relocate);
      	sticky_relocate();
});

function showMenu(open) {
	if (open) {
		$('.dropdown-content-mobile').addClass('overlay');
		$('.dropdown-content').addClass('overlay');
		$('#closemenu').css("display","block");
		$('#openmenu').css("display","none");
	} else {
		$('.dropdown-content-mobile').removeClass('overlay');
		$('.dropdown-content').removeClass('overlay');
		$('#openmenu').css("display","block");
		$('#closemenu').css("display","none");
	}
}

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

function changeStatus(state, id) {
	$( function() {
		$.post("ajax/changestatus.php", {id: id, state: state}, function(data) {
			$("#state-"+id).html(data);
		});
	});
}

function changeOffer(offer, id) {
	$( function() {
		$.post("ajax/changeoffer.php", {id: id, offer: offer}, function(data) {
			$("#offer-"+id).val(data);
		});
		if ( offer == 1 ) {
			$("#slctdisc-"+id).removeClass("notvisible");
			$("#disc-"+id).addClass("notvisible");
		} else {
			$("#slctdisc-"+id).addClass("notvisible");
			$("#disc-"+id).removeClass("notvisible");
		}
	});
}

function changeDiscount(discount, id) {
	$( function() {
		$.post("ajax/changediscount.php", {id: id, discount: discount}, function(data) {
			$("#discount-"+id).val(data);
			$("#disc-"+id).html(data+"%");
		});

	});
}

function showOverlay() {
	$("#overlay").css("display","block");	
}

function noOverlay() {
	$("#overlay").css("display","none");	
}

function confirmPurchase(email, message) {
	var bool = false;
	$.ajax({
        	type: "POST",
        	url: "ajax/checkemail.php",
        	async: false,
		data: { email: email },
        	success : function(data) {
			if(data) {
				$("#emailexists").html(data);
			} else {
				$("#emailexists").html("");
				bool = true;
			}
        	}
	});
	if(bool) {
		if(message) {
			return confirm(message);
		} else {
			return true;
		}
	} else {
		return false;
	}
}
