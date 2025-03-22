<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2>User Profile</h2>

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
                <input type="file" id="profile_picture" name="profile_picture" class="form-control" accept="image/*"
                    onchange="validateImageSize(this)">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function validateImageSize(input) {
        const file = input.files[0]; // Get the uploaded file

        if (file) {
            const img = new Image();
            img.src = URL.createObjectURL(file); // Create a temporary object URL for the file

            img.onload = function() {
                console.log("Width: ", img.width, "Height: ", img.height); // Debugging output

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