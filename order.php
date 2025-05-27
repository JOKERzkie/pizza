<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
        header('location:login.php');
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user order page</title>
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
        
        /* Order animations */
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
        
        /* Enhanced hover effects for orders */
        .order-hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .order-hover.delivered {
            box-shadow: 0 20px 40px rgba(0, 255, 0, 0.2);
        }
        
        .order-hover.canceled {
            box-shadow: 0 20px 40px rgba(255, 0, 0, 0.2);
        }
        
        .order-hover.pending {
            box-shadow: 0 20px 40px rgba(255, 165, 0, 0.2);
        }
        
        .image-zoom {
            transform: scale(1.1);
        }
        
        /* Status badge animations */
        .status-pulse {
            animation: statusPulse 2s infinite;
        }
        
        @keyframes statusPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        
        .status-delivered {
            animation: deliveredGlow 2s infinite;
        }
        
        @keyframes deliveredGlow {
            0%, 100% { box-shadow: 0 0 5px rgba(0, 255, 0, 0.5); }
            50% { box-shadow: 0 0 20px rgba(0, 255, 0, 0.8); }
        }
        
        .status-canceled {
            animation: canceledShake 0.5s ease-in-out;
        }
        
        @keyframes canceledShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        /* Date badge animation */
        .date-float {
            animation: dateFloat 3s ease-in-out infinite;
        }
        
        @keyframes dateFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-5px); }
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
        
        /* Empty state animation */
        .empty-bounce {
            animation: emptyBounce 2s ease-in-out infinite;
        }
        
        @keyframes emptyBounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        
        /* Loading animation for orders */
        .order-loading {
            opacity: 0;
            transform: translateY(20px);
        }
        
        .order-loaded {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.5s ease;
        }
        
        /* Click ripple effect */
        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 31, 90, 0.3);
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
    </style>
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    
    <div class="banner reveal">
        <div class="detail">
            <h1>my orders</h1> <br>
            <p>Pizza is one of the most popular and beloved foods worldwide, <br>originating from Italy but now enjoyed in countless variations across the globe.</p>
            <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>my orders</span>
        </div>
    </div>
    
    <div class="orders">
        <div class="heading reveal">
            <h1>my orders</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $select_orders = $conn->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY date DESC");
                $select_orders->execute([$user_id]);

                if ($select_orders->rowCount() > 0) {
                    while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                        $product_id = $fetch_orders['product_id'];

                        $select_products = $conn->prepare("SELECT * FROM products WHERE id = ?");
                        $select_products->execute([$product_id]);

                        if ($select_products->rowCount() > 0) {
                            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){

                            
            ?>
            <div class="box order-item reveal <?= $fetch_orders['status']; ?>" 
                 data-status="<?= $fetch_orders['status']; ?>"
                 <?php if($fetch_orders['status'] == 'canceled'){echo 'style="border:2px solid red;"';} ?>>
                <a href="view_order.php?get_id=<?= $fetch_orders['id']; ?>" class="order-link">
                    <img src="uploaded_files/<?= $fetch_products['image'] ?>" class="image">
                    <p class="date date-badge"><i class="bx bxs-calendar-alt"></i> <?= $fetch_orders['date']; ?></p>
                    
                    <div class="content">
                        <img src="image/shape-19.png">
                        
                        <div class="row">
                            <h3 class="name"><?= $fetch_products['name'] ?></h3>
                            <p class="price">Price: <?= $fetch_products['price'] ?>/‑</p>
                            <p class="status status-badge" style="color:<?php 
                            if($fetch_orders['status'] == 'delivered'){
                                    echo 'green';
                                } elseif($fetch_orders['status'] == 'canceled'){
                                    echo 'red';
                                } else {
                                    echo 'orange';
                                }
                            ?>">
                                <?= $fetch_orders['status']; ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>

            <?php
                            }
                        }
                    }
                }else{
                    echo '<p class="empty reveal empty-state">no order take place yet</p>';
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
                // Order items animation
                $('.order-item').each(function(index) {
                    if (isInViewport($(this)) && !$(this).hasClass('animated')) {
                        $(this).addClass('animated');
                        setTimeout(() => {
                            if (index % 2 === 0) {
                                $(this).addClass('slide-in-left');
                            } else {
                                $(this).addClass('slide-in-right');
                            }
                        }, index * 150);
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
            
            // Order hover effects based on status
            $('.order-item').hover(
                function() {
                    const status = $(this).data('status');
                    $(this).addClass('order-hover');
                    $(this).addClass(status); // Add status class for specific styling
                    $(this).find('.image').addClass('image-zoom');
                },
                function() {
                    const status = $(this).data('status');
                    $(this).removeClass('order-hover');
                    $(this).removeClass(status);
                    $(this).find('.image').removeClass('image-zoom');
                }
            );

            // =================== STATUS BADGE ANIMATIONS ===================
            
            // Add status-specific animations
            $('.status-badge').each(function() {
                const status = $(this).text().trim().toLowerCase();
                
                if (status === 'delivered') {
                    $(this).addClass('status-delivered');
                } else if (status === 'canceled') {
                    $(this).addClass('status-canceled');
                } else {
                    $(this).addClass('status-pulse');
                }
            });

            // =================== DATE BADGE ANIMATION ===================
            $('.date-badge').addClass('date-float');

            // =================== CLICK ANIMATIONS ===================
            
            // Order link click effect
            $('.order-link').on('click', function(e) {
                const link = $(this);
                const ripple = $('<span class="ripple-effect"></span>');
                link.append(ripple);
                
                const x = e.pageX - link.offset().left;
                const y = e.pageY - link.offset().top;
                
                ripple.css({
                    left: x + 'px',
                    top: y + 'px'
                }).addClass('animate');
                
                setTimeout(() => ripple.remove(), 600);
            });

            // =================== EMPTY STATE ANIMATION ===================
            $('.empty-state').addClass('empty-bounce');

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

            // =================== ORDER LOADING ANIMATION ===================
            function loadOrdersWithAnimation() {
                $('.order-item').each(function(index) {
                    $(this).addClass('order-loading');
                    setTimeout(() => {
                        $(this).removeClass('order-loading').addClass('order-loaded');
                    }, index * 100);
                });
            }

            // =================== ORDER FILTERING ANIMATION ===================
            function filterOrdersByStatus(status) {
                $('.order-item').each(function(index) {
                    const orderStatus = $(this).data('status');
                    if (status === 'all' || orderStatus === status) {
                        $(this).show().addClass('fade-in-up');
                    } else {
                        $(this).hide().removeClass('fade-in-up');
                    }
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
                loadOrdersWithAnimation();
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

            // =================== ORDER STATUS COUNTER ANIMATION ===================
            function animateOrderCounts() {
                const totalOrders = $('.order-item').length;
                const deliveredOrders = $('.order-item[data-status="delivered"]').length;
                const pendingOrders = $('.order-item[data-status="pending"]').length;
                const canceledOrders = $('.order-item[data-status="canceled"]').length;
                
                console.log(`📊 Order Statistics:
                    Total: ${totalOrders}
                    Delivered: ${deliveredOrders}
                    Pending: ${pendingOrders}
                    Canceled: ${canceledOrders}`);
            }

            // =================== CUSTOM EASING ===================
            $.easing.easeInOutCubic = function (x, t, b, c, d) {
                if ((t/=d/2) < 1) return c/2*t*t*t + b;
                return c/2*((t-=2)*t*t + 2) + b;
            };

            // Initialize order statistics
            setTimeout(animateOrderCounts, 1000);

        });
    </script>

    <?php include 'components/alert.php'; ?>
</body>
</html>