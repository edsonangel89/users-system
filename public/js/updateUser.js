const updateUserForm = document.getElementById('update-user-form');
const inputId = document.getElementById('user-update-id');
const inputFname = document.getElementById('user-update-fname');
const inputLname = document.getElementById('user-update-lname');
const inputEmail = document.getElementById('user-update-email');

updateUserForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();

    const idValue = inputId.value;
    const fnameValue = inputFname.value;
    const lnameValue = inputLname.value;
    const emailValue = inputEmail.value;

    formData.append('update-id', idValue);
    formData.append('update-fname', fnameValue);
    formData.append('update-lname', lnameValue);
    formData.append('update-email', emailValue);

    const errorPattern = /Error/;
    
    fetch('http://localhost/system/api/users/update', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        inputFname.value = '';
        inputLname.value = '';
        inputEmail.value = '';

        if(errorPattern.test(data)) {
            const err = data.slice(6);
            alert(err);
        }
        else {
            window.location.href = '/system';
        }
    })
})