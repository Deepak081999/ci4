# Project Name: CodeIgniter 4 Application

## Project Overview
This is a web-based application built using CodeIgniter 4 (CI4). It includes user authentication, metadata management, and user profile handling. 

## Features
- User Registration and Login (Authentication)
- Metadata Management (CRUD operations)
- User Profile Management

---

# Project Structure

### Controllers
- **AuthController:** Handles user authentication (login and registration).
- **MetadataController:** Manages metadata CRUD operations.
- **UserController:** Manages user-related operations, including user profile.

### Models
- **UserModel:** Interacts with the `users` table in the database, handling user data.
- **MetadataModel:** Interacts with the `metadata` table in the database, managing metadata records.

### Views
- `auth/login.php`: Displays the login form.
- `auth/register.php`: Provides the user registration form.
- `metadata/index.php`: Lists metadata entries.
- `user/profile.php`: Displays and allows editing of user profiles.

### Routes Configuration
The application's routes are configured in the `app/Config/Routes.php` file. Below are the key routes:

```php
  // Landing page or login page

$routes->get('/login', 'AuthController::login');  // Login route
$routes->post('/login', 'AuthController::loginProcess');  // Handle login form submission
$routes->get('/register', 'AuthController::register');  // Registration form
$routes->post('/register', 'AuthController::registerProcess');  // Handle registration
$routes->get('/logout', 'AuthController::logout');  // Logout route

$routes->get('/metadata', 'MetadataController::index');  // List metadata
$routes->get('/metadata/create', 'MetadataController::create');  // Create metadata form
$routes->post('/metadata/store', 'MetadataController::store');  // Store new metadata
$routes->get('/metadata/edit/(:num)', 'MetadataController::edit/$1');  // Edit metadata form
$routes->post('/metadata/update/(:num)', 'MetadataController::update/$1');  // Update metadata
$routes->get('/metadata/delete/(:num)', 'MetadataController::delete/$1');  // Delete metadata

$routes->get('/users', 'UserController::index');  // List all users
$routes->get('/users/profile', 'UserController::profile');  // View and edit user profile
```

---

## Login ->


http://localhost/project-root/login

Email= test@testing.com
Password=Simple@1234#
