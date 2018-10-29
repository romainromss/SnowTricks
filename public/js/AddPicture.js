 parametersPicturesAdd = {
     container:document.querySelector('div#add_trick_pictures'),
     property: document.querySelectorAll("[data-prototype]"),
 }

 parametersPicturesUpdate = {
     container:document.querySelector('div#update_trick_pictures'),
     property: document.querySelectorAll("[data-prototype]"),
 }

if (document.querySelector('div#add_trick_pictures')) {
    let index = 0;

    function addPictureAdd() {
        const template = parametersPicturesAdd.container.dataset.prototype
        const el = template.replace(/__name__label__/g, 'image n°' + (index + 1))
            .replace(/__name__/g, index)
        parametersPicturesAdd.container.appendChild(createElementFromHTML(el))
        index += 1
    }

    function createElementFromHTML(htmlString) {
        let div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    if (index === 0) {
        addPictureAdd()
    }

    let button = document.querySelector('#add_pictures');

    button.addEventListener('click', function () {
        addPictureAdd()
    });
}




if (document.querySelector('div#update_trick_pictures')){
    let index = 0;

    function addPictureUpdate() {
        const template = parametersPicturesUpdate.container.dataset.prototype
        const el = template.replace(/__name__label__/g, 'pictures n°' + (index + 1 ))
            .replace(/__name__/g, index + 1)
        parametersPicturesUpdate.container.appendChild(createElementFromHTMLUpdate(el))
        index += 1
    }

    function createElementFromHTMLUpdate(htmlString) {
        let div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    if (index === 1) {
        addPictureUpdate()
    }

    let button = document.querySelector('#update_pictures');

    button.addEventListener('click', function () {
        addPictureUpdate()
    });
}
