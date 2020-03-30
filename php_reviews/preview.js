let button = document.querySelector('#btn-preview');
let form = document.forms[0];

let img = document.createElement('img');

function readFile(form) {

  let file = form.userImg.files[0];

  let reader = new FileReader();

  reader.readAsDataURL(file);

  reader.onload = () => {
    img.src = reader.result;
  }

  reader.onerror = () => {
    img.src = 'images/default.png';
  }
}

button.onclick = function(event) {
  
  let preview = document.createElement('div');
  
  preview.className = 'review';
  preview.style.width = '100%';

  readFile(form);

  preview.append = img;
  
  let form = document.querySelector('.container');
  form.insertAdjacentElement('beforeend', preview);
}