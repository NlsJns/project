$(document).ready(function(){

	$(".steden").click(function(){
			$("#arthurside").animate({"background-position-y": "-56px"}, "slow");
			$("#tekstballon").html('Zodra je een stad of gemeente ingevuld hebt, mag je ook nog een leeftijdscategorie kiezen!');
	});
	$(".option").click(function(){
			var stedeninput = $(".steden").val()
			if (stedeninput == "") {
			$("#tekstballon").html('Je hebt nog geen stad ingevuld. Doe je dat nog even?');
			$("#arthurside").animate({"background-position-y": "-121px"}, "slow");
			}
			else {
			$("#arthurside").animate({"background-position-y": "-10px"}, "slow");
			$("#tekstballon").html('Je bent klaar! <br><br>Klik nu maar op &#34;Ok&#34;!');
			}
	});

	$(".arrow").click(function(){
		var inputclickid = $( this ).attr('id');
			var inputdiv = "#" + inputclickid;
			var slidediv = "." + inputclickid;
			if ($(slidediv).is(":hidden")) {
				$(slidediv).slideDown();
				} 
			else {
				$(slidediv).slideUp();
			}
			var inputclass = $(inputdiv).find('i').attr('class');
			if (inputclass == 'icon-angle-down') {
				$(inputdiv).find( 'i').removeClass('icon-angle-down').addClass('icon-angle-up');
			}
			else {
				$(inputdiv).find( 'i').removeClass('icon-angle-up').addClass('icon-angle-down');
			}
	});
	   	$(".Evenementen").hide();
	   	$(".Expo").hide();
	   	$(".Muziek").hide();
	   	$(".Podium").hide();
	   	$(".Cursus").hide();
	   	$(".Emoties").hide();
	   	$(".Lengte").hide();
	   	$(".Genre").hide();
	   	
	function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
 	}
 	var subnav = getUrlVars()["subnav"];
	if(subnav == "evenementen") {
	   	$(".Evenementen").show();
	}
	if(subnav == "expo") {
	   	$(".Expo").show();
	}
	if(subnav == "muziek") {
	   	$(".Muziek").show();
	}
	if(subnav == "podium") {
	   	$(".Podium").show();
	}
	if(subnav == "cursus") {
	   	$(".Cursus").show();
	}
	if(subnav == "emoties") {
	   	$(".Emoties").show();
	}
	if(subnav == "lengte") {
	   	$(".Lengte").show();
	}
	if(subnav == "genre") {
	   	$(".Genre").show();
	}

});