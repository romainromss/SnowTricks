// parameters.section.offsetTop
// window.pageYOffset

const arrowUp = document.getElementById('arrowUp');
const arrowDown = document.getElementById('arrowDown');
const headerBarHeight = 66;
const margin = 23;

function getContentTop() {
    return parameters.section.offsetTop - headerBarHeight - margin
}

//
function onWindowUpdate() {
    if (window.pageYOffset >= getContentTop()) {
        arrowUp.style.display = 'block';
    } else {
        arrowUp.style.display = 'none';
    }
}

arrowUp.addEventListener('click', function () {
    window.scroll(0, 0);
});

arrowDown.addEventListener('click', function () {
    window.scroll(0, getContentTop());
});

window.addEventListener('scroll', onWindowUpdate);
window.addEventListener('resize', onWindowUpdate);

onWindowUpdate();
