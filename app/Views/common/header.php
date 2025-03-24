<?php
    // Start the session if not already started (only if needed)
    if (! session_id()) {
        session_start();
    }

    // Retrieve user data from session
    $user = session()->get('user');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metadata Search</title>

    <!-- Bootstrap CSS for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery, Bootstrap JS, and DatePicker library -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery -->

    <!-- Date Range Picker CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <style>
    .custom-btn {
        background-color: #6c63ff;
        /* Primary background color */
        border: 2px solid #6c63ff;
        /* Border matching the background */
        color: white;
        /* White text */
        font-weight: bold;
        /* Bold text */
        padding: 10px;
        /* Adjust padding for size */
        border-radius: 8px;
        /* Smooth rounded corners */
        transition: background-color 0.3s ease, color 0.3s ease;
        /* Smooth transitions */
    }

    .custom-btn:hover {
        background-color: white;
        /* Invert background on hover */
        color: #6c63ff;
        /* Text color changes on hover */
        border-color: #6c63ff;
        /* Keep border color */
    }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#creatModal">Add New
                            User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">Profile</a>
                    </li>
                    <li class="nav-item">
                        <!-- Display user email dynamically -->
                        <?php if (isset($user['email'])): ?>
                        <span class="nav-link text-white">Logged in as:<?php echo esc($user['email']); ?></span>
                        <?php endif; ?>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('logout') ?>">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Modal -->
    <div class="modal fade" id="creatModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo base_url('/store_user') ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Profile Picture (200x200 pixels)</label>
                            <input type="file" name="profile_picture" class="form-control" accept="image/*"
                                onchange="validateImageSize(this)">
                        </div>
                        <button type="submit" class="btn btn-success">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal-> 2 -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (isset($user) && ! empty($user)): ?>
                    <form action="<?php echo base_url('/user/update/' . $user['id']) ?>" method="post"
                        enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="<?php echo esc($user['name'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-control"
                                value="<?php echo esc($user['email'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Profile Picture (200x200 pixels)</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control"
                                accept="image/*" onchange="validateImageSize(this)">
                        </div>

                        <div class="mb-3">
                            <img src="<?php echo base_url('../public/uploads/profile_images/' . $user['profile_img']) ?>"
                                alt="Profile Picture" width="100" class="rounded-circle">
                        </div>

                        <button type="submit" class="btn btn-success">Update User</button>
                    </form>
                    <?php else: ?>
                    <div class="alert alert-danger">User not found!</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>