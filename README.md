<p align="center">
  <img src="images/logo.png" alt="Laravel Logo">
</p>

# SiyenSHOP: AN INTEGRATED E-COMMERCE PLATFORM FOR MERCHANDISE SHOPS WITHIN BICOL UNIVERSITY COLLEGE OF SCIENCE

## DESCRIPTION

This project is a **web-based e-commerce system** designed to provide a student-friendly platform for students of Bicol University to browse and purchase all kinds of merchandise from various student organizations within the Bicol University College of Science. It allows users to choose products to buy effectively, add them to the cart, and track orders.

## FEATURES

## 1. User Profile and Authentication

Users are able to secure login and registration of accounts for the website. They can access the Products page which shows their personal information such as:

- **Profile picture**
- **Name**
- **Email**
- **Course**
- **Block**
- **Phone number**
- **Password**

## 2. Navigation Menu

Provides easy access for customers to navigate through the main features of the system, including:

- **Home page**
- **Product Catalog page**
- **FAQs page**
- **Cart**
- **Profile page**

This menu is located at the upper part of the screen, improving user experience and usability by allowing quick transitions between pages.

## 3. FAQs Page

Allows customers to view common questions and answers regarding SiyenSHOP and its purchasing processes.

## 4. Product Catalogue and Product Details

Offers a user-friendly interface displaying a dynamic catalog of products being sold. Key product details include:

- **Images**
- **Descriptions**
- **Pricing**
- **Reviews**

Users can also choose product specifications (quantity and variant) before adding items to the cart or proceeding to checkout.

## 5. Search and Filter

Customers can easily search for products using the search bar located at the top of the **Home** and **Product Catalogue** pages. Filters by:

- **Organization type**
- **Category**

This helps narrow down options based on specific criteria, making it easier to find products suited to their preferences.

## 6. Cart Page

Displays the items added to the cart, along with the subtotal price and a checkout button. Customers can:

- **Update product specifications** (quantity and variant)
- **Remove items**

This feature allows users to review and modify their order before proceeding to checkout.

## 7. Checkout Page

Customers can complete their purchase on this page, which includes:

- **Order summary**
- **Total amount**
- **Organization's name**
- **G-Cash number**

Input fields are provided for uploading proof of payment (payment screenshot and reference number). An invoice will be sent to the user's email containing the order's receipt.

## 8. Order Tracking

Users can view their order history on the **My Purchases** page and track the status of their purchases.

## 9. Product Management

Business managers of the organization are able to:

- **Add**
- **Edit**
- **Delete**

These actions apply to the products displayed in the **Product Catalogue**.

## 10. Order Management

Business managers can:

- **View customer orders**
- **Change the status of orders**

This feature enhances efficiency in managing the order fulfillment process and helps maintain customer satisfaction by keeping clients informed about order progress.

## 11. Admin and Business Manager Dashboard

Provides a dashboard overview of sales for each organization.

## 12. Create Shops

Admins can create a shop linked to an organization.

## 13. Chat Function

Enables communication between:

- **Customers**
- **Business managers**
- **Admins**

This feature facilitates better customer service and operational coordination.

## INSTALLATION AND USAGE INSTRUCTIONS

### Prerequisites

- PHP >= 8.0
- Composer
- MySQL
- Node.js & npm
- Git

## Steps

#### 1. Clone the repository: First, clone the project from your Git repository

    git clone https://github.com/meowfu0/SiyenShop
    cd siyen-shop

#### 2. Install PHP Dependencies: Use Composer to install the required PHP dependencies for Laravel

    composer install

#### 3. Install JavaScript Dependencies: Install the required JavaScript packages (Bootstrap, etc.) using npm

    npm install

#### 4. Set Up Environment Variables: Create a .env file by copying the example file

    cp .env.example .env

#### 5. Open the .env file and update the following variables to match your local environment

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE= siyenshopdb
    DB_USERNAME=root
    DB_PASSWORD=""

### 6. Go to your xampp and create a database named "siyenshopdb", make sure your xampp server is running

#### 7. Run the Artisan Key Generate Command

    php artisan key:generate

### 8. Run the artisan migrate to migrate the database to your local machine

    php artisan migrate

### 9. Run the database seed command to populate your database

    php artisan db:seed

#### 10. Run the Application: Finally, run the application locally

    php artisan serve

The application will be available at http://localhost:8000

#### 11. For more in-depth instructions, check out the YouTube tutorial.

**Watch the Installation Videos**  
 Follow the guide in this [Laravel 8 Installation Video](https://youtu.be/bbO8IzgPcu8?si=usrZY_1eJrwTWT6s) for detailed steps.  
 For more insights, you can also watch this [Laravel Tutorial](https://youtu.be/RclRaq3by7o?si=pb--_P03r3VT2V8O).

## CONTRIBUTIONS

Contributions to this project are **restricted** to students enrolled in **BSIT - 3B of Bicol University College of Science**. If you are a member of this class and would like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them with descriptive messages.
4. Push your branch to your forked repository.
5. Create a pull request to the main repository.

## Note

Contributions from outside the class are currently not being accepted. Thank you for your understanding.
