<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - SAW</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2@4.1.3/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #20c997; /* Bootstrap's teal color */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .input-group-text {
            background-color: #20c997;
            color: #fff;
        }

        .btn-login {
            background-color: #20c997;
            color: white;
        }

        .btn-login:hover {
            background-color: #17a589;
        }

        a {
            color: #20c997;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h4 class="text-center mb-4">Login Form</h4>
    <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert alert-danger text-center">
            <?= $_SESSION['login_error']; ?>
        </div>
        <?php unset($_SESSION['login_error']); ?>
    <?php endif; ?>
    <form action="/spk-saw-supplier/auth/login" method="POST">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
        </div>

        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
        </div>

        <div class="mb-2 text-right">
            <a href="#">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-login btn-block">Login</button>

        <div class="mt-3 text-center">
            Not a member? <a href="/spk-saw-supplier/auth/register">Signup now</a>
        </div>
    </form>
</div>

<!-- Font Awesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
