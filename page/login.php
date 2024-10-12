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

            <form name="loginform" method="post" action="../config/login-cek.php" class="login__form">
                <div>
                    <h1 class="login__title">
                        <span>Welcome</span> Back
                    </h1>
                    <p class="login__description">
                        Welcome! Please login to continue.
                    </p>
                </div>

                <div>
                    <div class="login__inputs">
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
                        <button type="submit" id="login__button" class="login__button">Log In</button>
                    </div>

                    <a href="../page/register.php" class="login__forgot">Don't have an account? Register now</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function() {
        $("#login__button").click(function(event) {
            // Prevent form submit jika tombol berada di dalam form
            event.preventDefault();

            $.ajax({
                url: "../config/login-cek.php",
                method: "POST",
                data: {
                    Email: $("#input-email").val(),
                    Password: $("#input-pass").val()
                },
                success: function(response) {
                    if (response === "Login berhasil!") {
                        Swal.fire({
                            title: response,
                            icon: "success"
                        }).then(function() {
                            window.location.href =
                                "manajemen.php"; // Perbaikan di sini
                        });
                    } else {
                        Swal.fire({
                            title: response,
                            icon: "error"
                        }).then(function() {
                            window.location.href =
                                "login.php"; // Mengarahkan ulang ke login jika gagal
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Menangani error dari sisi server atau jaringan
                    Swal.fire({
                        title: "Terjadi kesalahan!",
                        text: xhr.responseText,
                        icon: "error"
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