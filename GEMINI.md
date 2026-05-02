# Project Overview

This is a Laravel 12 web application. It uses a standard Laravel stack with PHP 8.2, and the frontend is built using Vite, Tailwind CSS, and Alpine.js.

The project structure follows the standard Laravel directory layout. Key directories include:
- `app/`: Contains the core application code (Models, Controllers, etc.).
- `routes/`: Holds the application's route definitions.
- `resources/views/`: Contains the Blade templates for the UI.
- `database/`: Includes database migrations, seeders, and factories.
- `config/`: Stores all of the application's configuration files.
- `tests/`: Contains the application's test suite.

# Building and Running

### 1. Initial Setup

To set up the project for the first time, run the following command. This will install PHP and JS dependencies, create a `.env` file, generate an application key, run database migrations, and build the frontend assets.

```bash
composer setup
```

### 2. Running the Development Environment

To start the local development environment, which includes the PHP server, queue worker, log watcher, and Vite server, use the following command:

```bash
composer run dev
```

- The application will be available at `http://127.0.0.1:8000`.
- The Vite server handles hot-reloading for frontend assets.

### 3. Running Tests

To run the project's test suite, use the following command:

```bash
composer test
```
This will execute the PHPUnit tests defined in the `tests/` directory.

# Development Conventions

- **Backend:** The application follows standard Laravel conventions and MVC patterns.
- **Frontend:** Frontend assets are managed with Vite. JavaScript and CSS are located in `resources/js` and `resources/css` respectively. The application uses Tailwind CSS for styling and Alpine.js for JavaScript interactivity within Blade templates.
- **Routing:** Web routes are defined in `routes/web.php` and API routes in `routes/api.php`.
- **Database:** Database schema changes are managed through migration files located in `database/migrations`.
- **Testing:** Tests are written using PHPUnit and Pest. Feature tests are in `tests/Feature` and unit tests are in `tests/Unit`.
