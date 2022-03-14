const fetchUsersButton = document.querySelector("#fetchUsersButton");
const apiSelect = document.querySelector("#apiSelect");

let result = document.querySelector("#result");
let value = "";

apiSelect.addEventListener('change', (e) => {
    result.innerHTML = "Now, press the Fetch users button for listing users";
    value = e.target.value;
});

fetchUsersButton.addEventListener("click", async () => {
    if (!value) {
        alert("Please select an api");
        return false;
    }
   let url = "";
    if (value == "regres") {
        const randomPage = Math.floor((Math.random() * 2) + 1);
        url =`https://reqres.in/api/users?page=${randomPage}`;
    } else {
        url = "https://jsonplaceholder.typicode.com/users";
    }

    const response = await fetch(url);
    const data = await response.json();
    const users = value == "regres" ? data.data : data;
    createUsersTable(users, value);
});

function createUsersTable(users, value) {
    let table = document.createElement('table');
    table.className = "table table-custom";
    let thead = document.createElement('thead');
    let theadCell1 =  document.createElement('td');
    let theadCell2 =  document.createElement('td');
    let tbody = document.createElement('tbody');
    thead.appendChild(theadCell1);
    thead.appendChild(theadCell2);
    table.appendChild(thead);
    table.appendChild(tbody);
    theadCell1.innerHTML ="Name";
    theadCell2.innerHTML ="Process";
    if(users) {
        users.forEach(user => {
            const userName = value == "regres" ? user.first_name : user.name;
            if (localUsers.includes(userName)) return false;
            var row = table.insertRow(0);
            var cell1 = row.insertCell(0);
            row.id = `row_${(userName).replace(/ /g,'')}`;
            cell1.className ="name"
            var cell2 = row.insertCell(1);
            cell1.innerHTML = userName;

            let button = document.createElement('button');
            button.className = "btn btn-outline-success saveButton";
            button.innerHTML = "SAVE"
            cell2.appendChild(button);

            button.addEventListener("click", async () => {
                button.disabled = true;
                saveUser(userName);
                button.disabled = false;
            });
        });

        const tableNode = document.querySelector('table');

        if(!result.contains(tableNode)) {
            result.innerHTML = "";
            result.append(table);
        }
    }
}

async function saveUser(name) {
    const result = await axios.post(saveUserRoute,{
        name
    });
    Swal.fire(
        'Good job!',
        'User has been saved successfully!',
        'success'
    );

    const row = document.querySelector(`#row_${name.replace(/ /g,'')}`);
    row.remove();
 }