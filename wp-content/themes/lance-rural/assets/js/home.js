const swiperLive = new Swiper('#swiperLive', {
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    slidesPerView: 1,
    loop: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true
    },
    breakpoints: {
        1240: {
            navigation: {
                enabled: true,
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        },
    },
});

let swiperCast, swiperSchedule = null;

function initSwiperForMobile() {
    const isMobile = window.innerWidth <= 768;

    if (isMobile && !swiperCast && !swiperSchedule) {
        swiperCast = new Swiper('#swiperCast', {
            autoplay: false,
            slidesPerView: 1.1,
            spaceBetween: 10,
            loop: false,
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            breakpoints: {
                1240: {
                    navigation: {
                        enabled: true,
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    centeredSlides: true,
                },
            },
        });

        swiperSchedule = new Swiper('#swiperSchedule', {
            autoplay: false,
            slidesPerView: 1.1,
            spaceBetween: 10,
            loop: false,
            autoHeight: true,
            pagination: {
                el: '.swiperSchedule-pagination',
                clickable: true
            },
            breakpoints: {
                1240: {
                    navigation: {
                        enabled: true,
                        nextEl: ".swiperSchedule-button-next",
                        prevEl: ".swiperSchedule-button-prev",
                    },
                    centeredSlides: true,
                },
            },
        });

    } else if (!isMobile && swiperCast && swiperSchedule) {
        // Destroi o Swiper se não for mais mobile
        swiperCast.destroy(true, true);
        swiperCast = null;
        swiperSchedule.destroy(true, true);
        swiperSchedule = null;
    }
}

// Inicializa no carregamento
window.addEventListener("load", initSwiperForMobile);

// Reaplica ao redimensionar a janela
window.addEventListener("resize", initSwiperForMobile);

const swiperNews = new Swiper('#swiperNews', {
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    slidesPerView: 4,
    spaceBetween: 20,
    loop: false,
    pagination: {
        el: '.swiper-pagination',
        clickable: true
    },
    navigation: {
        enabled: true,
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        1240: {
          slidesPerView: 4,
        },
        992: {
          slidesPerView: 3,
        },
        600: {
            slidesPerView: 2.1,
        },
        0: {
            slidesPerView: 1.1,
            spaceBetween: 15,
        }
    },
});