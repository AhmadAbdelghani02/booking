# 🏨 JoHotels - Hotel Booking Website 🗺️

JoHotels is a comprehensive web application for booking hotels across Jordan 🌍. Designed to provide a seamless experience for both users and administrators, the platform offers features like hotel management, secure user authentication 🔐, and dynamic data visualization 📊. Built using modern web technologies, JoHotels ensures responsive design 📱 and functionality across devices.

## 🚀 Technologies Used

JoHotels leverages the following technologies:
- 🌐 **Frontend**: HTML, CSS, JavaScript, Bootstrap
- ⚙️ **Backend**: Laravel framework (Blade templates, Middleware, Laravel Breeze)
- 🗄️ **Database**: MySQL
- 📈 **Other Tools**: Laravel Charts for data visualization, PHP for backend logic

## ⭐ Features

### 🌟 User-Facing Features:
- **Responsive Design**: The website is fully responsive, ensuring usability on all devices (desktop 💻, tablet 📟, mobile 📱).
- **User Registration & Authentication**: Built with Laravel Breeze for easy and secure user registration.
- **Hotel Search & Booking**: Users can browse hotels 🏨, view details 📄, and book accommodations ✈️.

### 🛠️ Admin Dashboard Features:
- **CRUD Operations**: Admins can manage hotels, regions, and bookings with intuitive CRUD functionality ✏️📦.
- **Middleware for Authentication**: Ensures that only authorized users 👤 can access the admin panel.
- **Data Visualization**: Utilizes Laravel Charts 📊 to provide insights on bookings and user activity.

## 🛠️ Installation Steps

Follow these steps to install and run the JoHotels project on your local machine:


- 📥 Clone the Repository:git clone https://github.com/Ahmad-Arabi/Laravel_Project
cd Laravel_Project

- 📦 Install Dependencies: Run the following command to install PHP dependencies using Composer:composer install

- ⚙️ Set Up the Environment File: Create a .env file in the root directory by copying the .env.example file:cp .env.example .env
Update the .env file with your database credentials.
- 🔑 Generate Application Key:php artisan key:generate

- 🗄️ Migrate the Database: Run the migration to set up database tables:php artisan migrate

- 💾 Seed the Database (Optional): If you have seeders to populate the database with sample data, use:php artisan db:seed

- 📦 Install Node.js Dependencies:npm install

- 📁 Build Frontend Assets:npm run dev

- ▶️ Run the Application: Start the Laravel server:php artisan serve
Access the website at http://127.0.0.1:8000.


