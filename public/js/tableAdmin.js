const adminTable = document.getElementById('admin-table');

adminTable.addEventListener('load', function(e) {
    const errorPattern = /Error/;
    console.log('test');
    fetch('http://localhost/users/utils/get-users.php')
    .then(response => response.json())
    .then(data => {
        if(errorPattern.test(data)) {
            const err = data.slice(6);
            alert(err);
        }
        else {
            data.forEach(user => {
                console.log(user.Email);
                const userId = user.UserID;
                const row = document.createElement('tr');
                row.innerHTML =  
                    `<td>${user.FirstName}</td>
                    <td>${user.LastName}</td>
                    <td>${user.Email}</td>
                    <td>${user.Role}</td>
                    <td><a href='#' type='button'>Editar</a></td>
                    <td><a href='http://localhost/users/utils/delete-user.php?email=${userId}' type='button'>Borrar</a></td>
                    `;
                    adminTable.appendChild(row);
                }  
            )
        }
    }
)})