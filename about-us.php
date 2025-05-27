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
    <title>about-us page</title>
    <link rel="stylesheet" type="text/css" href="css/user_styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css">
    
    <!-- jQuery Library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Only Animation Enhancement Styles (no duplicates) -->
    <style>
        /* =================== ADDITIONAL ANIMATION ENHANCEMENTS =================== */
        
        /* Page loading animation */
        body.page-loaded {
            animation: pageLoad 0.5s ease-in-out;
        }
        
        @keyframes pageLoad {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        /* Scroll animations */
        .slide-in-up {
            animation: slideInUp 0.8s ease forwards;
        }
        
        .slide-in-left {
            animation: slideInLeft 0.8s ease forwards;
        }
        
        .slide-in-right {
            animation: slideInRight 0.8s ease forwards;
        }
        
        .zoom-in {
            animation: zoomIn 0.6s ease forwards;
        }
        
        .fade-in-up {
            animation: fadeInUp 0.7s ease forwards;
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
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
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
        .team-hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
        
        .mission-hover {
            transform: scale(1.05);
            box-shadow: 0 15px 30px rgba(255, 31, 90, 0.2);
        }
        
        /* Button ripple effect */
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
        
        /* Floating animation for icons */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        /* Header scroll effect */
        .header.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    
    <div class="banner reveal">
        <div class="detail">
            <h1>about us</h1> <br>
            <p>At The Rise of Pizza, we are passionate about delivering high-quality products and <br> exceptional service to our customers.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
        </div>
    </div>
    
    <div class="chef">
        <div class="box-container">
            <div class="box reveal">
                <div class="heading">
                    <span>JM young</span>
                    <h1>ImmortalChef</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>JM Young is a Immortal born in dark continent who spent 15 years in the city of panaon misamis occidental</p>
                <div class="flex-btn">
                    <a href="" class="btn">explore our menu</a>
                    <a href="menu.php" class="btn">visit our shop</a>
                </div>
            </div>
            <div class="box reveal">
                <img src="image/ceaf.png" class="img">
            </div>
        </div>
    </div>

    <!-- chef section end -->
    <div class="story reveal">
        <div class="heading">
            <h1>our story</h1>
            <img src="image/separator-img.png">
        </div>
        <p>Our story began with a simple love for great food and <br> a passion for bringing people together over a delicious meal.</p>
        <a href="menu.php" class="btn">our servises</a>
    </div>
    
    <div class="container">
        <div class="box-container">
            <div class="img-box reveal">
                <img src="image/about.png">
            </div>
            <div class="box reveal">
                <div class="heading">
                    <h1>Taking Pizza To New Heights</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>At The Rise of Pizza, we're not just making pizza — we're redefining it.</p>
                <a href="" class="btn">learn more</a>
            </div>
        </div>
    </div>

    <!-- story section -->
    <div class="team">
        <div class="heading reveal">
            <span>our team</span>
            <h1>Quality & passion with our services</h1>
            <img src="image/separator-img.png">
        </div>

        <div class="box-container">
            <div class="box reveal team-member">
                <img src="image/team-1.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Glenald</h2>
                    <p>Brader Master</p>
                </div>
            </div>

            <div class="box reveal team-member">
                <img src="image/team-2.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Dudong</h2>
                    <p>Doggy Master</p>
                </div>
            </div>

            <div class="box reveal team-member">
                <img src="image/team-3.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Euri</h2>
                    <p>Beauty Master</p>
                </div>
            </div>
        </div>

        <div class="standers reveal">
            <div class="detail">
                <div class="heading">
                    <h1>our standards</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Balanced warmth with polished phrasing...😎</p>
                <i class="bx bxs-heart floating"></i>
                <p>Focus on universal strengths (adaptability, teamwork)...😎</p>
                <i class="bx bxs-heart floating"></i>
                <p>Shows how their qualities create value...😎</p>
                <i class="bx bxs-heart floating"></i>
                <p>Works for references, introductions, or bios...😎</p>
                <i class="bx bxs-heart floating"></i>
                <p>Formal introductions Please welcome Ira, who brings...😎</p>
                <i class="bx bxs-heart floating"></i>
            </div>
        </div>
    </div>
    
    <!-- standers section -->
    <div class="testimonial reveal">
        <div class="heading">
            <h1>testimonial</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>JM Young is a business analyst, entrepreneur and media proprietor, and investor. He also known as the best selling book author.</p>
                        <h2>JM</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Euri Buladaco is the most beautiful in false gay.</p>
                        <h2>Euri</h2>
                        <p>beauty</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (2).jpg">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Ira Am-is is always convinces you to stay out past your bedtime.</p>
                        <h2>Ira</h2>
                        <p>Crazy</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (3).jpg">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Trisha is the one who dominates karaoke nights, laughs way too loud in quiet places, and somehow always convinces you to stay out past your bedtime.</p>
                        <h2>Trisha</h2>
                        <p>Singer</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (4).jpg">
                    </div>
                </div>
            </div>
        </div>
        <div class="indicator">
            <span class="btn1 active"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
            <span class="btn1"></span>
        </div>
    </div>

    <!-- Mission Section Start -->
    <div class="mission reveal">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <h1>Our Mission</h1>
                    <img src="image/separator-img.png" alt="Separator">
                </div>
                
                <div class="detail mission-item">
                    <div class="img-box">
                        <img src="image/mission.webp" alt="Mexsouce Pizza">
                    </div>
                    <div>
                        <h2>Mexsouce Pizza</h2>
                        <p></p>
                    </div>
                </div>

                <div class="detail mission-item">
                    <div class="img-box">
                        <img src="image/mission0.jpg" alt="Hot Pizza">
                    </div>
                    <div>
                        <h2>Original Pizza</h2>
                        <p></p>
                    </div>
                </div>

                <div class="detail mission-item">
                    <div class="img-box">
                        <img src="image/mission1.webp" alt="Vegetable Pizza">
                    </div>
                    <div>
                        <h2>Vegetable Pizza</h2>
                        <p></p>
                    </div>
                </div>

                <div class="detail mission-item">
                    <div class="img-box">
                        <img src="image/mission2.webp" alt="Extra Hot Pizza">
                    </div>
                    <div>
                        <h2>Extra Hot Pizza</h2>
                        <p></p>
                    </div>
                </div>
            </div>

            <div class="box reveal">
                <img src="image/form.png" class="img" alt="Form Image">
            </div>
        </div>
    </div>

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

            // =================== SCROLL ANIMATIONS ===================
            function isInViewport(element) {
                const elementTop = element.offset().top;
                const elementBottom = elementTop + element.outerHeight();
                const viewportTop = $(window).scrollTop();
                const viewportBottom = viewportTop + $(window).height();
                return elementBottom > viewportTop && elementTop < viewportBottom - 100;
            }

            function animateOnScroll() {
                // Chef section animation
                $('.chef .box').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            if (index === 0) {
                                $(this).addClass('slide-in-left');
                            } else {
                                $(this).addClass('slide-in-right');
                            }
                        }, index * 200);
                    }
                });

                // Team members animation
                $('.team .box').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            $(this).addClass('scale-in');
                        }, index * 150);
                    }
                });

                // Mission items animation
                $('.mission .detail').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            $(this).addClass('slide-in-left');
                        }, index * 100);
                    }
                });

                // General reveal animations
                $('.reveal').each(function() {
                    if (isInViewport($(this))) {
                        $(this).addClass('revealed');
                    }
                });
            }

            // =================== ENHANCED HOVER EFFECTS ===================
            
            // Team member hover effects
            $('.team-member').hover(
                function() {
                    $(this).addClass('team-hover');
                },
                function() {
                    $(this).removeClass('team-hover');
                }
            );

            // Mission item hover effects
            $('.mission-item').hover(
                function() {
                    $(this).addClass('mission-hover');
                },
                function() {
                    $(this).removeClass('mission-hover');
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
            });

            // =================== TESTIMONIAL SLIDER ENHANCEMENT ===================
            let currentTestimonial = 0;
            const testimonialSlides = $('.slide-col');
            const totalTestimonials = testimonialSlides.length;
            const indicators = $('.btn1');

            function showTestimonial(index) {
                const slideWidth = $('.slide-col').outerWidth();
                $('#slide').css('transform', `translateX(-${index * slideWidth}px)`);
                
                indicators.removeClass('active');
                indicators.eq(index).addClass('active');
            }

            // Auto-play testimonials
            setInterval(() => {
                currentTestimonial = (currentTestimonial + 1) % totalTestimonials;
                showTestimonial(currentTestimonial);
            }, 5000);

            // Manual testimonial navigation
            indicators.click(function() {
                currentTestimonial = $(this).index();
                showTestimonial(currentTestimonial);
            });

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
                animateOnScroll();
                
                // Typing effect for main heading
                const mainHeading = $('.banner .detail h1').first();
                if (mainHeading.length) {
                    const originalText = mainHeading.text();
                    typeWriter(mainHeading, originalText, 120);
                }
            }, 500);

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

            // =================== FLOATING HEARTS ANIMATION ===================
            setInterval(() => {
                $('.floating').each(function(index) {
                    setTimeout(() => {
                        $(this).css('animation-delay', `${index * 0.5}s`);
                    }, index * 200);
                });
            }, 3000);

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