let md = new MobileDetect(window.navigator.userAgent);
let parameters = {
    section: document.getElementById("Display"),
    button: document.getElementById("more"),
};

function SeeMore (parameters) {
    const that = this;
    // Constructor via IIFE
    (function () {
        that.section = parameters.section;
        that.button = parameters.button;
        that.child = that.section.querySelectorAll('.medias');
    })()
}

let p = new SeeMore(parameters);

if (md.mobile()) {
    p.section.style.display = 'none';
    p.button.addEventListener('click', e => {
        e.preventDefault();
        p.section.style.display = 'block';
        p.button.style.display = 'none';
    })
} else {
    p.button.style.display = 'none';
}
