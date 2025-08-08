# 🧮 TALL Stack Scientific Calculator

A modern, responsive scientific calculator built with the TALL stack (Tailwind CSS, Alpine.js, Laravel, Livewire) featuring a sleek dark theme, calculation history, and real-time database persistence.

## ✨ Features

- **Scientific Calculator**: Basic arithmetic operations plus trigonometric functions (sin, cos, tan, log, √)
- **Calculation History**: All calculations are saved to database and displayed in a dedicated history tab
- **Modern UI**: Dark theme with smooth animations and responsive design
- **Tab Interface**: Switch between calculator and history views
- **Real-time Updates**: Instant calculation results and history updates
- **Mobile-First**: Optimized for mobile devices with touch-friendly buttons

## 🚀 Tech Stack

- **Backend**: Laravel 10+ (PHP 8.1+)
- **Frontend**: Tailwind CSS, Alpine.js
- **Reactive Components**: Laravel Livewire
- **Database**: MySQL
- **Build Tools**: Vite

## 📋 Prerequisites

Make sure you have the following installed on your system:

- PHP 8.1 or higher
- Composer
- Node.js (16+ recommended) and npm
- MySQL or SQLite
- Git

## 🛠️ Installation

### 1. Clone the Repository

```bash
git clone https://github.com/shaheer-007/Tall-Calculator.git
cd Tall-Calculator
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
# Copy the environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Database Configuration

Edit your `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tall_calculator
DB_USERNAME=root
DB_PASSWORD=
```
### 6. Run Database Migrations

```bash
php artisan migrate
```

### 7. Build Frontend Assets

```bash
# For development
npm run dev

# For production
npm run build
```

## 🚀 Running the Application

### Development Mode

Open two terminal windows:

**Terminal 1 - Laravel Development Server:**
```bash
php artisan serve
```

**Terminal 2 - Vite Development Server:**
```bash
npm run dev
```

Visit: `http://localhost:8000`

### Production Mode

```bash
# Build production assets
npm run build

# Serve with your web server (Apache/Nginx)
# Or use Laravel's server for testing
php artisan serve
```

## 📂 Project Structure

```
calculator-app/
├── app/
│   └── Livewire/
│       └── Calculator.php           # Main calculator component
├── database/
│   └── migrations/
│       └── create_calculations_table.php
├── resources/
│   ├── css/
│   │   └── app.css                  # Tailwind CSS
│   ├── js/
│   │   └── app.js                   # Alpine.js setup
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php        # Main layout
│       └── livewire/
│           └── calculator.blade.php  # Calculator view
├── routes/
│   └── web.php                      # Application routes
└── package.json
```

## 🎮 Usage

### Basic Operations
- **Numbers**: Click 0-9 to input numbers
- **Operators**: +, -, ×, ÷ for basic arithmetic
- **Decimal**: Click . for decimal point
- **Calculate**: Press = to evaluate expression

### Scientific Functions
- **√**: Square root - `Math.sqrt(number)`
- **sin**: Sine function - `Math.sin(number)`
- **cos**: Cosine function - `Math.cos(number)`
- **tan**: Tangent function - `Math.tan(number)`
- **log**: Natural logarithm - `Math.log(number)`

### Controls
- **AC**: All Clear - resets calculator
- **⌫**: Backspace - removes last character
- **History Tab**: View and reuse previous calculations

## 🔧 Development Commands

```bash
# Install dependencies
composer install
npm install

# Database operations
php artisan migrate              # Run migrations
php artisan migrate:fresh        # Fresh migration
php artisan migrate:rollback     # Rollback migrations

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Generate Livewire components
php artisan make:livewire ComponentName

# Asset building
npm run dev          # Development mode with hot reload
npm run build        # Production build
npm run watch        # Watch for changes
```

## 🚀 Deployment

### Shared Hosting
1. Build production assets: `npm run build`
2. Upload files to your hosting provider
3. Set up database and update `.env`
4. Run migrations: `php artisan migrate`

### VPS/Cloud (Ubuntu)
```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install required software
sudo apt install php8.1 php8.1-cli php8.1-fpm php8.1-mysql php8.1-xml php8.1-curl php8.1-zip php8.1-mbstring nginx mysql-server nodejs npm composer git -y

# Clone and setup project
git clone https://github.com/yourusername/tall-stack-calculator.git
cd tall-stack-calculator
composer install --optimize-autoloader --no-dev
npm install && npm run build

# Set permissions
sudo chown -R www-data:www-data /path/to/calculator-app
sudo chmod -R 755 /path/to/calculator-app/storage
sudo chmod -R 755 /path/to/calculator-app/bootstrap/cache

# Setup environment and database
cp .env.example .env
php artisan key:generate
php artisan migrate
```

## 🔒 Security Note

⚠️ **Important**: This calculator uses JavaScript's `eval()` function for mathematical expressions, which can be dangerous in production. For a production environment, consider using a safer math expression parser like:

- `mathjs` library
- `symfony/expression-language`
- Custom expression parser

## 🐛 Troubleshooting

### Common Issues

**Assets not loading:**
```bash
npm run dev
# or
npm run build
```

**Database connection error:**
- Check `.env` database credentials
- Ensure database exists and is accessible
- Run `php artisan config:cache`

**Livewire not working:**
```bash
php artisan view:clear
php artisan config:clear
```

**Tailwind styles not applying:**
- Make sure Vite dev server is running: `npm run dev`
- Check that `@vite` directive is in your layout

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch: `git checkout -b feature-name`
3. Make your changes
4. Commit: `git commit -m "Add feature"`
5. Push: `git push origin feature-name`
6. Create a Pull Request

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🆘 Support

If you encounter any issues or have questions:

1. Check the [Issues](https://github.com/yourusername/tall-stack-calculator/issues) page
2. Create a new issue with detailed information
3. Include your PHP version, Node.js version, and error messages

## 🙏 Acknowledgments

- Laravel Framework
- Livewire
- Alpine.js
- Tailwind CSS
- The PHP and Laravel community

---

**Happy Calculating! 🧮✨**

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
