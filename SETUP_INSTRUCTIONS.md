# Step-by-Step: Turning This Into a Full Laravel Project

These files are the *application logic* of your project (Model, Controller, Routes, Migration,
Views). A full Laravel project also needs the Laravel framework skeleton (public/index.php,
config/, bootstrap/, vendor/, composer.json, artisan, etc.), which you generate on your own
machine with Composer. Follow these steps exactly.

## 1. Install prerequisites (one-time, on your computer)

- PHP 8.2+ (`php -v` to check)
- Composer (https://getcomposer.org)
- MySQL (e.g. via XAMPP/Laragon/MAMP, or a standalone install)
- Git

## 2. Create a fresh Laravel skeleton

In a terminal, in the folder where you want your project:

```bash
composer create-project laravel/laravel task-manager
cd task-manager
```

This downloads all the core Laravel files (vendor/, artisan, config/, public/, etc.) that
weren't included in this package (they're auto-generated and shouldn't be edited by hand).

## 3. Copy in the files from this package

Copy these files/folders from what I gave you into the new `task-manager` folder,
**overwriting** where a file already exists:

```
database/migrations/2026_09_25_000000_create_tasks_table.php
app/Models/Task.php
app/Http/Controllers/TaskController.php
routes/web.php                     (overwrite the default one)
resources/views/tasks/index.blade.php
resources/views/tasks/create.blade.php
resources/views/tasks/edit.blade.php
resources/views/layouts/app.blade.php
README.md                          (overwrite the default one, then fill in your name/course)
```

## 4. Set up the database

1. Open phpMyAdmin (or your MySQL client) and create a new database called `task_manager`.
2. Open `.env` in the project root and set:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=root
   DB_PASSWORD=
   ```
   (adjust username/password to match your local MySQL setup)

## 5. Run the migration

```bash
php artisan migrate
```

This creates the `tasks` table with columns: id, task_name, description, status, due_date,
created_at, updated_at.

## 6. Start the server and test

```bash
php artisan serve
```

Visit `http://127.0.0.1:8000` — it will redirect to `/tasks`. Test:
- Add Task (form + submit)
- View Tasks (the table)
- Edit Task
- Delete Task
- Mark Done / Mark Pending (quick status toggle button)

## 7. Understand the code (you WILL be asked to explain this)

- **Migration** (`database/migrations/...create_tasks_table.php`): defines the table schema.
- **Model** (`app/Models/Task.php`): the `$fillable` array whitelists which fields can be
  mass-assigned via `Task::create()`/`update()`. `$casts` turns `due_date` into a Carbon date
  object automatically so you can call `->format()` on it in Blade.
- **Controller** (`app/Http/Controllers/TaskController.php`): each method matches a CRUD
  action. `store()` and `update()` validate input before saving. `updateStatus()` is a small
  extra method just for the quick Pending/Completed toggle button.
- **Routes** (`routes/web.php`): `Route::resource('tasks', TaskController::class)` auto-creates
  index/create/store/edit/update/destroy routes in one line — this is Laravel's RESTful
  resource routing. The `PATCH /tasks/{task}/status` route is added separately for the toggle.
- **Views** (`resources/views/tasks/*.blade.php`): Blade templates extend a shared layout
  (`layouts/app.blade.php`) using `@extends`/`@section`/`@yield`. Forms use `@csrf` for security
  and `@method('PUT')`/`@method('DELETE')` because HTML forms only support GET/POST natively —
  Laravel "spoofs" the other HTTP verbs via a hidden `_method` field.

## 8. Push to GitHub

```bash
git init
git add .
git commit -m "Personal Task Manager - Laravel CRUD"
git branch -M main
git remote add origin https://github.com/<your-username>/task-manager.git
git push -u origin main
```

Make sure:
- The repo is **Public**.
- `.env` is NOT committed (Laravel's default `.gitignore` already excludes it — verify with
  `git status` before your first commit).
- `README.md` is filled in with your name, course/year, and any screenshots you want to add.

Then submit only the GitHub repository URL.
