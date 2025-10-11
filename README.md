# Todo Application

## Overview
mvctodo is a lightweight PHP MVC (Model–View–Controller) application that demonstrates a basic to-do list system with authentication. It’s designed to show how to structure a small project with controllers, models, and views — while using clean URL routing and simple session-based login handling.

## Project Structure
```
app/
 ├── Controllers/      → Handles HTTP requests (Auth, Home, Todo)
 ├── Core/             → Framework core (base Controller, CSRF handler)
 ├── Models/           → Data logic (User, Todo models)
 └── Views/            → Templates organized by section (auth, home, todo, layouts)
config/
 ├── config.php        → App-wide constants (paths, base URL)
 └── db.php            → Database connection (PDO)
public/
 ├── index.php         → Front controller; routes all requests
 ├── .htaccess         → URL rewriting for clean routes
 └── css/              → Stylesheets (base, auth, sidebar)
tests/
 ├── testUser.php      → Unit test for User model
 └── testTodo.php      → Unit test for Todo model
```

## Requirements
- PHP ≥ 8.0  
- Apache or Nginx with URL rewriting enabled  
- MySQL (or compatible) database  
- Composer (optional, for autoloading if extended)

## Setup
1. **Clone or extract** the repository into your web server’s root:
   ```bash
   git clone https://github.com/yourname/mvctodo.git
   ```
   or copy the extracted folder into `/htdocs/mvctodo/` or `/var/www/html/mvctodo/`.

2. **Database setup:**
   - Create a database named `mvctodo`.
   - Import your `schema.sql` (if exists, otherwise create tables matching `User` and `Todo` model fields).

3. **Configure database connection**  
   Edit `config/db.php` to include your MySQL credentials:
   ```php
   $db = new PDO('mysql:host=localhost;dbname=mvctodo', 'username', 'password');
   ```

4. **Set base URL**  
   `config/config.php` should define your app path:
   ```php
   define('BASE_URL', '/mvctodo/public/');
   ```

5. **Apache rewrite rules**  
   Ensure `.htaccess` in `/public` is active:
   ```apache
   RewriteEngine On
   RewriteCond %{REQUEST_FILENAME} !-f
   RewriteCond %{REQUEST_FILENAME} !-d
   RewriteRule ^(.*)$ index.php?url=$1 [L,QSA]
   ```

6. **Run**
   Visit `http://localhost/mvctodo/public/` — the app should load the login screen.

## Core Logic
- **Routing:** `public/index.php` captures all requests and maps them to the correct controller/action.  
- **Controllers:** Receive requests, validate input, and call models.  
- **Models:** Encapsulate database logic (`Todo.php`, `User.php`).  
- **Views:** Render data using layout inheritance (`layouts/main.php`).  
- **Security:** Basic CSRF protection via `app/Core/CSRF.php`.  
- **Sessions:** Used for authentication and persistent login.

## Testing
Run test files in `/tests` directly from CLI or browser:
```bash
php tests/testUser.php
php tests/testTodo.php
```

## Planned Enhancements
- User password hashing and validation improvements  
- Persistent login via tokens  
- RESTful API endpoints for external access  
- Ajax handling for to-do CRUD operations  
