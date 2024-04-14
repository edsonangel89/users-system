const updateAdminForm = document.getElementById('update-admin-form');
const updateAdminFname = document.getElementById('admin-update-fname');
const updateAdminLname = document.getElementById('admin-update-lname');
const updateAdminEmail = document.getElementById('admin-update-email');
const updateAdminPassword = document.getElementById('admin-update-password');
const updateConfirmPassword = document.getElementById('admin-update-confirm-password');
const updateAdminRole = document.getElementById('admin-update-role');

updateAdminForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData();

    const fnameValue = updateAdminFname.value;
    const lnameValue = updateAdminLname.value;
    const emailValue = updateAdminEmail.value;
    const passwordValue = updateAdminPassword.value;
    const confirmPasswordValue = updateConfirmPassword.value;
    const roleValue = updateAdminRole.value;


    formData.append('admin-update-fname', fnameValue);
    formData.append('admin-update-lname', lnameValue);
    formData.append('admin-update-email', emailValue);
    formData.append('admin-update-password', passwordValue);
    formData.append('admin-update-confirm-password', confirmPasswordValue);
    formData.append('admin-update-role', roleValue);

    const errorPattern = /Error/;
    
    fetch('http://localhost/users/utils/validate-form.php', {
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
        //updateAdminRole.value = '';

        if(errorPattern.test(data)) {
            const err = data.slice(6);
            alert(err);
        }
        else {
            window.location.href = '/users/views/admin-table.php';
        }
    })
})