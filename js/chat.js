const form = document.querySelector('.typing_area');
const send_btn = document.querySelector("button");
const input_field = document.querySelector('.input_field');
const chat_box = document.querySelector('.chat_box');

console.log('from chat js file');
form.onsubmit = (e) => {
    e.preventDefault(); //preventing form from submitting
}

send_btn.onclick = () => {
    // lets start ajax
    console.log('from chat js file2');

    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/insert_chat.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data == 'success to save messages') {
                    input_field.value = " ";
                    console.log(data);
                } else {

                    console.log("error to send data to insert chat file");
                }
                console.log(data);

            }
        }
    }

    // we have to send the form data through ajax to php
    let formData = new FormData(form); //creating new formData Object
    // console.log(formData);
    xhr.send(formData); //sending the form data to php
}

setInterval(() => {
    // lets start ajax
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/get_chat.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chat_box.innerHTML = data;
                if (!chat_box.classList.contains('active')) {
                    chat_box.scrollTop = chat_box.scrollHeight;
                }
                console.log("data  : " + data);
            }
        }
    }
    // we have to send the form data through ajax to php
    let formData = new FormData(form); //creating new formData Object
    // console.log(formData);
    xhr.send(formData); //sending the form data to php
}, 500); //this function will run frequently after 500ms

chat_box.onmouseenter = () => {
    chat_box.classList.add('active');
}

chat_box.onmouseleave = () => {
    chat_box.classList.remove('active');
}
