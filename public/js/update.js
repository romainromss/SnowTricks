let addBtn = document.querySelector('#update_pictures');
let index = document.querySelector('#update_pictures_index').getAttribute('data-index');

addBtn.addEventListener('click', function (event) {
    event.preventDefault();

    let prototype = document.querySelector('#update_trick_pictures').getAttribute('data-prototype');
    let newForm = prototype.replace(/__name__/g, index);

    document.querySelector('#update_trick_pictures').setAttribute('data-index', index);
    addBtn.insertAdjacentHTML('beforebegin', newForm);

    index++;
});


let btn = document.querySelector('#update_movies');
let index_update = document.querySelector('#update_movies_index').getAttribute('data-index');
btn.addEventListener('click', function (event) {
    event.preventDefault();

    let prototype = document.querySelector('#update_trick_movies').getAttribute('data-prototype');
    let newForm = prototype.replace(/__name__/g, index_update);

    document.querySelector('#update_trick_movies').setAttribute('data-index', index_update);
    btn.insertAdjacentHTML('beforebegin', newForm);

    index_update++;
});