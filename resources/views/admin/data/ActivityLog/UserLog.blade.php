<section id="usersTableSection">
    <h1 class="my-4">Users List</h1>

    <div class="row mb-3">
        <form class="d-flex" role="search" onsubmit="return false;">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchInput" oninput="searchUsers()">
            <button class="btn btn-outline-success" type="button" onclick="searchUsers()">Search</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Email Verified At</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody id="userTableBody">
                @foreach ($users as $user)
                <tr onclick='showUserInfo({{ $user->id }})' style="cursor: pointer;">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->fname }}</td>
                    <td>{{ $user->lname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->email_verified_at ?? 'Not verified' }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>{{ $user->updated_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>


<script>
function searchUsers() {
    const searchInput = document.getElementById('searchInput').value.toLowerCase();
    const tableBody = document.getElementById('userTableBody');
    const rows = tableBody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let found = false;

        if (cells[1] && cells[2] && cells[3] && cells[4]) {
            const name = cells[1].textContent.toLowerCase();
            const fname = cells[2].textContent.toLowerCase();
            const lname = cells[3].textContent.toLowerCase();
            const email = cells[4].textContent.toLowerCase();

            if (name.includes(searchInput) || fname.includes(searchInput) || lname.includes(searchInput) || email.includes(searchInput)) {
                found = true;
            }
        }

        rows[i].style.display = found ? '' : 'none';
    }
}

function showUserInfo(userId) {
    const modalBody = document.getElementById('userInfoModalBody');
    const modal = new bootstrap.Modal(document.getElementById('userInfoModal'));

    // Fetch user information from the server
    fetch(`/users/${userId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            // Insert the modal content
            modalBody.innerHTML = data;
            modal.show(); // Show the modal
        })
        .catch(error => {
            console.error('Error fetching user info:', error);
            modalBody.innerHTML = '<p>Error fetching user information.</p>';
            modal.show(); // Show the modal with error message
        });
}

function fetchUsers() {
    fetch('{{ route("admin.fetch.users") }}')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            const tableBody = document.querySelector('#userTableBody');
            tableBody.innerHTML = '';  // Clear previous rows

            data.forEach(user => {
                const row = tableBody.insertRow();
                row.setAttribute('onclick', `showUserInfo(${user.id})`);
                row.style.cursor = 'pointer';

                row.insertCell(0).textContent = user.id;
                row.insertCell(1).textContent = user.name;
                row.insertCell(2).textContent = user.fname;
                row.insertCell(3).textContent = user.lname;
                row.insertCell(4).textContent = user.email;
                row.insertCell(5).textContent = user.email_verified_at || 'Not verified';
                row.insertCell(6).textContent = user.created_at;
                row.insertCell(7).textContent = user.updated_at;
            });
        })
        .catch(error => console.error('Error fetching users:', error));
}

// Fetch users at an interval for real-time updates
setInterval(fetchUsers, 5000);  // Fetch every 5 seconds
fetchUsers(); // Initial fetch

</script>
