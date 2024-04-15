const adminTable = document.getElementById('admin-table');
//console.log('test');
//alert('test');
//adminTable.addEventListener('load', function(e) {
    const errorPattern = /Error/;
    //console.log('test');
    fetch('http://localhost/users/utils/get-users.php')
    .then(response => response.json())
    .then(data => {
        if(errorPattern.test(data)) {
            const err = data.slice(6);
            alert(err);
        }
        else {
            data.forEach(user => {
                //console.log(user.Email);
                const userEmail = user.Email;
                const row = document.createElement('tr');
                row.innerHTML =  
                    `<td class='data-cell'>${user.FirstName}</td>
                    <td class='data-cell'>${user.LastName}</td>
                    <td class='data-cell'>${user.Email}</td>
                    <td class='data-cell'>${user.Role}</td>
                    <td class='data-cell user-btn'><a href='http://localhost/users/views/update-admin.php?email=${userEmail}' type='button'>Editar</a><a href='http://localhost/users/utils/delete-user.php?email=${userEmail}' type='button'>Borrar</a></td>
                    `;
                    adminTable.appendChild(row);
                }  
            )
        }
    }
)
//})