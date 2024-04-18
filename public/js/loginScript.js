const loginForm = document.getElementById('login-form');
const inputEmail = document.getElementById('login-email');
const inputPassword = document.getElementById('login-password');

loginForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();
    const emailValue = inputEmail.value;
    const passwordValue = inputPassword.value;
    const errorPattern = /Error/;

    formData.append('login-email', emailValue);
    formData.append('login-password', passwordValue);
    fetch('http://localhost/users/controllers/users-controller.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        inputEmail.value = '';
        inputPassword.value = '';
        if(errorPattern.test(data)) {
            const err = data.slice(6);
            alert(err);
        }
        else {
            console.log(data);
            window.location.href = '/users/index.php';
        }
    })
})