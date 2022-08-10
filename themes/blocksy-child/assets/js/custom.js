var navToggler = document.querySelector(".nav-toggler");
            var mnav = document.querySelector(".my-nav");

            navToggler.onclick = function() {
    mnav.classList.toggle("active");
    navToggler.classList.toggle("active");
}

$('#owl-1').owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    dots:true,
    smartSpeed:1500,
    autoplayTimeout:6000,
    autoplayHoverPause:true,
    autoWidth:false,
    items:1,
    singleItem: true,
    loop:true,
});
$('#owl-2').owlCarousel({
    loop:true,
    margin:10,
    autoplay:true,
    dots:false,
    nav:true,
    navText: [
        "<i class='fa fa-angle-left' aria-hidden='true'></i>",
        "<i class='fa fa-angle-right' aria-hidden='true'></i>"
      ],
    smartSpeed:1500,
    autoplayTimeout:7000,
    autoplayHoverPause:true,
    autoWidth:false,
    items:3,
    loop:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        992:{
            items:3
        }
    }
});


$('#commisionwork').owlCarousel({
    loop:true,
    margin:15,
    autoplay:true,
    dots:false,
    nav:true,
    navText: [
        "<i class='fa fa-angle-left' aria-hidden='true'></i>",
        "<i class='fa fa-angle-right' aria-hidden='true'></i>"
      ],
    smartSpeed:1500,
    autoplayTimeout:7000,
    autoplayHoverPause:true,
    autoWidth:false,
    items:3,
    loop:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        992:{
            items:3
        }
    }
});

//faq section

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }
  
  // Get the element with id="defaultOpen" and click on it
  document.getElementById("defaultOpen1").click();

