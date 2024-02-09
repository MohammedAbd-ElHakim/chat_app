const pswrdField = document.querySelector(".form form .field .password");
const toggleBtn = document.querySelector(".form form .field i");

toggleBtn.onclick = () => {
    if (pswrdField.type == "password") {
        pswrdField.type = "text";
        toggleBtn.classList.add('active');
    } else {
        pswrdField.type = "password";
        toggleBtn.classList.remove('active');
    }
}

