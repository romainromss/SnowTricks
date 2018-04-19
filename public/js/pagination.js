let parameters = {
    section: document.getElementById("Display"),
    button: document.getElementById("more"),
    selector: '.tricks'
};


function Pagination (params) {
    const that = this;
    // Constructor via IIFE
    (function () {
        that.section = params.section;
        that.button = params.button;
        that.child = that.section.querySelectorAll(params.selector);
    })()
}

Pagination.prototype.eventHandler = function () {

    this.button.addEventListener('click', e => {
        e.preventDefault();
        for (let i = 0; i < this.child.length; i++) {
            this.child[i].style.display = 'block'
        }
        this.button.style.display = 'none'
    })

};

Pagination.prototype.paginate = function () {

    for (let i = 0; i < this.child.length; i++) {
        if(i > 8) {
            this.child[i].style.display = 'none'
        }
    }

    this.eventHandler();
};

const typeHidden = document.getElementById('type');
if (typeHidden) {
    parameters.selector = typeHidden.value;

    if (typeHidden.dataset.mobile === '1') {

    }
}

let p = new Pagination(parameters);
p.paginate();


