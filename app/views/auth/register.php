<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - SAW</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/StartBootstrap/startbootstrap-sb-admin-2@4.1.3/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.2/main.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #20c997;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            width: 100%;
            max-width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-register {
            background-color: #20c997;
            color: white;
        }

        .btn-register:hover {
            background-color: #17a589;
        }

        a {
            color: #20c997;
        }
    </style>
</head>
<body>

<div class="register-card">
    <h4 class="text-center mb-4">Register Form</h4>
    <form action="/spk-saw-supplier/auth/register" method="POST">
        <div class="form-group">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-register btn-block">Register</button>

        <div class="mt-3 text-center">
            Already a member? <a href="/login">Login now</a>
        </div>
    </form>
</div>

</body>
</html>
