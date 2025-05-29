# Laravel Ecommerce Product Reviews Application API
This is a simple Laravel ecommerce application with useful features, built using MySQL, JWT authentication, repository and service patterns and more.

## Features
- **JWT Authentication** for secure API access.
- **Product Management** with image attachments.
- **Pagination, Filtering, Sorting** functionality for products.
- **API Documentation** available to (Postman).
- **Repositories and Services** for writing clean code.
- **Laravel Requests** custom request for APIs.
- **Seeders** for importing two users (User & Admin).
- **Exceptions** custom exceptions for handling errors.
- **Resources** For handling API responses.
- **API Response Trait** for handling success, error and validation responses for APIs.
- **JSON Langs Files** for translating API responses.
  
## Prerequisites
Before running the project, ensure you have the following installed:
- PHP 8.x
- MySQL
- Composer
- Postman
- VS Code Or PHPStorm

## Getting Started & Installation Steps
1. Clone the repository:
   - git clone https://github.com/devahmedsaber/ecommerce-product-reviews.git
   - cd ecommerce-product-reviews
2. Install dependencies:
   - composer install
3. Set up environment variables:
      - Copy `.env.example` to `.env` (cp .env.example .env)
      - Update database configuration:
          - DB_CONNECTION=mysql
          - DB_HOST=127.0.0.1
          - DB_PORT=3306
          - DB_DATABASE=your_database_name => like (todo_list_app)
          - DB_USERNAME=your_database_user => like (root)
          - DB_PASSWORD=your_database_password
4. Generate the application key by running this command bash:
    - php artisan key:generate
5. Generate the JWT secret (for authentication) by running this command bash:
    - php artisan jwt:secret
6. Run the database migrations by running this command bash:
    - php artisan migrate
7. Run seeders (for seed data like 2 users) by running this command bash:
    - php artisan db:seed
8. Start the development server by running this command bash:
    - php artisan serve
9. Access the application by running this command bash:
    - Open your browser and navigate to `http://localhost:8000` or `http://ecommerce-product-reviews.test`.

## Some Guidelines
1. API Documentation:
    - You can view the API documentation (Postman) by visiting the following link:
        https://documenter.getpostman.com/view/27286122/2sB2qfAzYY
    - Or you can add the ecommerce product reviews app collection to your postman collections by importing it manually.
    - The ecommerce product reviews app collection exists in root directory with project files called (Ecommerce Product Reviews.postman_collection).
    - Change `url` variable value from variables tab of postman collection with your application serve link like `http://localhost:8000` or `http://ecommerce-product-reviews.test`.
2. JWT Authentication:
    - All API requests are secured with JWT authentication. Make sure to authenticate by obtaining a token via the `/api/auth/login` endpoint and including it in your requests.
