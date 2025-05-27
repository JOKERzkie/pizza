const userBtn = document.querySelector('#user-btn');
userBtn.addEventListener('click', function(){
    const userBox = document.querySelector('.profile-detail');
    userBox.classList.toggle('active');
})

document.addEventListener("DOMContentLoaded", function() {
    const toggle = document.querySelector('.toggle-btn');
    const sidebar = document.querySelector('.sidebar');

    toggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
});
