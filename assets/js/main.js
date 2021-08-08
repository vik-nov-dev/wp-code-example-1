toggleMenuShrink();
window.addEventListener("scroll", (event) => {
    toggleMenuShrink();
});

function toggleMenuShrink() {
    if (window.pageYOffset)
        document.querySelector('nav.navbar').classList.add('shrink');
    else
        document.querySelector('nav.navbar').classList.remove('shrink');
}

//========== Home Banner ========== //

var owl = jQuery('.slider');
owl.owlCarousel({
    items:1,
    loop:true,
    margin:0,
    autoplay:true,
    autoplayTimeout:8000,
    autoplayHoverPause:true,
    navSpeed: 1200,
    autoplaySpeed: 1000,
    nav: true
});
jQuery('.play').on('click',function(){
    owl.trigger('play.owl.autoplay',[1000])
})
jQuery('.stop').on('click',function(){
    owl.trigger('stop.owl.autoplay')
});


//========== Shop Banner ========== //

var owl = jQuery('.slider-shop');
owl.owlCarousel({
    items:1,
    loop:true,
    margin:0,
    autoplay:true,
    autoplayTimeout:8000,
    autoplayHoverPause:true,
    navSpeed: 1200,
    autoplaySpeed: 1000,
    nav: true
});

//========== Shop Video Slider ========== //

var owl = jQuery('.slider-videos');
owl.owlCarousel({
    items:1,
    loop:true,
    margin:0,
    autoplay:false,
    navSpeed: 1200,
    nav: true,
    dots: false
});


//========== Portfolio ========== //

jQuery('.portfolio').owlCarousel({
    loop:true,
    margin:30,
    responsiveClass:true,
    navSpeed: 800,
    responsive:{
        0:{
            items:2,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:3,
            nav:true,
            loop:false
        }
    }
})

/*jQuery('.navbar-collapse').on('show.bs.collapse', function () {
  jQuery('body').addClass('height-100');
});
jQuery('.navbar-collapse').on('hide.bs.collapse', function () {
  jQuery('body').removeClass('height-100');
});*/

jQuery('.shop-search-mob').click(function(event) {
    event.preventDefault();
    jQuery('.search-box-mob').toggleClass('focus');
});

var owl = jQuery('.shop-cats');
owl.owlCarousel({
    items:4,
    loop:true,
    margin:30,
    autoplay:true,
    autoplayTimeout:8000,
    autoplayHoverPause:true,
    navSpeed: 1200,
    autoplaySpeed: 1000,
	dots:false,
	nav:false,
	responsive : {
		0 : {
			items: 2
		},
		768 : {
			items:4
		}
	}
});

let MCinterval = false;
let MCitemsNum = jQuery('.message-carousel a').length;
let MCcurrentNum = 0;
doBannerRotation();

function startBannerRotation() {
    stopBannerRotation();
    MCinterval = setInterval(function () {
        let prevInd = MCcurrentNum;
        MCcurrentNum += 1;
        if (MCcurrentNum >= MCitemsNum)
            MCcurrentNum = 0;
            jQuery(jQuery('.message-carousel a')[MCcurrentNum]).fadeIn(250, function() {
                jQuery(jQuery('.message-carousel a')[prevInd]).fadeOut(150);
            });
    }, window.bannerRotationInterval);
}
function stopBannerRotation() {
    clearInterval(MCinterval);
}
function doBannerRotation() {
    startBannerRotation();
    jQuery('.message-carousel').mouseenter(() => {
        stopBannerRotation();
    });
    jQuery('.message-carousel').mouseleave(() => {
        startBannerRotation();
    });
}
