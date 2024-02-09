const form = document.querySelector('.signup form');
const continue_btn = document.querySelector('.form form .btn input');
const error_text = document.querySelector('.form form .error_text');

form.onsubmit = (e) => {
    e.preventDefault(); //preventing form from submitting
}
continue_btn.onclick = () => {
    // lets start ajax
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/signup.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == 'success') {
                    location.href = 'users.php';
                } else {
                    error_text.textContent = data;
                    error_text.style.display = 'block';
                }

            }
        }
    }

    // we have to send the form data through ajax to php
    let formData = new FormData(form); //creating new formData Object
    // console.log(formData);
    xhr.send(formData); //sending the form data to php
}

