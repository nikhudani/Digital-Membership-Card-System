# Digital Membership Card System (Laravel)

A web-based **Digital Membership Card System** built using **Laravel**, designed to manage users/vendors, and customers with digital membership cards.

## 🚀 Features

### 👨‍💼 Admin
- Manage user details
- Manage vendor information
- Control system data through admin panel

### 👤 User
- Manage personal information
- View and update profile details

### 🪪 Customer
- Manage digital membership cards
- View membership information digitally

## 🛠️ Tech Stack

- **Backend:** Laravel
- **Frontend:** Blade, NPM
- **Database:** MySQL (phpMyAdmin or similar)
- **Package Manager:** Composer, NPM

## How to run the project?
- Clone the repository
- Create `.env` file, based on `.env.example` file
- Run `composer install`
- Run `npm install`
- Run `npm run dev`
- Create new database in phpMyAdmin
- Run `php artisan migrate`
- Run `php artisan db:seed`
- Serve the project through a web server

## 🔐 Default Access (Seeded Accounts)
**Admin Account**
Email: admin@email.com
Password: 123
Role: Admin
Access: Full access to the system (manage users/vendors, customers, and system data)

👤 **User Account**
Email: user@email.com
Password: Abcd1234
Role: User
Access: Manage own information and limited system features
