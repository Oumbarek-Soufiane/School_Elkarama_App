var swiper = new Swiper(".mySwiper", {
    initialSlide: 1,  
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    breakpoints: {
        // when window width is >= 320px
        320: {
            slidesPerView: 1,
            spaceBetween: 20
        },
        // when window width is >= 480px
        480: {
            slidesPerView: 1,
            spaceBetween: 30
        },
        // when window width is >= 640px
        640: {
            slidesPerView: 1,
            spaceBetween: 40
        },
        865: {
            slidesPerView: 2,
            spaceBetween: 40
        },
        1139: {
            slidesPerView: 2,
            spaceBetween: 40
        },
        1304: {
            slidesPerView: 3,
            spaceBetween: 40
        },
    },

    autoplay: {
        delay: 2500,
    },

    slidesPerView: "auto",
    centeredSlides: true,
    spaceBetween: 30,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});


// Pause autoplay on hover
swiper.el.addEventListener("mouseenter", function () {
    swiper.autoplay.stop();
});

// Resume autoplay on leave
swiper.el.addEventListener("mouseleave", function () {
    swiper.autoplay.start();
});
