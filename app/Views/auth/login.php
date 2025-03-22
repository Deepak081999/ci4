<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
    body {
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
    }

    .card {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        width: 100%;
    }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h3 class="text-center mb-4">Login</h3>

            <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <p><?php echo esc(session()->getFlashdata('error')) ?></p>
            </div>
            <?php endif; ?>

            <form action="<?php echo site_url('login/check') ?>" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Login</button>
            </form>

            <p class="mt-3 text-center">
                Don't have an account? <a href="<?php echo site_url('register') ?>">Register</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (Optional, for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>