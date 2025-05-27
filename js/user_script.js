document.addEventListener("DOMContentLoaded", function () {
    let userBtn = document.querySelector("#user-btn");
    let profileDetail = document.querySelector(".profile-detail");
    let menuBtn = document.querySelector("#menu-btn");
    let navbar = document.querySelector(".navbar");

    if (userBtn && profileDetail) {
        userBtn.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevents immediate closure
            profileDetail.classList.toggle("active");

            // Close navbar if open
            if (navbar.classList.contains("show")) {
                navbar.classList.remove("show");
            }
        });

        // Close profile when clicking outside
        document.addEventListener("click", function (event) {
            if (!profileDetail.contains(event.target) && event.target !== userBtn) {
                profileDetail.classList.remove("active");
            }
        });
    } else {
        console.error("User button or profile detail not found!");
    }

    // Mobile Menu Toggle
    if (menuBtn && navbar) {
        menuBtn.addEventListener("click", function (event) {
            event.stopPropagation(); // Prevents closure when clicking the button
            navbar.classList.toggle("show");

            // Close profile dropdown if open
            if (profileDetail.classList.contains("active")) {
                profileDetail.classList.remove("active");
            }
        });

        // Close menu when clicking outside
        document.addEventListener("click", function (event) {
            if (!navbar.contains(event.target) && event.target !== menuBtn) {
                navbar.classList.remove("show");
            }
        });
    } else {
        console.error("Menu button or navbar not found!");
    }
});

// home slider
const imgBox = document.querySelector('.slider-container');
const slides = document.getElementsByClassName('sliderBox');
var i = 0;

function nextSlide(){
    slides[i].classList.remove('active');
    i = (i + 1) % slides.length;
    slides[i].classList.add('active');
}

function prevSlide(){
    slides[i].classList.remove('active');
    i = (i - 1 + slides.length) % slides.length;
    slides[i].classList.add('active');
}


// testimonial
// Testimonial Slider
const btns = document.getElementsByClassName('btn1'); // Corrected class selector
const slide = document.getElementById('slide'); // Corrected ID selector

if (btns.length > 0 && slide) {
    btns[0].onclick = function () {
        slide.style.transform = 'translateX(0px)';
        setActiveButton(0);
    };

    btns[1].onclick = function () {
        slide.style.transform = 'translateX(-800px)';
        setActiveButton(1);
    };

    btns[2].onclick = function () {
        slide.style.transform = 'translateX(-1600px)'; // Corrected position
        setActiveButton(2);
    };

    btns[3].onclick = function () {
        slide.style.transform = 'translateX(-2400px)'; // Corrected position
        setActiveButton(3);
    };

    function setActiveButton(index) {
        for (let i = 0; i < btns.length; i++) {
            btns[i].classList.remove('active');
        }
        btns[index].classList.add('active');
    }
} else {
    console.error("Testimonial buttons or slide element not found!");
}
