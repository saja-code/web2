# Simple Task Management System

This is my Web Programming II project. It is a simple task management system built with PHP and MySQL. The main idea of the project is to practice using Object-Oriented Programming instead of writing everything in a procedural way.

The system has two types of users:

- Normal user: can create, view, edit, and delete only their own tasks.
- Admin user: can manage users and can view, edit, or delete any task in the system.

## How to Run the Project

1. Put the project folder inside your local server folder.
2. Import the database file:

```bash
mysql -u root < database.sql
```

3. Run the PHP server from inside the project folder:

```bash
php -S 127.0.0.1:8000
```

4. Open this link in the browser:

```text
http://127.0.0.1:8000
```

## Login Accounts

Admin:

```text
Email: admin@example.com
Password: admin123
```

Normal user:

```text
Email: user@example.com
Password: user123
```

## Main Folders

```text
admin/              Admin pages
auth/               Login, register, logout
classes/            PHP classes used in the project
config/             Database connection
includes/           Shared files like header, footer, auth checks, helpers
user/               Normal user pages
database.sql        Database tables and sample data
```

## Classes Used

`Database`

This class is responsible for connecting the project to MySQL. I used it so the connection code is not repeated in every page.

`GenericModel`

This is a base class that contains common database methods such as insert, update, delete, and fetch. Both `User` and `Task` use it.

`User`

This class handles user-related operations, such as registration, login, updating profile data, changing passwords, getting users, and deleting users.

`Task`

This class handles task-related operations, such as creating tasks, listing tasks, editing tasks, deleting tasks, and checking task ownership for normal users.

`ImageUploader`

This class handles uploading task images. It checks the image type and size before saving it.

## Security

- Passwords are stored using `password_hash()`.
- Login checks passwords using `password_verify()`.
- Database values are handled using prepared statements.
- Admin pages are protected using `admin_check.php`.
- User pages are protected using `auth_check.php`.
- Normal users cannot edit or delete tasks that do not belong to them.

## Features

- Register, login, and logout
- User profile update
- Create, read, update, and delete tasks
- Admin users management
- Admin can manage all tasks
- Recent pending tasks on the homepage
- Optional task image upload
- SQL file with tables and sample accounts
# web2
# web2
