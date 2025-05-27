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
</head>
<body>
    <?php include 'components/user_header.php'; ?>
    <div class="banner">
    <div class="detail">
        <h1>about us</h1>
        <p>so mao diay ni atong about us huh...aron dli ta mawala huhuhu</p>
        <span><a href="home.php">home</a><i class="bx bx-right-arrow-alt"></i>about us</span>
    </div>
   </div>
   <div class="chef">
    <div class="box-container">
        <div class="box">
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
        <div class="box">
            <img src="image/ceaf.png" class="img">
        </div>
    </div>
   </div>

     <!-- chef section end -->
     <div class="story">
        <div class="heading">
            <h1>our story</h1>
            <img src="image/separator-img.png">
        </div>
        <p>story ni jm katong single pa saona pero karon single gihapon kay wla may gusto....paita HUHUHU</p>
        <a href="menu.php" class="btn">our servises</a>
     </div>
     <div class="container">
        <div class="box-container">
            <div class="img-box">
                <img src="image/about.png">
            </div>
            <div class="box">
                <div class="heading">
                    <h1>Taking Pizza To New Heights</h1>
                    <img src="image/separator-img.png">
                </div>
                <p>Basta maka kaon mo sa akong pizza...dibali nang sigle...basta busog...</p>
                <a href="" class="btn">learn more</a>
            </div>
        </div>
     </div>

     <!-- story section -->
    <div class="team">
        <div class="heading">
            <span>our team</span>
            <h1>Quality & passion with our services</h1>
            <img src="image/separator-img.png">
        </div>

        <div class="box-container">
            <div class="box">
                <img src="image/team-1.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Glenald</h2>
                    <p>Brader Master</p>
                </div>
            </div>

        <div class="box">
                <img src="image/team-2.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Dudong</h2>
                    <p>Doggy Master</p>
                </div>
            </div>

        <div class="box">
                <img src="image/team-3.jpg" class="img">
                <div class="content">
                    <img src="image/shape-19.png" alt="" class="shap">
                    <h2>Euri</h2>
                    <p>Beauty Master</p>
                </div>
            </div>
        </div>

        <div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>our standards</h1>
                <img src="image/separator-img.png">
            </div>
            <p>pag mag heart ka may kiss ka sakin...😎</p>
            <i class="bx bxs-heart"></i>
            <p>pag mag heart ka may kiss ka sakin...😎</p>
            <i class="bx bxs-heart"></i>
            <p>pag mag heart ka may kiss ka sakin...😎</p>
            <i class="bx bxs-heart"></i>
            <p>pag mag heart ka may kiss ka sakin...😎</p>
            <i class="bx bxs-heart"></i>
            <p>pag mag heart ka may kiss ka sakin...😎</p>
            <i class="bx bxs-heart"></i>
        </div>
     </div>
    <!-- standers section -->
    <div class="testimonial">
        <div class="heading">
            <h1>testimonial</h1>
            <img src="image/separator-img.png">
        </div>
        <div class="testimonial-container">
            <div class="slide-row" id="slide">
                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business analyst, entrepreneur and media proprietor, and investor. He also known as the best selling book author.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (1).jpg">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business analyst, entrepreneur and media proprietor, and investor. He also known as the best selling book author.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (2).jpg">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business analyst, entrepreneur and media proprietor, and investor. He also known as the best selling book author.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
                    </div>
                    <div class="user-img">
                        <img src="image/testimonial (3).jpg">
                    </div>
                </div>

                <div class="slide-col">
                    <div class="user-text">
                        <p>Zen Doan is a business analyst, entrepreneur and media proprietor, and investor. He also known as the best selling book author.</p>
                        <h2>Zen</h2>
                        <p>Author</p>
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
<div class="mission">
    <div class="box-container">
        <div class="box">
            <div class="heading">
                <h1>Our Mission</h1>
                <img src="image/separator-img.png" alt="Separator">
            </div>
            
            <div class="detail">
                <div class="img-box">
                    <img src="image/mission.webp" alt="Mexsouce Pizza">
                </div>
                <div>
                    <h2>Mexsouce Pizza</h2>
                    <p>Lami ni akong sauce kay gikamot nako ni pag mix.</p>
                </div>
            </div>

            <div class="detail">
                <div class="img-box">
                    <img src="image/mission0.jpg" alt="Hot Pizza">
                </div>
                <div>
                    <h2>Hot Pizza</h2>
                    <p>Lami ni akong sauce kay gikamot nako ni pag mix.</p>
                </div>
            </div>

            <div class="detail">
                <div class="img-box">
                    <img src="image/mission1.webp" alt="Vegetable Pizza">
                </div>
                <div>
                    <h2>Vegetable Pizza</h2>
                    <p>Lami ni akong sauce kay gikamot nako ni pag mix.</p>
                </div>
            </div>

            <div class="detail">
                <div class="img-box">
                    <img src="image/mission2.webp" alt="Extra Hot Pizza">
                </div>
                <div>
                    <h2>Extra Hot Pizza</h2>
                    <p>Lami ni akong sauce kay gikamot nako ni pag mix.</p>
                </div>
            </div>
        </div>

            <div class="box">
                <img src="image/form.png" class="img" alt="Form Image">
            </div>
        </div>
    </div>
    </div>





<?php include 'components/footer.php'; ?>
<!-- sweetAlert cdn link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- custom js link -->
<script src="js/user_script.js"></script>

<?php include 'components/alert.php'; ?>
</body>
</html>