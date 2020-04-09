//get image from form
function getFormImage(form) {

    let img = document.createElement('img');
    let file = form.elements.userImg.files[0];

    let reader = new FileReader();

    reader.onloadend = () => {
        img.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        img.src = 'images/default.png';
    }

    return img;
}

function getDate() {

    let date = new Date();

    let month = date.getMonth();
    let day = date.getDate()
    let hours = date.getHours();
    let mins = date.getMinutes();
    let secs = date.getSeconds();

    if (month < 10) month = '0' + month;
    if (day < 10) day = '0' + day;
    if (hours < 10) hours = '0' + hours;
    if (mins < 10) mins = '0' + mins;
    if (secs < 10) secs = '0' + secs;

    let time = `${date.getFullYear()}-${month}-${day} ` +
        `${hours}:${mins}:${secs}`;

    return time;
}

function getFormData(form) {

    let formData = document.createElement('p');

    let userName = document.createElement('span');
    userName.innerHTML = 'Name: ' + form.elements.name.value;

    let userEmail = document.createElement('span');
    userEmail.innerHTML = 'Email: ' + form.elements.email.value;

    let userDate = document.createElement('span');
    userDate.id = 'date';
    userDate.innerHTML = 'Date: ' + getDate();

    let userText = document.createElement('p');
    userText.id = 'text';
    userText.innerHTML = "<b>Review:</b><br><br>" + form.elements.review.value;

    formData.append(userName, userEmail, userDate, userText);

    return formData;
}

let preview;
let btnPreview = document.querySelector('#btn-preview');

btnPreview.onclick = () => {

    if (preview) {
        preview.hidden = true;
        preview = '';
    } else {

        preview = document.createElement('div');

        preview.className = 'review';
        preview.style.width = '100%';

        let form = document.forms[0];

        preview.append(getFormImage(form), getFormData(form));

        let container = document.querySelector('.container');
        container.insertAdjacentElement('beforeend', preview);
    }

}