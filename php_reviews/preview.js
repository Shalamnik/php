let button = document.querySelector('#btn-preview');

button.onclick = function(event) {
  
  let preview = document.createElement('div');
  
  preview.className = 'review';
  preview.style.width = '100%';

  preview.innerHTML = '<p>Hello</p>';
  
  let form = document.querySelector('.container');
  form.insertAdjacentElement('beforeend', preview);
}