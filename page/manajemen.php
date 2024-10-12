<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/dataTables.dataTables.min.css">
</head>

<body class="bg-gray-50 min-h-screen">
    <nav class="bg-indigo-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Text "User Management System" di kiri -->
                <div class="flex items-center">
                    <span class="text-white text-xl font-semibold">User Management System</span>
                </div>
                <div class="ml-auto">
                    <form action="../config/logout.php" method="POST">
                        <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out">
                            Log Out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>



    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Account Management</h1>
            <div class="mb-4 flex justify-between items-center">
                <button id="addUserBtn"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-150 ease-in-out flex items-center">
                    <i class="fas fa-user-plus mr-2"></i> Add New User
                </button>
            </div>
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <table id="example" class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Password</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <!-- Add/Edit User Modal -->
    <div id="userModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h2 id="modalTitle" class="text-lg leading-6 font-medium text-gray-900 mb-4">Add | Edit User</h2>
                    <form id="userForm">
                        <input type="hidden" id="userId">
                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email:</label>
                            <input type="email" id="email" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password:</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <input type="password" id="password" required
                                    class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                    <button type="button" class="toggle-password focus:outline-none">
                                        <i class="fas fa-eye text-gray-400"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" id="name" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div class="mt-5 sm:mt-6 flex justify-end">
                            <button type="button" onclick="closeModal()"
                                class="mr-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                                Cancel
                            </button>
                            <button type="submit"
                                class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../assets/js/jquery-3.7.1.js"></script>
    <script type="text/javascript" src="../assets/js/notify.js"></script>
    <script type="text/javascript" src="../assets/js/dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "processing": true,
                "responsive": true,
                "serverSide": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "../config/server.php",
                    "type": "POST",
                },
                "deferRender": true,
                "aLengthMenu": [
                    [5, 10, 25, 50],
                    [5, 10, 25, 50]
                ],
                "columns": [{
                    "data": "id_user"
                },
                {
                    "data": "Email"
                },
                {
                    "data": "Password"
                },
                {
                    "data": "Name"
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<div class="flex space-x-2">' +
                            '<button onclick="editUser(' + row.id_user +
                            ')" class="text-indigo-600 hover:text-indigo-900"><i class="fas fa-edit"></i></button>' +
                            '<button onclick="deleteUser(' + row.id_user +
                            ')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>' +
                            '</div>';
                    }
                }
                ],
                "drawCallback": function (settings) {
                    $('tbody tr').addClass('hover:bg-gray-50');
                }
            });

            $('#tableSearch').on('keyup', function () {
                table.search(this.value).draw();
            });

            $('#addUserBtn').click(function () {
                openModal('Add New User');
            });

            $('#userForm').submit(function (e) {
                e.preventDefault();
                var userId = $('#userId').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var name = $('#name').val();

                $.ajax({
                    url: '../config/crud_operations.php',
                    type: 'POST',
                    data: {
                        action: userId ? 'update' : 'create',
                        id: userId,
                        email: email,
                        password: password,
                        name: name
                    },
                    success: function (response) {
                        if (response.success) {
                            $.notify(response.message, {
                                className: "success",
                                position: "top center"
                            });
                            table.ajax.reload();
                            closeModal();
                        } else {
                            $.notify(response.message, {
                                className: "error",
                                position: "top center"
                            });
                        }
                    },
                    error: function () {
                        $.notify("An error occurred", {
                            className: "error",
                            position: "top center"
                        });
                    }
                });
            });

            $(window).click(function (event) {
                if (event.target == $('#userModal')[0]) {
                    closeModal();
                }
            });

            $('.toggle-password').click(function () {
                var passwordInput = $('#password');
                var passwordFieldType = passwordInput.attr('type');
                var icon = $(this).find('i');

                if (passwordFieldType === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('fa-eye-slash').addClass('fa-eye');
                }
            });
        });

        function openModal(title, userData = null) {
            $('#modalTitle').text(title);
            $('#userId').val(userData ? userData.id_user : '');
            $('#email').val(userData ? userData.Email : '');
            $('#password').val(userData ? userData.Password : '');
            $('#name').val(userData ? userData.Name : '');
            $('#userModal').removeClass('hidden');
        }

        function closeModal() {
            $('#userModal').addClass('hidden');
            $('#userForm')[0].reset();
            $('#password').attr('type', 'password');
            $('.toggle-password i').removeClass('fa-eye-slash').addClass('fa-eye');
        }

        function editUser(id) {
            $.ajax({
                url: '../config/crud_operations.php',
                type: 'GET',
                data: {
                    action: 'read',
                    id: id
                },
                success: function (response) {
                    if (response.success) {
                        openModal('Edit User', response.data);
                    } else {
                        $.notify(response.message, {
                            className: "error",
                            position: "top center"
                        });
                    }
                },
                error: function () {
                    $.notify("An error occurred", {
                        className: "error",
                        position: "top center"
                    });
                }
            });
        }

        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '../config/crud_operations.php',
                    type: 'POST',
                    data: {
                        action: 'delete',
                        id: id
                    },
                    success: function (response) {
                        if (response.success) {
                            $.notify(response.message, {
                                className: "success",
                                position: "top center"
                            });
                            $('#example').DataTable().ajax.reload();
                        } else {
                            $.notify(response.message, {
                                className: "error",
                                position: "top center"
                            });
                        }
                    },
                    error: function () {
                        $.notify("An error occurred", {
                            className: "error",
                            position: "top center"
                        });
                    }
                });
            }
        }
    </script>
</body>

</html>