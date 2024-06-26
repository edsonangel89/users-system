const updateAdminForm = document.getElementById('update-admin-form');
const updateAdminId = document.getElementById('admin-update-id');
const updateAdminFname = document.getElementById('admin-update-fname');
const updateAdminLname = document.getElementById('admin-update-lname');
const updateAdminEmail = document.getElementById('admin-update-email');
const updateAdminCheckbox = document.getElementById('admin-update-checkbox');
const updateAdminPassword = document.getElementById('admin-update-password');
const updateConfirmPassword = document.getElementById('admin-update-confirm-password');
const updateAdminRole = document.getElementById('admin-update-role');
const passwordAlerts = document.getElementsByClassName('contrasena-alert');

updateAdminForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();

    const idValue = updateAdminId.value;
    const fnameValue = updateAdminFname.value;
    const lnameValue = updateAdminLname.value;
    const emailValue = updateAdminEmail.value;
    const passwordValue = updateAdminPassword.value;
    const confirmPasswordValue = updateConfirmPassword.value;
    const roleValue = updateAdminRole.value;
    const errorPattern = /Error/;
    
    
    if(passwordValue.includes(' ') || confirmPasswordValue.includes(' ')) {
        alert('Las contrasenas no pueden contener espacios en blanco');
        updateAdminPassword.value = '';
        updateConfirmPassword.value = ''; 
        return;
    }
    
    formData.append('update-id', idValue);
    formData.append('update-fname', fnameValue);
    formData.append('update-lname', lnameValue);
    formData.append('update-email', emailValue);
    if(updateAdminCheckbox.checked == true) {
        formData.append('update-password', passwordValue);
        formData.append('update-confirm-password', confirmPasswordValue);
    }
    formData.append('update-role', roleValue);
    
    fetch('http://localhost/system/api/users/update', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        
        updateAdminFname.value = '';
        updateAdminLname.value = '';
        updateAdminEmail.value = '';
        updateAdminPassword.value = '';
        updateConfirmPassword.value = '';

        if(errorPattern.test(data)) {
            const err = data.slice(6);
            alert(err);
        }
        else {
            //console.log(data);
            window.location.href = '/system';
        }
    })
})

updateAdminCheckbox.addEventListener('change', function (e) {
    if(updateAdminCheckbox.checked == true) {
        updateAdminPassword.removeAttribute('disabled');
        updateConfirmPassword.removeAttribute('disabled');
    }
    else {
        updateAdminPassword.setAttribute('disabled', 'true');
        updateConfirmPassword.setAttribute('disabled', 'true');
    }
})

updateAdminPassword.addEventListener('input', function(e) {
    const passwordValue = updateAdminPassword.value;
    const confirmPasswordValue = updateConfirmPassword.value;
    if(passwordValue != confirmPasswordValue) {
        updateAdminPassword.style.border = 'solid red 1px';
        updateConfirmPassword.style.border = 'solid red 1px';
        passwordAlerts[0].style.display = 'inline-block';
        passwordAlerts[1].style.display = 'inline-block';
    }
    else {
        updateAdminPassword.style.border = 'none';
        updateConfirmPassword.style.border = 'none';
        passwordAlerts[0].style.display = 'none';
        passwordAlerts[1].style.display = 'none';
    }  
})

updateConfirmPassword.addEventListener('input', function(e) {
    const passwordValue = updateAdminPassword.value;
    const confirmPasswordValue = updateConfirmPassword.value;
    if(passwordValue != confirmPasswordValue) {
        updateAdminPassword.style.border = 'solid red 1px';
        updateConfirmPassword.style.border = 'solid red 1px';
        passwordAlerts[0].style.display = 'inline-block';
        passwordAlerts[1].style.display = 'inline-block';
    }
    else {
        updateAdminPassword.style.border = 'none';
        updateConfirmPassword.style.border = 'none';
        passwordAlerts[0].style.display = 'none';
        passwordAlerts[1].style.display = 'none';
    }  
})