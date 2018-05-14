 parameters = {
     form:document.getElementById('add_tricks'),
     container:document.getElementById('add_tricks_pictures'),
     property: document.querySelectorAll("[data-prototype]"),
 }
 let index = 0;

 function addPicture() {
     const template = parameters.container.dataset.prototype
     const el = template.replace(/__name__label__/g, 'image n°' + (index+1))
         .replace(/__name__/g, index)
     parameters.form.appendChild(createElementFromHTML(el))
     index+=1
 }

 function createElementFromHTML(htmlString) {
     let div = document.createElement('div');
     div.innerHTML = htmlString.trim();
     return div.firstChild;
 }

 if (index === 0){
     addPicture()
 }
