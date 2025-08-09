# SmartLife - Student Meal Management System

A comprehensive Laravel-based web application for managing student meal plans, QR code-based meal tracking, and dining experience management.

## 🍽️ Overview

SmartLife is a modern web application designed to streamline student meal management in educational institutions. The system provides:

- **QR Code-based meal tracking** for quick and secure meal confirmation
- **Multi-role dashboard** (Student, Manager, Admin, Worker)
- **Real-time meal balance tracking** with remaining times and payment status
- **Email notifications** for meal confirmations
- **Print-ready restaurant cards** for students
- **Session-based access** for quick dashboard viewing

## ✨ Features

### 🎯 Core Features
- **QR Code Generation**: Automatic QR code generation for each student
- **Meal Confirmation System**: Secure meal verification with registration number and passkey
- **Balance Tracking**: Real-time tracking of meal times remaining and payment amounts
- **Multi-Dashboard System**: Different dashboards for students, managers, admins, and workers
- **Email Notifications**: Automatic email alerts when meals are confirmed
- **Print Cards**: Generate printable restaurant cards for students

### 🔐 Security Features
- **Authentication System**: Laravel Breeze-based authentication
- **Session Management**: Secure session-based access control
- **Password Protection**: Encrypted password storage
- **Role-based Access**: Different access levels for different user types

### 📱 User Experience
- **Responsive Design**: Modern UI with Tailwind CSS
- **Interactive Dashboard**: Real-time data updates and hover effects
- **Quick Actions**: Easy access to common functions
- **Session Notices**: Clear feedback for session-based access

## 🛠️ Technology Stack

### Backend
- **Laravel 12.0** - PHP framework
- **PHP 8.2+** - Server-side language
- **MySQL/SQLite** - Database
- **Simple QR Code** - QR code generation library

### Frontend
- **Tailwind CSS** - Utility-first CSS framework
- **Alpine.js** - Lightweight JavaScript framework
- **Vite** - Build tool and dev server
- **Font Awesome** - Icon library

### Development Tools
- **Laravel Breeze** - Authentication scaffolding
- **Laravel Pint** - PHP code style fixer
- **PHPUnit** - Testing framework
- **Faker** - Data generation for testing

## 📋 Prerequisites

Before you begin, ensure you have the following installed:
- **PHP 8.2 or higher**
- **Composer** (PHP package manager)
- **Node.js** and **npm** (for frontend assets)
- **MySQL** or **SQLite** database
- **Git** (for version control)

## 🚀 Installation

### 1. Clone the Repository
```bash
git clone <repository-url>
cd smartlife
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install Node.js Dependencies
```bash
npm install
```

### 4. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Database
Edit your `.env` file and set up your database configuration:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smartlife
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Run Database Migrations
```bash
php artisan migrate
```

### 7. Build Frontend Assets
```bash
# Development
npm run dev

# Production
npm run build
```

### 8. Start the Development Server
```bash
php artisan serve
```

The application will be available at `http://localhost:8000`

## 📊 Database Structure

### Key Tables
- **users**: Student and staff information
- **food_takens**: Meal tracking data
- **daily_food**: Daily meal offerings
- **notifications**: System notifications
- **password_resets**: Password reset tokens

### User Roles
- **Student**: Access to personal dashboard and meal tracking
- **Manager**: Management dashboard for overseeing operations
- **Admin**: Administrative dashboard for system management
- **Worker**: Worker dashboard for daily operations

## 🎮 Usage

### For Students

1. **Access Dashboard**: Visit `/dashboard` to view your meal information
2. **View QR Code**: Your personal QR code is displayed on the dashboard
3. **Check Balance**: Monitor remaining meals and payment status
4. **Print Card**: Generate a printable restaurant card
5. **Login**: Create an account for full access to personal data

### For Staff

1. **Meal Confirmation**: Scan student QR codes or manually verify meals
2. **Verification Process**: 
   - Enter student registration number
   - Enter student passkey
   - Confirm meal consumption
3. **Email Notifications**: Students receive automatic email confirmations

### QR Code System

1. **Generation**: QR codes are automatically generated for each user
2. **Content**: QR codes contain meal confirmation URLs
3. **Usage**: Staff scan codes to quickly access student verification
4. **Security**: Additional verification required (registration number + passkey)

## 🔧 Commands

### Generate QR Codes
```bash
# Generate QR codes for all users without one
php artisan qr:generate

# Generate QR code for specific user
php artisan qr:generate --user-id=1
```

### Development Commands
```bash
# Start development server with all services
composer run dev

# Run tests
composer run test

# Clear application cache
php artisan config:clear
php artisan cache:clear
```

## 📧 Email Configuration

The system sends email notifications for meal confirmations. Configure your email settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@smartlife.com
MAIL_FROM_NAME="SmartLife"
```

## 🧪 Testing

Run the test suite:
```bash
php artisan test
```

## 📁 Project Structure

```
smartlife/
├── app/
│   ├── Console/Commands/     # Artisan commands (QR generation)
│   ├── Http/Controllers/     # Application controllers
│   ├── Mail/                # Email notifications
│   └── Models/              # Eloquent models
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/            # Database seeders
├── resources/
│   ├── views/              # Blade templates
│   ├── css/                # Stylesheets
│   └── js/                 # JavaScript files
├── routes/                 # Application routes
└── public/                # Public assets
```

## 🔒 Security Considerations

- All passwords are hashed using Laravel's built-in hashing
- Session-based access control for dashboard views
- CSRF protection enabled on all forms
- Input validation on all user inputs
- Secure QR code generation with unique URLs

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- Create an issue in the repository
- Contact the development team
- Check the Laravel documentation for framework-specific questions

## 🔄 Version History

- **v1.0.0**: Initial release with core meal management features
- QR code generation and meal tracking
- Multi-role dashboard system
- Email notification system
- Print card functionality

---

**SmartLife** - Making student meal management smarter and more efficient! 🎓🍽️
