window.onload = function(){

	var home = document.getElementById('linkHome')
	var pricing = document.getElementById('linkPrincing')
	var faq = document.getElementById('linkFaq')
	var register = document.getElementById('linkRegister')

	home.onclick = function(){

		$('html, body').animate({
		    scrollTop: $("#home").offset().top - $("nav").height() + 1
		}, 1000);
	}
	pricing.onclick = function(){
		$('html, body').animate({
		    scrollTop: $("#pricing").offset().top - $("nav").height() + 1
		}, 1000);
	}
	faq.onclick = function(){
		$('html, body').animate({
		    scrollTop: $("#faq").offset().top - $("nav").height() + 1
		}, 1000);
	}
	register.onclick = function(){
		$('html, body').animate({
		    scrollTop: $("#register").offset().top - $("nav").height()+ 1
		}, 1000);
	}


}