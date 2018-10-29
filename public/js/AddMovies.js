parametersMovies = {
    container:document.querySelector('div#add_trick_movies'),
    property: document.querySelectorAll("[data-prototype]"),
}

parametersMoviesUpdate = {
    container:document.querySelector('div#update_trick_movies'),
    property: document.querySelectorAll("[data-prototype]"),
}



if (document.querySelector('div#add_trick_pictures')) {
    let indexMovies = 0;

    function addMoviesAdd() {
        const template = parametersMovies.container.dataset.prototype
        const el = template.replace(/__name__label__/g, 'image n°' + (indexMovies + 1))
            .replace(/__name__/g, indexMovies)
        parametersMovies.container.appendChild(createElementFromHTML(el))
        indexMovies += 1
    }


    function createElementFromHTML(htmlString) {
        let div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    if (indexMovies === 0) {
        addMoviesAdd()
    }

    let buttonMovies = document.querySelector('#add_movies');

    buttonMovies.addEventListener('click', function () {
        addMoviesAdd()
    });
}

if (document.querySelector('div#update_trick_pictures')) {
    let indexMovies = 0;

    function addMoviesUpdate() {
        const template = parametersMoviesUpdate.container.dataset.prototype
        const el = template.replace(/__name__label__/g, 'image n°' + (indexMovies + 1))
            .replace(/__name__/g, indexMovies + 2)
        parametersMoviesUpdate.container.appendChild(createElementFromHTMLUpdate(el))
        indexMovies += 1
    }


    function createElementFromHTMLUpdate(htmlString) {
        let div = document.createElement('div');
        div.innerHTML = htmlString.trim();
        return div.firstChild;
    }

    if (indexMovies === 0) {
        addMoviesUpdate()
    }

    let buttonMovies = document.querySelector('#update_movies');

    buttonMovies.addEventListener('click', function () {
        addMoviesUpdate()
    });
}