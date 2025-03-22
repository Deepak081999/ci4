<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>Add New User</h2>
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

    <script>
    function validateImageSize(input) {
        const file = input.files[0];
        if (file) {
            const img = new Image();
            img.src = URL.createObjectURL(file);

            img.onload = function() {
                // Validate the width and height to be exactly 200x200 pixels
                if (img.width > 200 && img.height > 200) {
                    alert("Image must be exactly 200x200 pixels.");
                    input.value = ''; // Clear the input if validation fails
                }
            };
        }
    }
    </script>

</body>

</html>