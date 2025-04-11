**Laravel Blog App API**

A RESTful API built with Laravel, providing functionalities for user
authentication, blog post management, and commenting system.

# Features

-   **User Authentication**: Register, login, and logout functionalities
    using JWT.​

-   **Blog Posts**: Create, read, update, and delete blog posts.

-   **Comments**: Add comments and replies to blog posts.​

-   **User Profile**: Retrieve authenticated user information.​

# Requirements

-   **PHP** 8.1

-   **Laravel**: 10.x​

-   **Database**: MySQL

# Installation

-   # Project creation using composer : Composer create-projet laravel/laravel blog-app

-   # Enivorment Setup : php artisan key:generate

-   # Database Configuration in .env file

-   # Run migration : php artisan migrate

-   # Run Server : php artisan serve

# Authentication

This API uses JWT for authentication. After registering or logging in,
you\'ll receive an access_token. Include this token in the Authorization
header for protected routes:

# API Endpoints

# Authentication

-   **Register**: POST /api/auth/register

-   **Login**: POST /api/auth/login

-   **Logout**: POST /api/auth/logout *(Requires Authorization)*

-   **User Profile**: GET /api/profile *(Requires Authorization)*

# Posts

-   **Create Post**: POST /api/posts *(Requires Authorization)*

-   **Get All Posts**: GET /api/posts

-   **Get Single Post**: GET /api/posts/{id}

-   **Update Post**: PUT /api/posts/{id} *(Requires Authorization)*

-   **Delete Post**: DELETE /api/posts/{id} *(Requires Authorization)*

# Comments

-   **Add Comment**: POST /api/posts/{post_id}/comments *(Requires
    Authorization)*

-   **Reply to Comment**: POST /api/comments/{comment_id}/reply
    *(Requires Authorization)*

-   **Get Comments for Post**: GET /api/posts/{post_id}/comments

# Postman Collection

A Postman collection is available to test all API endpoints.​

1.  **Import the collection**:

    -   Open Postman.​

    -   Click on Import.​

    -   Choose the Laravel Blog API.postman_collection.json file from
        the project root.

2.  **Set up Environment (Optional)**:

    -   Create a new environment in Postman.​

    -   Add a variable base_url with value http://127.0.0.1:8000/api.​

    -   Use {{base_url}} in the request URLs.

# Contact

For any inquiries or feedback, please contact *aniskuntadi@gmail.com*

# 

# 

#  
