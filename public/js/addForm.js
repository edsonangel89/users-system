const addForm = document.getElementById('add-form');
const inputFname = document.getElementById('add-fname');
const inputLname = document.getElementById('add-lname');
const inputEmail = document.getElementById('add-email');
const inputPassword = document.getElementById('add-password');
const inputConfirmPassword = document.getElementById('add-confirm-password');
const inputRole = document.getElementById('add-role');

addForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();

    const fnameValue = inputFname.value;
    const lnameValue = inputLname.value;
    const emailValue = inputEmail.value;
    const passwordValue = inputPassword.value;
    const confirmPasswordValue = inputConfirmPassword.value;
    const roleValue = inputRole.value;

    formData.append('add-fname', fnameValue);
    formData.append('add-lname', lnameValue);
    formData.append('add-email', emailValue);
    formData.append('add-password', passwordValue);
    formData.append('add-confirm-password', confirmPasswordValue);
    formData.append('add-role', roleValue);

    const errorPattern = /Error/;
    fetch('http://localhost/users/utils/validate-add.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        inputFname.value = '';
        inputLname.value = '';
        inputEmail.value = '';
        inputPassword.value = '';
        inputConfirmPassword.value = '';
        //inputRole.value = '';

        if(errorPattern.test(data)) {
            const err = data.slice(6);
            alert(err);
        }
        else {
            window.location.href = '/users/index.php';
        }
    })
})