

function linker(page) {

	$(".one").css("display","block");
	$(".two").css("display","none");
	$(".three").css("display","none");

	$.ajax({
	   	type: "POST",
        url: "ajax/page.php",
        data: { page: page}, 
        cache: false,
        success: function(msg) {
	       	$(".one").empty().append(msg);
    	},
    	error: function(error) {
    		$(".one").empty().append("Błąd połączenia z serwerem.");
    	}
	});
}

function display(cat, page) {

	$(".two").css("display","block");
	$(".three").css("display","none");

	$.ajax({
	   	type: "POST",
        url: "ajax/display.php",
        data: { page: page, cat: cat }, 
        cache: false,
        success: function(msg) {
	       	$(".two").empty().append(msg);
    	},
    	error: function(error) {
    		$(".two").empty().append("Błąd połączenia z serwerem.");
    	}
	});
}

function donwload(cat, page) {

	$(".two").css("display","block");

	$(".two").empty().append("Rozpoczęto pracę...");
	$(".three").css("display","none");

	$.ajax({
	   	type: "POST",
        url: "ajax/donwload.php",
        data: { page: page, cat: cat }, 
        cache: false,
        success: function(msg) {
	       	$(".two").empty().append("Zakończono pracę. Możesz zamknąć aplikację.");
    	},
    	error: function(error) {
    		$(".two").empty().append("Błąd połączenia z serwerem.");
    	}
	});
}

function lista(cat, date) {

	$(".three").css("display","block");

	$.ajax({
	   	type: "POST",
        url: "ajax/lista.php",
        data: { cat: cat, date: date }, 
        cache: false,
        success: function(msg) {
	       	$(".three").empty().append(msg);
    	},
    	error: function(error) {
    		$(".three").empty().append("Błąd połączenia z serwerem.");
    	}
	});
}

function mailing(cat, date) {

	$(".three").css("display","block");

	$.ajax({
	   	type: "POST",
        url: "ajax/mailing.php",
        data: { cat: cat, date: date }, 
        cache: false,
        success: function(msg) {
	       	$(".three").empty().append(msg);
    	},
    	error: function(error) {
    		$(".three").empty().append("Błąd połączenia z serwerem.");
    	}
	});
}

function mailing_send(cat, date) {

	var title = $("#title").val();
	var text = $("#texter").val();

	$(".three").empty().append("Wysyłanie...");

	$.ajax({
	   	type: "POST",
        url: "ajax/mailing_send.php",
        data: { cat: cat, date: date, title: title, text: text }, 
        cache: false,
        success: function(msg) {
	       	$(".three").empty().append(msg);
    	},
    	error: function(error) {
    		$(".three").empty().append("Błąd połączenia z serwerem.");
    	}
	});
}