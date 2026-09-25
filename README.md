# Personal Task Manager

Project Code: WST21-PM-2026-SF
Student Name: jeff miko g. buñao
Course & Year:BSIT 2nd year
Database Used: MySQL

Features:

* Add Task
* View Tasks
* Edit Task
* Delete Task
* Update Status

## About

A simple Personal Task Manager built with Laravel following the Routes → Controller → Model → Database → Blade
pattern. Users can create, view, edit, delete tasks, and mark them as Pending or Completed.

## Tech Stack

- Laravel (PHP framework)
- MySQL (database)
- Blade templates
- Bootstrap 5 (styling)

## How to Run Locally

1. Clone the repository:
   ```
   git clone <your-repo-url>
   cd task-manager
   ```

2. Install dependencies:
   ```
   composer install
   ```

3. Copy the environment file and generate the app key:
   ```
   cp .env.example .env
   php artisan key:generate
   ```

4. Configure your database in `.env`:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Create the database (e.g. via phpMyAdmin or the mysql CLI) named `task_manager`.

6. Run the migrations:
   ```
   php artisan migrate
   ```

7. Start the development server:
   ```
   php artisan serve
   ```

8. Visit `http://127.0.0.1:8000` in your browser.

## Project Structure

- `database/migrations/` – creates the `tasks` table (id, task_name, description, status, due_date)
- `app/Models/Task.php` – Eloquent model for tasks
- `app/Http/Controllers/TaskController.php` – handles all CRUD logic and status updates
- `routes/web.php` – defines all task routes (resource route + a status-toggle route)
- `resources/views/tasks/` – Blade views (index, create, edit)
- `resources/views/layouts/app.blade.php` – shared page layout/navigation
