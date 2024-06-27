$(window).on('load', function () {
    $(".preloader").fadeOut('slow', function () {
        $("body").css('display', 'block').fadeIn('slow', function () {
            $(".content").fadeIn('slow'); // Show the content

            ScrollReveal().reveal('.fadeComponent', {
                delay: 400,
                distance: '50px',
                origin: 'bottom',
                easing: 'ease-in-out',
                mobile: true,
            });


            ScrollReveal().reveal('.fadeComponentSecond', {
                delay: 800,
                distance: '10%',
                origin: 'left',
                easing: 'ease-in-out',
                mobile: true,
            });
        });
    });
});



const swiper1 = new Swiper('.swiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    effect: "fade",
    autoplay: {
        delay: 5000,
    },
    // If we need pagination
    pagination: {
        el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // And if we need scrollbar
    // scrollbar: {
    //     el: '.swiper-scrollbar',
    // },
});

const swiper2 = new Swiper('.swiper-gallery', {
    loop: true,
    slidesPerView: 1,
    spaceBetween: 20,
    autoplay: {
        delay: 2500,
    },
    nextButton: '.swiper-button-next2',
    prevButton: '.swiper-button-prev2',
    pagination: '.swiper-pagination2',
    scrollbar: '.swiper-scrollbar2',
    breakpoints: {
        576: {
            slidesPerView: 3
        }
    }
});

const swiper3 = new Swiper('.swiper-umkm', {
    loop: true,
    speed: 1000,
    autoplay: {
        delay: 3000,
    },
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    coverflowEffect: {
        rotate: 0,
        stretch: 60,
        depth: 200,
        modifier: 2,
        slideShadows: false,
    },

    // Navigation arrows
    navigation: {
        nextEl: '.swiper-button-next3',
        prevEl: '.swiper-button-prev3',
    },

})


// JavaScript for the floating action button
document.addEventListener("DOMContentLoaded", function () {
    var floatingActionButton = document.querySelector('.floating-action-button');

    floatingActionButton.addEventListener('click', function () {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Show or hide the floating action button based on scroll position
    window.addEventListener('scroll', function () {
        if (window.scrollY > 500) { // Adjust the scroll position threshold as needed
            const opacity = Math.min(1, (window.scrollY - 500) / 200); // Smooth transition over 200px scroll distance, mainin ukuran window vertikal nya
            floatingActionButton.style.opacity = opacity;
            floatingActionButton.style.display = 'block';

        } else {
            floatingActionButton.style.display = 'none';
        }
    });



});

function sendWhatsAppMsg() {
    const urlToWhatsApp = `https://wa.me/6285899496182?text=Halo,perkenalkan saya ${username.value}. ${pesan.value}`
    window.open(urlToWhatsApp, "_blank")
}

