const backToTop = document.getElementById("BackToTop");

const topFunction = () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
};

const scrollFunction = () => {
    if (backToTop) {
        backToTop.style.display = window.scrollY > 150 ? "block" : "none";
    }
};

window.addEventListener('scroll', scrollFunction);

scrollFunction();