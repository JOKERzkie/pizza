<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    include 'components/add_wishlist.php';
    include 'components/add_cart.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>menu page</title>
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
        
        /* Banner fade in */
        .banner.banner-fade-in {
            animation: bannerFadeIn 1s ease-in-out;
        }
        
        @keyframes bannerFadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Product animations */
        .slide-in-up {
            animation: slideInUp 0.8s ease forwards;
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
        
        .bounce-in {
            animation: bounceIn 0.8s ease forwards;
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
        
        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 1;
                transform: scale(1.05);
            }
            70% {
                transform: scale(0.9);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        /* Enhanced hover effects for products */
        .product-hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        }
        
        .image-zoom {
            transform: scale(1.1);
        }
        
        .button-glow {
            box-shadow: 0 0 20px rgba(255, 31, 90, 0.5);
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
        
        /* Header scroll effect */
        .header.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
        
        /* Stock badge animation */
        .stock-pulse {
            animation: stockPulse 2s infinite;
        }
        
        @keyframes stockPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        /* Price highlight animation */
        .price-highlight {
            animation: priceHighlight 0.5s ease;
        }
        
        @keyframes priceHighlight {
            0%, 100% { color: var(--main-color); }
            50% { color: var(--pink-color); transform: scale(1.1); }
        }
        
        /* Cart button bounce */
        .cart-bounce {
            animation: cartBounce 0.3s ease;
        }
        
        @keyframes cartBounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        /* Loading animation for products */
        .product-loading {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .product-loaded {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.5s ease;
        }
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    
    <div class="banner reveal">
        <div class="detail">
            <h1>our menu</h1> <br>
            <p>Our menu is crafted to satisfy every pizza lover's cravings, <br> offering a wide variety of classic and specialty pizzas made with the freshest ingredients.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>our menu</span>
        </div>
    </div>
    
    <div class="products">
        <div class="heading reveal">
            <h1>our latest pizza</h1> <br><br><br><br>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $select_products = $conn->prepare("SELECT * FROM products WHERE status = ?");
                $select_products->execute(['active']);

                if ($select_products->rowCount() > 0) {
                    while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

            ?>
            <form action="" method="post" class="box product-item reveal <?php if($fetch_products['stock'] == 0){echo "disable";} ?>">

            <img src="uploaded_files/<?= $fetch_products['image']; ?>" class="image">

            <?php if($fetch_products['stock'] > 9){ ?>
                <span class="stock" style="color: green;">In stock</span>
            <?php }elseif($fetch_products['stock'] == 0){ ?>
                <span class="stock" style="color: red;">Out of stock</span>
            <?php }else{ ?>
                <span class="stock stock-low" style="color: red;">Hurry, only <?= $fetch_products['stock']; ?></span>
            <?php }?>
            <div class="content">
                <img src="image/shape-19.png" alt="" class="shap">
                <div class="button">
                    <div> <h3 class="name"><?= $fetch_products['name']; ?></h3></div>
                    <div>
                        <button type="submit" name="add_to_cart" class="cart-btn"><i class="bx bx-cart"></i></button>
                        <button type="submit" name="add_to_wishlist" class="wishlist-btn"><i class="bx bx-heart"></i></button>
                        <a href="view_page.php?pid=<?= $fetch_products['id'] ?>" class="bx bxs-show view-btn" title="View Product"></a>
                    </div>
                </div>
                <p class="price">price $<?= $fetch_products['price']; ?></p>
                <input type="hidden" name="product_id" value="<?= $fetch_products['id'] ?>">
                <div class="flex-btn">
                    <a href="checkout.php?get_id=<?= $fetch_products['id'] ?>" class="btn buy-now-btn">buy now</a>
                    <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class="qty box">
                </div>
            </div>
            </form>
            <?php
                    }
                }else{
                    echo '
                        <div class="empty reveal">
                            <p>no products added yet!</p>
                        </div>
                    ';
                }
            ?>
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
                // Product items animation
                $('.product-item').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            $(this).addClass('scale-in');
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
            
            // Product hover effects
            $('.product-item').hover(
                function() {
                    if (!$(this).hasClass('disable')) {
                        $(this).addClass('product-hover');
                        $(this).find('.image').addClass('image-zoom');
                        $(this).find('.button').addClass('button-glow');
                    }
                },
                function() {
                    $(this).removeClass('product-hover');
                    $(this).find('.image').removeClass('image-zoom');
                    $(this).find('.button').removeClass('button-glow');
                }
            );

            // =================== BUTTON ANIMATIONS (FIXED) ===================
            
            // Cart button animation - FIXED VERSION
            $('.cart-btn').on('click', function(e) {
                // Don't prevent default - let the form submit naturally
                $(this).addClass('cart-bounce');
                setTimeout(() => {
                    $(this).removeClass('cart-bounce');
                }, 300);
            });

            // Wishlist button animation - Keep as is since it works
            $('.wishlist-btn').on('click', function(e) {
                const button = $(this);
                button.addClass('cart-bounce');
                button.find('i').removeClass('bx-heart').addClass('bxs-heart');
                setTimeout(() => {
                    button.removeClass('cart-bounce');
                    button.find('i').removeClass('bxs-heart').addClass('bx-heart');
                }, 1000);
            });

            // Buy now button ripple effect
            $('.buy-now-btn').on('click', function(e) {
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

            // View button hover effect
            $('.view-btn').hover(
                function() {
                    $(this).css('transform', 'scale(1.2)');
                },
                function() {
                    $(this).css('transform', 'scale(1)');
                }
            );

            // =================== STOCK ANIMATIONS ===================
            
            // Low stock pulse animation
            $('.stock-low').addClass('stock-pulse');

            // Price highlight on hover
            $('.product-item').hover(
                function() {
                    $(this).find('.price').addClass('price-highlight');
                },
                function() {
                    $(this).find('.price').removeClass('price-highlight');
                }
            );

            // =================== QUANTITY INPUT ENHANCEMENT ===================
            $('.qty').on('focus', function() {
                $(this).css({
                    'border-color': 'var(--main-color)',
                    'box-shadow': '0 0 10px rgba(255, 31, 90, 0.3)'
                });
            }).on('blur', function() {
                $(this).css({
                    'border-color': '',
                    'box-shadow': ''
                });
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

            // =================== PRODUCT LOADING ANIMATION ===================
            function loadProductsWithAnimation() {
                $('.product-item').each(function(index) {
                    $(this).addClass('product-loading');
                    setTimeout(() => {
                        $(this).removeClass('product-loading').addClass('product-loaded');
                    }, index * 150);
                });
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
                $('.banner').addClass('banner-fade-in');
                
                // Typing effect for main heading
                const mainHeading = $('.banner .detail h1').first();
                if (mainHeading.length) {
                    const originalText = mainHeading.text();
                    typeWriter(mainHeading, originalText, 120);
                }
            }, 300);

            setTimeout(() => {
                animateOnScroll();
                loadProductsWithAnimation();
            }, 800);

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

            // =================== SEARCH FUNCTIONALITY ENHANCEMENT ===================
            $('.search-form input').on('focus', function() {
                $(this).parent().css('box-shadow', '0 0 15px rgba(255, 31, 90, 0.3)');
            }).on('blur', function() {
                $(this).parent().css('box-shadow', '');
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