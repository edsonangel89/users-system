const userTable = document.getElementById('user-table');
const errorPattern = /Error/;
    fetch('http://localhost/system/api/users')
    .then(response => response.json())
    .then(data => {
        if(errorPattern.test(data)) {
            const err = data.slice(6);
            alert(err);
        }
        else {
            data.forEach(user => {
                const userId = user.UserID;
                const row = document.createElement('tr');
                if(userId == '1') {
                    row.innerHTML =  
                    `<td class='data-cell'>${user.UserID}</td>
                    <td class='data-cell'>${user.FirstName}</td>
                    <td class='data-cell'>${user.LastName}</td>
                    <td class='data-cell'>${user.Email}</td>
                    <td class='data-cell'>${user.Role}</td>
                    <td class='data-cell user-btn'></td>
                    `;
                    userTable.appendChild(row);
                }
                else {
                    row.innerHTML =  
                    `<td class='data-cell'>${user.UserID}</td>
                    <td class='data-cell'>${user.FirstName}</td>
                    <td class='data-cell'>${user.LastName}</td>
                    <td class='data-cell'>${user.Email}</td>
                    <td class='data-cell'>${user.Role}</td>
                    <td class='data-cell user-btn'><a href='http://localhost/system/update?get-user=${userId}' type='button'>Editar</a></td>
                    `;
                    userTable.appendChild(row);
                }
                }  
            )
        }
    }
)