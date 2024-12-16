Here's a README.md file for your Blog Application project, modeled after the example you provided:


# Blog Application

This is a Blog Application built using PHP (OOP), MVC architecture, and JWT for API-based authentication. The system supports role-based access control with two roles: Admin and User. The project demonstrates the implementation of modern backend development techniques including middleware, routing, and token-based authentication.

## Features

### Core Features:

#### User Authentication (API & Web):
- Register a new user.
- Login to obtain a JWT token for API authentication.
- Logout with token invalidation.

#### Role-Based Access Control:
- **Admin:**
  - Access to the User List.
  - Edit and delete user accounts.
  - Approve or reject blog posts.
- **:User **
  - Access to the Dashboard to view profile details.
  - Add , Edit and Delete Blog Posts.

#### API Endpoints:
- `POST /api/login`: Authenticate a user and retrieve a JWT token.
- `POST /api/register`: Register a new user.
- `GET /api/user-list`: Get a list of users (Admin only).
- `GET /api/edit-user/{id}`: Get user details for editing (Admin only).
- `POST /api/edit-user`: Edit user details (Admin only).
- `DELETE /api/delete-user/{id}`: Delete a user (Admin only).

#### Middleware Support:
- **LoginCheckMiddleware:** Validates if the user is authenticated.
- **AuthAdminRoleMiddleware:** Checks if the user has sufficient permissions.
- **GuestMiddleware:** Prevents authenticated users from accessing certain routes.
- **ApiAuthMiddleware:** Validates API requests using JWT tokens.

#### JWT Authentication:
- Secure token-based authentication with expiry and logout invalidation.

#### Dynamic Routing:
- MVC-based routing system with flexible URL parameters.

#### Responsive Web Views:
- User-friendly login, registration, and dashboard pages for web.

## Project Structure

```
/app
    /controllers       # Controllers for handling requests
    /core              # Core files (routing, base classes, etc.)
    /middleware        # Middleware classes for request filtering
    /models            # Models for database interaction
    /utils             # Utility classes (e.g., JWT handling)
    /views             # HTML templates for web views
/config
    config.php         # Database and global configuration

index.php          # Entry point for the application And SetUp IN Root Directory 
```
---

## Requirements
- PHP >= 8.0
- MySQL >= 5.7
- Composer
- Postman (for API testing)
---
## Setup Instructions

### Clone the Repository:
```bash
git clone https://github.com/rahulv202/Blog-Application
cd Blog-Application
```
### Install Dependencies:
```bash
composer install
composer init
composer dump-autoload
composer require firebase/php-jwt
```
### Configure Environment:
Update config/config.php with your database credentials.
Database Migration:
Database Name: blog_app
Import the blog_app.sql file into your MySQL database.
### Start the Server:
```bash
php -S localhost:8000 -t public
```
OR

Development Server (http://localhost:8000) started on port 8000:
```bash
php -S localhost:8000
```
### Test the System:
Access the web interface at http://localhost:8000/.
Use Postman to test API endpoints.

### API Documentation
## Endpoints
## Authentication
- `POST /api/register `
 - **Request Body**:
 ``` bash
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
 ```
- **Response**:
``` bash
{
"message": "Registration successful"
}
 ```
-`POST /api/login`

- **Request Body**:
``` bash
{
    "email": "john@example.com",
    "password": "password123"
}
 ```
- **Response**:
``` bash
{
    "token": "your.jwt.token"
}
 ```
- **User Operations**
`GET /api/user-list (Admin Only)`
Headers:
Authorization: Bearer {token}

- **Response**:
``` bash
[
    {
        "id": 1,
        "name": "Admin",
        "email": "admin@example.com",
        "role": "admin"
    },
    {
        "id": 2,
        "name": "John Doe",
        "email": "john@example.com",
        "role": "user"
    }
]
```
`Admin Operations`
`POST /api/edit-user (Admin Only)`

- **Request Body**:
``` bash
{
    "id": 2,
    "name": "Jane Doe",
    "email": "jane@example.com"
}
 ```
- **Response**:
``` bash
{
    "message": "User  details updated successfully."
}
 ```   
`DELETE /api/delete-user/{id} (Admin Only)`
Headers:
Authorization: Bearer {token}

- **Response**:
``` bash
{
    "message": "User  deleted successfully."
}
 ```
---
## Troubleshooting

1. **Database Connection Issues**:
   - Verify credentials in `config/config.php`.



---

## License

This project is open-source and available under the [MIT License](LICENSE).

---
