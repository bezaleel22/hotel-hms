
$(document).ready(function () {
    "use strict"; // Start of use strict
    //Tooltip
    $('[data-toggle="tooltip"]').tooltip();
    //Popover
    $('[data-toggle="popover"]').popover({
            trigger: 'manual'
        })
        .on('mouseenter', function () {
            var _this = this;
            $(this).popover('show');
            $('.popover').on('mouseleave', function () {
                $(_this).popover('hide');
            });
        }).on('mouseleave', function () {
            var _this = this;
            setTimeout(function () {
                if (!$('.popover:hover').length) {
                    $(_this).popover('hide');
                }
            }, 300);
        });
    //navbar sticky
    var windows = $(window);
    var stick = $(".header-sticky");
    windows.on('scroll', function () {
        var scroll = windows.scrollTop();
        if (scroll < 245) {
            stick.removeClass("sticky");
        } else {
            stick.addClass("sticky");
        }
    });
    //Select2
    $(".select2").select2({
        theme: "bootstrap",
        width: '100%'
    });
    //Daterangepicker
    var findate = $("#findate").val();
    var nowDate = new Date();
    var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);
    $(function () {
        $('#daterangepicker').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            'minDate': today,
            'maxDate': findate,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    $(function () {
        $('#daterangepicker2').daterangepicker({
            singleDatePicker: true,
            'minDate': moment($('#daterangepicker').val(), "YYYY-MM-DD").add(1, 'd'),
            'maxDate': findate,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    //Daterangepicker header
    $(function () {
        $('#daterangepickers').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            'minDate': today,
            'maxDate': findate,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    $(function () {
        $('#daterangepickers2').daterangepicker({
            singleDatePicker: true,
            'minDate': moment($('#daterangepicker').val(), "YYYY-MM-DD").add(1, 'd'),
            'maxDate': findate,
            locale: {
                format: 'YYYY-MM-DD'
            }
        });
    });
    //spinner
    $(document).on("click", '.number-spinner a', function () {
        var btn = $(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;
        if (btn.attr('data-dir') === 'up') {
            newVal = parseInt(oldValue, 10) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue, 10) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find('input').val(newVal);
    });
    $(document).on("click", '.children a', function () {
        var btn = $(this),
            oldValue = btn.closest('.children').find('input').val().trim(),
            newVal = 0;
        if (btn.attr('data-dir') === 'up') {
            newVal = parseInt(oldValue, 10) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue, 10) - 1;
            } else {
                newVal = 0;
            }
        }
        btn.closest('.children').find('input').val(newVal);
    });
    //Offer carousel
    $('.offer-carousel').owlCarousel({
        loop: true,
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    //Destinations carousel
    $('.destinations-carousel').owlCarousel({
        loop: true,
        margin: 15,
        dots: false,
        nav: true,
        navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });
    //Background image
    $(".bg-img-hero").css('backgroundImage', function () {
        var bg = ('url(' + $(this).data("image-src") + ')');
        return bg;
    });
    //SLIDER Preloader
    var slider_preloader_status = $(".slider_preloader_statusr");
    var slider_preloader = $(".slider_preloader");
    var header_slider = $(".header-slider");

    slider_preloader_status.fadeOut();
    slider_preloader.delay(350).fadeOut('slow');
    header_slider.removeClass("header-slider-preloader");

    // Slider JS
    $('#animation-slide').owlCarousel({
        autoHeight: true,
        items: 1,
        loop: true,
        autoplay: true,
        dots: false,
        nav: true,
        autoplayTimeout: 7000,
        navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
        animateIn: "fadeIn",
        animateOut: "fadeOut",
        autoplayHoverPause: false,
        touchDrag: true,
        mouseDrag: true
    });
    $("#animation-slide").on("translate.owl.carousel", function () {
        $(this).find(".owl-item .slide-text > *").removeClass("fadeInUp animated").css("opacity", "0");
        $(this).find(".owl-item .slide-img").removeClass("fadeInRight animated").css("opacity", "0");
    });
    $("#animation-slide").on("translated.owl.carousel", function () {
        $(this).find(".owl-item.active .slide-text > *").addClass("fadeInUp animated").css("opacity", "1");
        $(this).find(".owl-item.active .slide-img").addClass("fadeInRight animated").css("opacity", "1");
    });
    //Smooth Page Scrolling in jQuery
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - 48)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });
    // external js: isotope.pkgd.js
    var $grid = $(".grid").isotope({
        itemSelector: ".grid-item",
        percentPosition: true,
        masonry: {
            columnWidth: ".grid-sizer"
        }
    });
    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function () {
            var number = $(this)
                .find(".number")
                .text();
            return parseInt(number, 10) > 50;
        },
        // show if name ends with -ium
        ium: function () {
            var name = $(this)
                .find(".name")
                .text();
            return name.match(/ium$/);
        }
    };
    // bind filter on radio button click
    $(".filters").on("click", "input", function () {
        // get filter value from input value
        var filterValue = this.value;
        // use filterFn if matches value
        filterValue = filterFns[filterValue] || filterValue;
        $grid.isotope({
            filter: filterValue
        });
    });
    //Blog carousel
    $('.blog-carousel').owlCarousel({
        loop: true,
        margin: 5,
        items: 2,
        dots: false,
        center: true,
        nav: true,
        navText: ["<i class='ti-angle-left'></i>", "<i class='ti-angle-right'></i>"],
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 2
            }
        }
    });
    //Back to top
    $('body').append('<div id="toTop" class="btn-top"><i class="ti-upload"></i></div>');
    $(window).scroll(function () {
        if ($(this).scrollTop() !== 0) {
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').on('click', function () {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    $('.stickyshare, .stickydetails').theiaStickySidebar({
        additionalMarginTop: 155
    });
});

function checkyear() {
    var finyear = $("#finyear").val();
    if (finyear <= 0) {
        $('#disablemode').removeAttr("type").attr("type", "button");
        swal({
            title: "Failed",
            text: "Please contact with system administrator, thank you !!",
            type: "error",
            confirmButtonColor: "#28a745",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        });
        return false;
    }
}

function language_select(element) {
    const selectedLanguage = element.value;

    if (selectedLanguage === '') {
        alert("Please select a language.");
        return;
    }

    // Get the CSRF token name and value from CodeIgniter
    const csrfName = $("#get_csrf_token_name").val();
    const csrfHash = $("#get_csrf_hash").val();
    const url = $("#base_url").val() + 'hotel/update_language';

    $.ajax({
        url: url,
        type: "POST",
        data: {
            language: selectedLanguage,
            [csrfName]: csrfHash // Include CSRF token in the data
        },
        success: function(response) {
            console.log("Server Response:", response);
            if (response.trim() !== '') {
                location.reload();
            } else {
                alert("Failed to change language.");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("An error occurred while updating the language.");
        }
    });
}