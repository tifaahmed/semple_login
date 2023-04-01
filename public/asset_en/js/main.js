$(document).ready(function() {
	
window.onscroll = function() {myFunction()};

var header = document.getElementById("header");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
	
		var menu = document.getElementById("main_menu");
		var btnico = document.getElementById("nav-trigger");
	$('#nav-trigger').on('click', function() {
		
		menu.classList.toggle("active");
		btnico.classList.toggle("cansel");
		
	});
    $("#close-menu ").on('click', function() {
		
		menu.classList.toggle("active");
		btnico.classList.toggle("cansel");

    });
    $(".ico_serch ").on('click', function() {
		$("#search-pop").toggleClass('active');

    });
    $("#close-search ").on('click', function() {
		$("#search-pop").toggleClass('active');

    });
	
	
	var Swipes = new Swiper('.swiper-home', {
		loop: true,
		autoplay: {
		delay: 5000
	  },
	});
	
	
	var Swipes = new Swiper('.swiper-head', {
	  spaceBetween: 0,
	  slidesPerView: 3,
	  navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	  },
		loop: true,
		autoplay: {
		delay: 5000
	  },
	});

var slideCol = document.getElementById("price_slide");
var y = document.getElementById("price_range");
y.innerHTML = slideCol.value;

slideCol.oninput = function() {
    y.innerHTML = this.value;
}
	
$('.minus').click(function () {
	var $input = $(this).parent().find('input');
	var count = parseInt($input.val()) - 1;
	count = count < 1 ? 1 : count;
	$input.val(count);
	$input.change();
	return false;
});
$('.plus').click(function () {
	var $input = $(this).parent().find('input');
	$input.val(parseInt($input.val()) + 1);
	$input.change();
	return false;
});
	
	
	
	

});


