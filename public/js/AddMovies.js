parameters = {
    form:document.getElementById('add_tricks'),
    container:document.getElementById('add_tricks_movies'),
    property: document.querySelectorAll("[data-prototype]"),
}

let movie = 0;

function addMovie() {
    const template = parameters.container.dataset.prototype
    const el = template.replace(/__name__label__/g, 'video n°' + (movie+1))
        .replace(/__name__/g, index)
    parameters.form.appendChild(createElementFromHTML(el))
    movie+=1
}

function createElementFromHTML(htmlString) {
    let div = document.createElement('div');
    div.innerHTML = htmlString.trim();
    return div.firstChild;
}

if (movie === 0){
    addMovie()
}
