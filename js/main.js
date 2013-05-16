$(document).ready(function(){
	   	$(".Evenementen").hide();
	   	$(".Expo").hide();
	   	$(".Muziek").hide();
	   	$(".Podium").hide();
	   	$(".Cursus").hide();
	   	$(".Emoties").hide();
	   	$(".Lengte").hide();
	   	
		$(".arrow").click(function(){
			event.preventDefault();
			var inputclass = $( this ).find( 'i').attr('class');
			if (inputclass == 'icon-angle-down') {
				$( this ).find( 'i').removeClass('icon-angle-down').addClass('icon-angle-up');
			}
			else {
				$( this ).find( 'i').removeClass('icon-angle-up').addClass('icon-angle-down');
			}
		});
		$("#EvenementenJS").click(function(){
			event.preventDefault();			
			if ($(".Evenementen").is(":hidden")) {
				$(".Evenementen").slideDown();
				} 
			else {
				$(".Evenementen").slideUp();
			}
		});
		
		$("#ExpoJS").click(function(){
			event.preventDefault();			
			if ($(".Expo").is(":hidden")) {
				$(".Expo").slideDown();
				} 
			else {
				$(".Expo").slideUp();
			}
		});

		$("#MuziekJS").click(function(){
			event.preventDefault();			
			if ($(".Muziek").is(":hidden")) {
				$(".Muziek").slideDown();
				} 
			else {
				$(".Muziek").slideUp();
			}
		});

		$("#PodiumJS").click(function(){
			event.preventDefault();			
			if ($(".Podium").is(":hidden")) {
				$(".Podium").slideDown();
				} 
			else {
				$(".Podium").slideUp();
			}
		});

		$("#CursusJS").click(function(){
			event.preventDefault();			
			if ($(".Cursus").is(":hidden")) {
				$(".Cursus").slideDown();
				} 
			else {
				$(".Cursus").slideUp();
			}
		});

		$("#EmotiesJS").click(function(){
			event.preventDefault();
			
			if ($(".Emoties").is(":hidden")) {
				$(".Emoties").slideDown();
				} 
			else {
				$(".Emoties").slideUp();
			}
		});
		
		$("#LengteJS").click(function(){
			event.preventDefault();			
			if ($(".Lengte").is(":hidden")) {
				$(".Lengte").slideDown();
				} 
			else {
				$(".Lengte").slideUp();
			}
		});

});