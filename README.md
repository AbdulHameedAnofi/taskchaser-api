# Taskchaser Api

This is a simple product cart application built with Laravel. Users can:
- Register and sign in
- View a list of products
- Add products to their cart
- Remove products from their cart
- Checkout the cart and receive a confirmation email

This application was developed as part of an interview task.

## Features
- User authentication (registration & signin)
- Product listing
- Cart management (add/remove items)
- Checkout process with email confirmation

## Installation & Setup

### Clone the Repository
```bash
 git clone https://github.com/AbdulHameedAnofi/taskchaser-api.git
 cd taskchaser-api
```

### Install Dependencies
```bash
composer install
npm install  # If frontend assets need to be compiled
```

### Configure Environment
Copy the `.env.example` file to `.env` and update the necessary database and mail configuration:
```bash
cp .env.example .env
```
Then generate an application key:
```bash
php artisan key:generate
```

### Set Up Database
```bash
php artisan migrate --seed
```

### Start the Server
```bash
php artisan serve
```

Your application will be running at `http://127.0.0.1:8000`.

## Running Tests
Run the following command to execute the test suite:
```bash
php artisan test
```

You should see test results indicating whether all features are working correctly.

## Mail Configuration
To send emails on checkout, update the `.env` file with your mail credentials:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your-email@example.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@example.com
MAIL_FROM_NAME="Product Cart"
```

## API Endpoints
| Method | Endpoint         | Description             |
|--------|-----------------|-------------------------|
| POST   | /api/register   | Register a new user     |
| POST   | /api/signin      | Authenticate user       |
| GET    | /api/products   | Get list of products    |
| POST   | /api/cart       | Add product to cart     |
| DELETE | /api/cart/{id}  | Remove product from cart |
| POST   | /api/checkout   | Checkout cart & send email |

## Conclusion
This project demonstrates a simple product cart system with essential functionalities like authentication, cart management, and email notifications.

