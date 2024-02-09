const search_bar = document.querySelector('.users .search input');
const search_btn = document.querySelector('.users .search button');
let usersList = document.querySelector('.users .users_list');

search_btn.onclick = () => {
    search_bar.classList.toggle("active");
    search_bar.focus();
    search_btn.classList.toggle('active');
    search_bar.value = " ";

}

// console.log('hello from js file');
var currentPath = window.location.pathname;
// console.log("المسار الحالي: " + currentPath);

search_bar.onkeyup = () => {
    let searchTerm = search_bar.value;
    if (search_bar != "") {
        search_bar.classList.add("active");
    } else {
        search_bar.classList.remove("active");
    }
    // lets start ajax
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/search.php', true);
    xhr.onload = () => {

        if (xhr.readyState === XMLHttpRequest.DONE) {

            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("searchTerm=" + searchTerm);
}

setInterval(() => {
    // lets start ajax
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/users2.php', true);
    xhr.onload = () => {

        if (xhr.readyState === XMLHttpRequest.DONE) {

            if (xhr.status === 200) {
                let data = xhr.response;
                if (!search_bar.classList.contains('active')) {
                    usersList.innerHTML = data;
                }
            }
        }
    }
    xhr.send();
}, 500); //this function will run frequently after 500ms
