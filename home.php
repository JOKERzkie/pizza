<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <link rel="stylesheet" type="text/css" href="css/user_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
    
    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Animation Enhancement Styles -->
    <style>
        /* =================== ANIMATION ENHANCEMENTS =================== */
        
        /* Page loading animation */
        body {
            opacity: 0;
            transition: opacity 0.5s ease;
        }
        
        body.page-loaded {
            opacity: 1;
        }
        
        /* Header slide down animation */
        .header {
            transform: translateY(-100%);
            transition: all 0.5s ease;
        }
        
        .header.header-slide-down {
            transform: translateY(0);
        }
        
        .header.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        
        /* Slider fade in */
        .slider-container {
            opacity: 0;
            transform: scale(0.95);
            transition: all 1s ease;
        }
        
        .slider-container.slider-fade-in {
            opacity: 1;
            transform: scale(1);
        }
        
        /* Scroll animations */
        .slide-in-up {
            animation: slideInUp 0.8s ease forwards;
        }
        
        .zoom-in {
            animation: zoomIn 0.6s ease forwards;
        }
        
        .fade-in-up {
            animation: fadeInUp 0.7s ease forwards;
        }
        
        .slide-in-left {
            animation: slideInLeft 0.8s ease forwards;
        }
        
        .scale-in {
            animation: scaleIn 0.6s ease forwards;
        }
        
        /* Keyframe animations */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Enhanced hover effects */
        .hover-lift {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(255, 31, 90, 0.2);
        }
        
        .icon-bounce {
            animation: iconBounce 0.6s ease;
        }
        
        @keyframes iconBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        .tilt-effect {
            transform: perspective(1000px) rotateX(5deg) rotateY(5deg);
        }
        
        .zoom-effect {
            transform: scale(1.15);
        }
        
        .product-hover {
            transform: translateY(-15px);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
        
        .content-lift {
            transform: translateY(-5px);
        }
        
        /* Button enhancements */
        .btn {
            position: relative;
            overflow: hidden;
        }
        
        .btn-pulse {
            animation: btnPulse 0.3s ease;
        }
        
        @keyframes btnPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            pointer-events: none;
            width: 20px;
            height: 20px;
            margin-left: -10px;
            margin-top: -10px;
        }
        
        .ripple-effect.animate {
            animation: ripple 0.6s linear;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        /* Typing effect */
        .typing::after {
            content: '|';
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 50% { opacity: 1; }
            51%, 100% { opacity: 0; }
        }
        
        /* Scroll progress bar */
        .scroll-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(90deg, var(--main-color), var(--pink-color));
            z-index: 9999;
            transition: width 0.3s ease;
        }
        
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--main-color);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .back-to-top:hover {
            background: var(--pink-color);
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 31, 90, 0.3);
        }
        
        /* Reveal animation */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }
        
        .reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Mobile menu animation */
        .navbar.show {
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Enhanced slider transitions */
        .sliderBox .textBox {
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .sliderBox .imgBox {
            transition: all 1s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    
    <!-- slider section start -->
    <div class="slider-container">
        <div class="slider">
            <div class="sliderBox active">
                <div class="textBox">
                    <h1>we pride our selfs on <br> exceptional flavors</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider.jpg">
                </div>
            </div>

            <div class="sliderBox">
                <div class="textBox">
                    <h1>cold treats are my kind<br> of comfort food</h1>
                    <a href="menu.php" class="btn">shop now</a>
                </div>
                <div class="imgBox">
                    <img src="image/slider0.jpg">
                </div>
            </div>
        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"> <i class="bx bx-right-arrow-alt"></i></li>
            <li onclick="prevSlide();" class="prev"> <i class="bx bx-left-arrow-alt"></i></li>
        </ul>
    </div>

    <!-- service section start -->
    <div class="service">
        <div class="box-container">
            <!-- Service Item: Delivery -->
            <div class="box reveal">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>

            <!-- Service Item: Payment -->
            <div class="box reveal">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (2).png" class="img1">
                        <img src="image/services (3).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Payment</h4>
                    <span>100% secure</span>
                </div>
            </div>

            <!-- Service Item: Support -->
            <div class="box reveal">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (5).png" class="img1">
                        <img src="image/services (6).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Support</h4>
                    <span>24/7 hours</span>
                </div>
            </div>

            <!-- Service Item: Gift Service -->
            <div class="box reveal">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services (7).png" class="img1">
                        <img src="image/services (8).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Gift Service</h4>
                    <span>Support gift service</span>
                </div>
            </div>

            <!-- Service Item: Return -->
            <div class="box reveal">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/service.png" class="img1">
                        <img src="image/service (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Return</h4>
                    <span>24/7 free return</span>
                </div>
            </div>

            <!-- Service Item: Deliver -->
            <div class="box reveal">
                <div class="icon">
                    <div class="icon-box">
                        <img src="image/services.png" class="img1">
                        <img src="image/services (1).png" class="img2">
                    </div>
                </div>
                <div class="detail">
                    <h4>Deliver</h4>
                    <span>100% secure</span>
                </div>
            </div>
        </div>
    </div>
    <!-- service section end -->
    
    <div class="categories">
        <div class="heading reveal">
            <h1>categories features</h1>
            <img src="image/separator-img.png">
        </div>
        
        <div class="box-container">
            <div class="box reveal">
                <img src="image/categories.jpg">
                <a href="menu.php" class="btn">Margherita</a>
            </div>

            <div class="box reveal">
                <img src="image/categories0.jpg">
                <a href="menu.php" class="btn">Detroit pizza</a>
            </div>

            <div class="box reveal">
                <img src="image/categories2.jpg">
                <a href="menu.php" class="btn">Hawaiian pizza</a>
            </div>

            <div class="box reveal">
                <img src="image/categories1.jpg">
                <a href="menu.php" class="btn">Capricciosa</a>
            </div>
        </div>
    </div>
    <!-- categories section end -->
    
    <img src="image/menu-banner.jpg" class="menu-banner">
    
    <div class="taste">
        <div class="heading reveal">
            <span>Taste</span>
            <h1>buy any pizza @ get one free</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box reveal">
                <img src="image/taste.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>hot</h1>
                </div>
            </div>

            <div class="box reveal">
                <img src="image/taste0.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>sweet</h1>
                </div>
            </div>

            <div class="box reveal">
                <img src="image/taste1.webp">
                <div class="detail">
                    <h2>natural sweetness</h2>
                    <h1>original</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- taste section end -->
    
    <div class="pizza-container">
        <div class="overlay"></div>
        <div class="detail">
            <h1>Pizza is cheaper than <br> therapy for stress</h1><br>
            <p>Kaya kumain kayo ng pizza para hindi kayo ma brader <br> Di baling iniwan tayo atleast busog </p>
            <a href="menu.php" class="btn">palit namo</a>
        </div>
    </div>
    <!-- container section end -->
    
    <div class="taste2">
        <div class="t-banner">
            <div class="overlay"></div>
            <div class="detail">
                <h1>find your taste snack</h1>
                <p>Treat them to a delicious treat and send them some Lucky</p>
                <a href="menu.php" class="btn">palit namo</a>
            </div>
        </div>
        <div class="box-container">
            <div class="box reveal">
                <div class="box-overlay"></div>
                <img src="image/type4.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>hot</h1>
                    <p>find your taste snack</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box reveal">
                <div class="box-overlay"></div>
                <img src="image/type.avif">
                <div class="box-details fadeIn-bottom">
                    <h1>hot</h1>
                    <p>find your taste snack</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box reveal">
                <div class="box-overlay"></div>
                <img src="image/type1.png">
                <div class="box-details fadeIn-bottom">
                    <h1>hot</h1>
                    <p>find your taste snack</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box reveal">
                <div class="box-overlay"></div>
                <img src="image/type2.png">
                <div class="box-details fadeIn-bottom">
                    <h1>hot</h1>
                    <p>find your taste snack</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box reveal">
                <div class="box-overlay"></div>
                <img src="image/type0.avif">
                <div class="box-details fadeIn-bottom">
                    <h1>hot</h1>
                    <p>find your taste snack</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>

            <div class="box reveal">
                <div class="box-overlay"></div>
                <img src="image/type4.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>hot</h1>
                    <p>find your taste snack</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
            </div>
        </div>
    </div>
    <!-- taste2 section end -->
    
    <div class="flavor">
        <div class="box-container reveal">
            <img src="image/left-banner2.webp">
            <div class="detail">
                <h1>Hot deal ! sale Up To <span>20% off</span></h1>
                <p>expired</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
    </div>
    <!-- flavour section end -->
    
    <div class="usage">
        <div class="heading reveal">
            <h1>how it works</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="row">
            <div class="box-container">
                <div class="box reveal">
                    <img src="image/icon.avif">
                    <div class="detail">
                        <h3>slice pizza</h3>
                        <p>isa ka slice lang nga pizza inyong makaon makakita namog langit</p>
                    </div>
                </div>

                <div class="box reveal">
                    <img src="image/icon0.avif">
                    <div class="detail">
                        <h3>slice pizza</h3>
                        <p>isa ka slice lang nga pizza inyong makaon makakita namog langit</p>
                    </div>
                </div>

                <div class="box reveal">
                    <img src="image/icon1.avif">
                    <div class="detail">
                        <h3>slice pizza</h3>
                        <p>isa ka slice lang nga pizza inyong makaon makakita namog langit</p>
                    </div>
                </div>
            </div>
            <img src="image/sub-banner.png" class="divider">
            <div class="box-container">
                <div class="box reveal">
                    <img src="image/icon2.avif">
                    <div class="detail">
                        <h3>slice pizza</h3>
                        <p>isa ka slice lang nga pizza inyong makaon makakita namog langit</p>
                    </div>
                </div>

                <div class="box reveal">
                    <img src="image/icon3.avif">
                    <div class="detail">
                        <h3>slice pizza</h3>
                        <p>isa ka slice lang nga pizza inyong makaon makakita namog langit</p>
                    </div>
                </div>

                <div class="box reveal">
                    <img src="image/icon4.avif">
                    <div class="detail">
                        <h3>slice pizza</h3>
                        <p>isa ka slice lang nga pizza inyong makaon makakita namog langit</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- usage section end -->
    
    <div class="pride">
        <div class="detail reveal">
            <h1>We Pride Ourselves On <br> Exceptional Flavors.</h1>
            <p>ako pa ninyo order namo...unya namo mo order ug hurot na..mga pinoy jd</p>
            <a href="menu.php" class="btn">shop now</a>
        </div>
    </div>
    <!-- pride section end -->

    <?php include 'components/footer.php'; ?>
    
    <!-- sweetAlert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="js/user_script.js"></script>

    <!-- Enhanced jQuery Animations -->
    <script>
        $(document).ready(function() {
            
            // =================== SMOOTH SCROLLING ===================
            $('a[href^="#"], .navbar a').on('click', function(event) {
                const target = $(this.getAttribute('href'));
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 100
                    }, 1200, 'easeInOutCubic');
                }
            });

            // =================== MOBILE MENU TOGGLE ===================
            $('#menu-btn').on('click', function() {
                $('.navbar').toggleClass('show');
                $(this).toggleClass('fa-times fa-bars');
            });

            // =================== ENHANCED SLIDER FUNCTIONALITY ===================
            let currentSlide = 0;
            const slides = $('.sliderBox');
            const totalSlides = slides.length;
            let slideInterval;

            function showSlide(index, direction = 'next') {
                slides.removeClass('active');
                
                const exitingSlide = slides.eq(currentSlide);
                exitingSlide.find('.textBox').animate({
                    opacity: 0,
                    transform: direction === 'next' ? 'translateX(-100px)' : 'translateX(100px)'
                }, 400);
                
                exitingSlide.find('.imgBox').animate({
                    opacity: 0,
                    transform: 'scale(0.8)'
                }, 400);

                setTimeout(() => {
                    slides.eq(index).addClass('active');
                    
                    const newSlide = slides.eq(index);
                    const textBox = newSlide.find('.textBox');
                    const imgBox = newSlide.find('.imgBox');
                    
                    textBox.css({
                        opacity: 0,
                        transform: direction === 'next' ? 'translateX(100px)' : 'translateX(-100px)'
                    }).animate({
                        opacity: 1
                    }, 800).css('transform', 'translateX(0)');
                    
                    imgBox.css({
                        opacity: 0,
                        transform: 'scale(1.2)'
                    }).animate({
                        opacity: 1
                    }, 1000).css('transform', 'scale(1)');
                }, 500);
            }

            function startSlideShow() {
                slideInterval = setInterval(() => {
                    currentSlide = (currentSlide + 1) % totalSlides;
                    showSlide(currentSlide, 'next');
                }, 6000);
            }

            function stopSlideShow() {
                clearInterval(slideInterval);
            }

            startSlideShow();
            $('.slider-container').hover(stopSlideShow, startSlideShow);

            window.nextSlide = function() {
                stopSlideShow();
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide, 'next');
                startSlideShow();
            };

            window.prevSlide = function() {
                stopSlideShow();
                currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
                showSlide(currentSlide, 'prev');
                startSlideShow();
            };

            // =================== SCROLL ANIMATIONS ===================
            function isInViewport(element) {
                const elementTop = element.offset().top;
                const elementBottom = elementTop + element.outerHeight();
                const viewportTop = $(window).scrollTop();
                const viewportBottom = viewportTop + $(window).height();
                return elementBottom > viewportTop && elementTop < viewportBottom - 100;
            }

            function animateOnScroll() {
                $('.service .box').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            $(this).addClass('slide-in-up');
                        }, index * 150);
                    }
                });

                $('.categories .box').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            $(this).addClass('zoom-in');
                        }, index * 200);
                    }
                });

                $('.taste .box, .taste2 .box').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            $(this).addClass('fade-in-up');
                        }, index * 100);
                    }
                });

                $('.usage .box').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            $(this).addClass('slide-in-left');
                        }, index * 200);
                    }
                });

                $('.reveal').each(function() {
                    if (isInViewport($(this))) {
                        $(this).addClass('revealed');
                    }
                });
            }

            // =================== ENHANCED HOVER EFFECTS ===================
            $('.service .box').hover(
                function() {
                    $(this).addClass('hover-lift');
                    $(this).find('.icon-box').addClass('icon-bounce');
                },
                function() {
                    $(this).removeClass('hover-lift');
                    $(this).find('.icon-box').removeClass('icon-bounce');
                }
            );

            $('.categories .box').hover(
                function() {
                    $(this).addClass('tilt-effect');
                    $(this).find('img').addClass('zoom-effect');
                },
                function() {
                    $(this).removeClass('tilt-effect');
                    $(this).find('img').removeClass('zoom-effect');
                }
            );

            // =================== BUTTON ANIMATIONS ===================
            $('.btn').on('click', function(e) {
                const button = $(this);
                const ripple = $('<span class="ripple-effect"></span>');
                button.append(ripple);
                
                const x = e.pageX - button.offset().left;
                const y = e.pageY - button.offset().top;
                
                ripple.css({
                    left: x + 'px',
                    top: y + 'px'
                }).addClass('animate');
                
                setTimeout(() => ripple.remove(), 600);
                button.addClass('btn-pulse');
                setTimeout(() => button.removeClass('btn-pulse'), 300);
            });

            // =================== PARALLAX EFFECTS ===================
            function parallaxScroll() {
                const scrolled = $(window).scrollTop();
                $('.taste, .pizza-container, .newsletter, .team').each(function() {
                    const rate = scrolled * -0.3;
                    $(this).css('background-position', `center ${rate}px`);
                });
                $('.menu-banner').css('transform', `translateY(${scrolled * 0.1}px)`);
            }

            // =================== SCROLL PROGRESS INDICATOR ===================
            function updateScrollProgress() {
                const scrollTop = $(window).scrollTop();
                const docHeight = $(document).height() - $(window).height();
                const scrollPercent = (scrollTop / docHeight) * 100;
                
                if (!$('.scroll-progress').length) {
                    $('body').prepend('<div class="scroll-progress"></div>');
                }
                $('.scroll-progress').css('width', scrollPercent + '%');
            }

            // =================== TYPING EFFECT ===================
            function typeWriter(element, text, speed = 80) {
                let i = 0;
                element.text('');
                element.addClass('typing');
                
                function type() {
                    if (i < text.length) {
                        element.text(element.text() + text.charAt(i));
                        i++;
                        setTimeout(type, speed);
                    } else {
                        element.removeClass('typing');
                    }
                }
                type();
            }

            // =================== EVENT LISTENERS ===================
            $(window).on('scroll', function() {
                animateOnScroll();
                parallaxScroll();
                updateScrollProgress();
                
                if ($(window).scrollTop() > 100) {
                    $('.header').addClass('scrolled');
                } else {
                    $('.header').removeClass('scrolled');
                }
            });

            // =================== INITIALIZE ANIMATIONS ===================
            $('body').addClass('page-loaded');
            
            setTimeout(() => {
                $('.header').addClass('header-slide-down');
                setTimeout(() => {
                    $('.slider-container').addClass('slider-fade-in');
                }, 300);
            }, 100);

            setTimeout(() => {
                animateOnScroll();
                const mainHeading = $('.slider-container .textBox h1').first();
                if (mainHeading.length) {
                    const originalText = mainHeading.text();
                    typeWriter(mainHeading, originalText, 100);
                }
            }, 1000);

            // =================== BACK TO TOP BUTTON ===================
            $('body').append('<button class="back-to-top" title="Back to Top"><i class="fas fa-arrow-up"></i></button>');
            
            $('.back-to-top').click(function() {
                $('html, body').animate({ scrollTop: 0 }, 1000);
            });

            $(window).scroll(function() {
                if ($(window).scrollTop() > 300) {
                    $('.back-to-top').addClass('show');
                } else {
                    $('.back-to-top').removeClass('show');
                }
            });

            // =================== CUSTOM EASING ===================
            $.easing.easeInOutCubic = function (x, t, b, c, d) {
                if ((t/=d/2) < 1) return c/2*t*t*t + b;
                return c/2*((t-=2)*t*t + 2) + b;
            };

        });
    </script>

    <?php include 'components/alert.php'; ?>
</body>
</html>