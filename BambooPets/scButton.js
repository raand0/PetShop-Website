
let scrollTopBtn = document.getElementById("Scroll");

window.onscroll = function() {
    if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
        scrollTopBtn.style.display = "block";
    } else {
        scrollTopBtn.style.display = "none";
    }
};

scrollTopBtn.onclick = function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}


document.addEventListener("DOMContentLoaded", function() {
    const postTitles = document.querySelectorAll(".post-title");

    postTitles.forEach(title => {
        title.addEventListener("click", function() {
            const content = this.nextElementSibling.nextElementSibling;
            content.style.display = content.style.display === "none" ? "block" : "none";
        });
    });
});

