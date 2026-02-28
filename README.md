# Daily~Track - NSS Activity Tracking System

![Daily~Track Banner](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

## 📋 Project Overview

**Daily~Track** is a comprehensive activity tracking system developed for NSS personnel to efficiently manage tasks, monitor progress, and generate insightful reports. As part of the project requirements, the system has been implemented following all specified requirements, allowing users to:

- ✅ **Login and Register** - Secure authentication system with role-based access control
- ✅ **Create Activities** - Add new activities with titles, descriptions, and assign personnel
- ✅ **Update Status** - Track activity progress with real-time status updates (Pending/Done)
- ✅ **Add Remarks** - Include detailed remarks and comments on activity updates
- ✅ **View Activities** - Browse, search, and filter all activities in an intuitive dashboard
- ✅ **Daily View** - View all activities updated on a specific date with summary statistics
- ✅ **Generate Reports** - Create comprehensive reports filtered by date range, status, and personnel
- ✅ **Responsive Design** - Mobile-friendly interface with NSS color theme (White, Green, Yellow)
- ✅ **User Management** - Track which personnel is working on which activities

---

## 🎨 Features

### Core Functionality
- **Activity Input Form** - Create activities with title, description, and assignee
- **Status Tracking** - Update activity status with remarks and timestamps
- **Personnel Tracking** - Monitor who updated each activity and when
- **Daily Activity View** - See all updates for any selected date
- **Advanced Reporting** - Filter reports by date range, status, and user
- **Real-time Updates** - View latest activity status on dashboard

### Design & UX
- **Modern NSS Theme** - Professional white, green, and yellow color scheme
- **Responsive Layout** - Optimized for desktop, tablet, and mobile devices
- **Interactive Onboarding** - Step-by-step guide for new users
- **Animated UI** - Smooth transitions and gradient effects
- **Icon-based Actions** - Intuitive view, edit, and delete icons

### Performance
- **Fast Loading** - Optimized assets with Vite bundling
- **Efficient Queries** - Eager loading to prevent N+1 problems
- **Cached Views** - Compiled Blade templates for speed
- **CDN Fonts** - Fast font loading with display swap

---

## 🚀 Installation Instructions

### Prerequisites

Before you begin, ensure you have the following installed:
- **XAMPP** (or any local server with PHP 8.2+ and MySQL)
- **Composer** (PHP dependency manager) - Download from https://getcomposer.org/
- **Node.js** (v18 or higher) - Download from https://nodejs.org/
- **Git** (for cloning the repository) - Download from https://git-scm.com/

### Step 1: Download from GitHub

1. Open your terminal/command prompt

2. Clone the repository:
```bash
git clone https://github.com/your-username/activity-tracker.git
```

3. Navigate to the project directory:
```bash
cd activity-tracker
```

### Step 2: Install Dependencies

1. Install PHP dependencies using Composer:
```bash
composer install
```

2. Install JavaScript dependencies:
```bash
npm install
```

### Step 3: Configure Environment

1. Copy the `.env.example` file to `.env`:
```bash
# Windows (Command Prompt)
copy .env.example .env

# Windows (PowerShell)
Copy-Item .env.example .env

# Mac/Linux
cp .env.example .env
```

2. Generate application key:
```bash
php artisan key:generate
```

### Step 4: Setup Database with XAMPP

1. **Start XAMPP Control Panel**
   - Start **Apache** and **MySQL** services

2. **Create Database**
   - Open your browser and go to: `http://localhost/phpmyadmin`
   - Click on "New" in the left sidebar
   - Create a database named: `activity_tracker`
   - Collation: `utf8mb4_unicode_ci`

3. **Configure Database Connection**
   - Open the `.env` file in your project root
   - Update the database configuration:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=activity_tracker
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   *(Leave DB_PASSWORD empty if you haven't set a MySQL password in XAMPP)*

### Step 5: Run Database Migrations

Run the migrations to create all necessary tables:
```bash
php artisan migrate
```

When prompted "Do you want to run the migrations?", type `yes` and press Enter.

### Step 6: Build Frontend Assets

Compile the CSS and JavaScript files:
```bash
npm run build
```

**For development (with hot reload):**
```bash
npm run dev
```

### Step 7: Start the Application

1. Open a new terminal in the project directory

2. Start the Laravel development server:
```bash
php artisan serve
```

3. The application will be available at: **http://127.0.0.1:8000**

### Step 8: Access the Application

1. **Open your browser** and navigate to: `http://127.0.0.1:8000`

2. **Complete the Onboarding:**
   - An interactive 5-step guide will appear on first visit
   - Click "Next" through each step to learn about features
   - Or click "Skip Tour" to proceed directly

3. **Create an Account:**
   - Click "Get Started" or "Register"
   - Fill in your details (Name, Email, Password)
   - Click "Register"

4. **Login:**
   - Use your registered email and password
   - Click "Sign In"

5. **Start Tracking Activities!**

---

## 📱 Usage Guide

### Creating Your First Activity

1. After logging in, click the **"+ Add New Activity"** button
2. Fill in the form:
   - **Title**: Brief name for the activity
   - **Description**: Detailed description of the task
3. Click **"Create Activity"**

### Updating Activity Status

1. Go to **Dashboard**
2. Find the activity you want to update
3. Click the **View** icon (eye icon)
4. Click **"Add Update"**
5. Select status (**Pending** or **Done**)
6. Add remarks (optional)
7. Click **"Save Update"**

### Viewing Daily Activities

1. Click **"Daily View"** in the navigation
2. Select a date from the calendar
3. Click **"View"**
4. See all activities updated on that date with summary statistics

### Generating Reports

1. Click **"Reports"** in the navigation
2. Set filters:
   - **Start Date** and **End Date**
   - **Status** (All/Pending/Done)
   - **Personnel** (All users or specific user)
3. Click **"Apply Filters"**
4. View the comprehensive report

---

## 🗂️ Project Structure

```
activity-tracker/
├── app/
│   ├── Http/Controllers/
│   │   └── ActivityController.php    # Handles all activity operations
│   ├── Models/
│   │   ├── Activity.php               # Activity model
│   │   ├── ActivityUpdate.php         # Activity updates model
│   │   └── User.php                   # User model
│   └── Providers/
│       └── AppServiceProvider.php     # Service provider with optimizations
├── database/
│   └── migrations/
│       └── 2026_02_28_050420_create_activities_table.php
├── resources/
│   ├── css/
│   │   └── app.css                    # Tailwind CSS entry point
│   ├── js/
│   │   └── app.js                     # JavaScript entry point
│   └── views/
│       ├── activities/
│       │   ├── index.blade.php        # Dashboard with activities list
│       │   ├── create.blade.php       # Create activity form
│       │   ├── edit.blade.php         # Edit activity form
│       │   ├── show.blade.php         # View activity details
│       │   ├── daily.blade.php        # Daily activities view
│       │   └── report.blade.php       # Reports page
│       ├── auth/
│       │   ├── login.blade.php        # Login page
│       │   └── register.blade.php     # Registration page
│       ├── layouts/
│       │   ├── app.blade.php          # Main layout with bubbles
│       │   └── navigation.blade.php   # Navigation bar
│       └── welcome.blade.php          # Landing page with onboarding
├── routes/
│   └── web.php                        # Web routes
├── tailwind.config.js                 # Tailwind configuration (NSS colors)
├── vite.config.js                     # Vite build configuration
├── composer.json                      # PHP dependencies
├── package.json                       # JavaScript dependencies
└── .env.example                       # Environment configuration template
```

---

## 🐛 Troubleshooting

### Common Issues

**1. "Class 'App\...' not found" Error**
```bash
composer dump-autoload
```

**2. CSS/JS Changes Not Showing**
```bash
npm run build
php artisan view:clear
```

**3. Database Connection Error**
- Verify XAMPP MySQL is running
- Check `.env` database credentials
- Ensure database `activity_tracker` exists

**4. "419 Page Expired" on Forms**
```bash
php artisan cache:clear
php artisan config:clear
```

**5. Port 8000 Already in Use**
```bash
php artisan serve --port=8001
```

**6. Permission Errors (Mac/Linux)**
```bash
chmod -R 775 storage bootstrap/cache
```

**7. Composer Install Fails**
- Ensure PHP 8.2+ is installed and in PATH
- Run `php -v` to check version
- Try `composer install --ignore-platform-reqs` (not recommended for production)

**8. NPM Install Fails**
- Check Node.js version: `node -v` (should be 18+)
- Clear npm cache: `npm cache clean --force`
- Delete `node_modules` and `package-lock.json`, then run `npm install` again

---

## 📊 Database Schema

### Activities Table
- `id` - Primary key
- `title` - Activity title
- `description` - Detailed description
- `user_id` - Creator (foreign key)
- `created_at` / `updated_at` - Timestamps

### Activity Updates Table
- `id` - Primary key
- `activity_id` - Related activity (foreign key)
- `user_id` - User who made update (foreign key)
- `status` - Current status (pending/done)
- `remark` - Optional note
- `created_at` / `updated_at` - Timestamps

### Users Table
- `id` - Primary key
- `name` - User full name
- `email` - Email (unique)
- `password` - Hashed password
- `created_at` / `updated_at` - Timestamps

---

## 🚀 Deployment to Production

### Prepare for Production

1. **Optimize Application:**
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

2. **Update Environment:**
```env
APP_ENV=production
APP_DEBUG=false
```

3. **Set Up Production Database:**
- Create production database
- Update `.env` with production credentials
- Run migrations: `php artisan migrate --force`

4. **Set Proper Permissions:**
```bash
chmod -R 755 storage bootstrap/cache
```

### Recommended Production Stack
- **Server**: Linux (Ubuntu 22.04)
- **Web Server**: Nginx or Apache
- **PHP**: 8.2+
- **Database**: MySQL 8.0+
- **Node**: 18+

---

## 🎯 Requirements Met

✅ User authentication (Login/Register)  
✅ Activity creation and management  
✅ Status updates with remarks  
✅ Personnel tracking  
✅ Daily activity view  
✅ Comprehensive reporting system  
✅ Responsive NSS-themed design  
✅ Mobile-friendly interface  
✅ Performance optimizations  
✅ Interactive user onboarding  

---

## 📄 Technology Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Tailwind CSS v4, Alpine.js
- **Database**: MySQL/MariaDB
- **Authentication**: Laravel Breeze
- **Build Tool**: Vite
- **Icons**: SVG (Heroicons)

---

## 📝 Changelog

### Version 1.0.0 (February 28, 2026)
- Initial release
- Complete activity tracking system
- NSS-themed responsive design
- Interactive onboarding guide
- Daily view and reporting features
- Mobile-responsive dashboard
- Performance optimizations

---

## 👨‍💻 Support

For issues or questions:
1. Check the **Troubleshooting** section above
2. Review Laravel documentation: https://laravel.com/docs
3. Review Tailwind CSS documentation: https://tailwindcss.com/docs

---

## 📄 License

This project is developed as part of a requirement submission for NSS. All rights reserved.

---

**Thank you for using Daily~Track!** 🎉

## Features

### 1. Activity Management
- Create and manage activities (e.g., "Daily SMS count in comparison to SMS count from logs")
- Edit and delete activities
- View detailed activity information

### 2. Status Updates
- Update activity status (Pending/Done)
- Add remarks to each status update
- Track who made each update and when

### 3. Personnel Tracking
- Captures bio details (name, email) of personnel updating activities
- Timestamps for all updates
- Full audit trail of all changes

### 4. Daily View
- View all activities updated on a specific day
- See who updated what and at what time
- Summary statistics (total updates, completed, pending)
- Helps with daily handover between personnel

### 5. Reporting
- Query activity histories based on custom date ranges
- Filter by status (Pending/Done)
- Filter by personnel
- Detailed view of all updates with timestamps

### 6. User Authentication
- Secure login system using Laravel Breeze
- Only authenticated users can access the system
- Profile management

## Installation & Setup

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js and NPM
- MySQL or SQLite database

### Setup Steps

1. **Clone the repository**
   ```bash
   cd activity-tracker
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Configure environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure database**
   Edit `.env` file and set your database credentials:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=activity_tracker
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   Visit `http://localhost:8000` in your browser

## Usage

### First Time Setup
1. Register a new account at `/register`
2. Login with your credentials
3. You'll be redirected to the dashboard

### Creating an Activity
1. Click "Add New Activity" button on the dashboard
2. Enter activity title and optional description
3. Click "Create Activity"
4. The activity is created with initial "Pending" status

### Updating Activity Status
1. Click "View" on any activity from the dashboard
2. Select status (Pending/Done)
3. Optionally add a remark
4. Click "Update Status"
5. The update is recorded with your details and timestamp

### Viewing Daily Activities
1. Click "Daily View" in the navigation
2. Select a date or view today's activities
3. See all updates made on that day with personnel details

### Generating Reports
1. Click "Reports" in the navigation
2. Set date range, status, or personnel filters
3. Click "Apply Filters"
4. View and analyze the filtered results

## Database Schema

### activities
- `id`: Primary key
- `title`: Activity name
- `description`: Optional details
- `created_at`, `updated_at`: Timestamps

### activity_updates
- `id`: Primary key
- `activity_id`: Foreign key to activities
- `user_id`: Foreign key to users (personnel who made the update)
- `status`: Enum (pending, done)
- `remark`: Optional text
- `created_at`, `updated_at`: Timestamps

### users
- Standard Laravel user table with authentication fields

## Technology Stack

- **Backend**: Laravel 11
- **Frontend**: Blade Templates, Tailwind CSS, Alpine.js
- **Database**: MySQL/SQLite
- **Authentication**: Laravel Breeze

## Key Features Implemented

✅ Activity input and management  
✅ Status updates (Done/Pending) with remarks  
✅ Bio details and timestamp capture  
✅ Daily activity view for handover management  
✅ Reporting with custom duration filters  
✅ User authentication  
✅ Clean, responsive UI with Tailwind CSS  
✅ Proper code organization and clarity  
✅ Non-functional requirements (security, data integrity)  

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
