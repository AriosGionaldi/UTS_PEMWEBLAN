<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="../assets/css/styles.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container">
        <div class="login__content">
            <img src="../assets/img/bg-login.jpg" alt="login image" class="login__img">

            <form id="register-form" method="post" action="../config/lakukan-regis.php" class="login__form">
                <div id="register-message" style="display: none;"></div> <!-- Pesan registrasi -->

                <div>
                    <h1 class="login__title">
                        <span>Hallo</span> Friends
                    </h1>
                    <p class="login__description">
                        Welcome! Please Register to continue.
                    </p>
                </div>

                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="input-name" class="login__label">Fullname</label>
                            <input type="text" placeholder="Enter your Full Name" required class="login__input"
                                id="input-name" name="nama">
                        </div>

                        <div>
                            <label for="input-email" class="login__label">Email</label>
                            <input type="email" placeholder="Enter your email address" required class="login__input"
                                id="input-email" name="email">
                        </div>

                        <div>
                            <label for="input-pass" class="login__label">Password</label>
                            <div class="login__box">
                                <input type="password" placeholder="Enter your password" required class="login__input"
                                    id="input-pass" name="pass">
                                <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="login__check">
                        <input type="checkbox" class="login__check-input" id="input-check">
                        <label for="input-check" class="login__check-label">Remember me</label>
                    </div>
                </div>

                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button login__button-ghost">Sign Up</button>
                    </div>

                    <a href="../page/login.php">Already have an account? Back to login</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#register-form').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                // AJAX request untuk mengirimkan form data
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // URL dari form
                    data: $(this).serialize(), // Serialize form data
                    dataType: 'json',
                    success: function (response) {
                        // Cek apakah respons berhasil
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(function () {
                                // Redirect ke halaman login setelah sukses
                                window.location.href = 'login.php';
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        // Tampilkan pesan error yang lebih detail
                        Swal.fire({
                            title: 'An error occurred.',
                            text: 'Please try again later. Error: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>

    <!--=============== MAIN JS ===============-->
    <script src="../assets/js/main.js"></script>
</body>

</html>