CREATE DATABASE IF NOT EXISTS task_manager
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE task_manager;

CREATE USER IF NOT EXISTS 'taskuser'@'localhost' IDENTIFIED BY '123456';
GRANT ALL PRIVILEGES ON task_manager.* TO 'taskuser'@'localhost';

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    isAdmin TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS tasks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Pending',
    image_path VARCHAR(255) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_tasks_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
);

ALTER TABLE tasks
    MODIFY status VARCHAR(50) NOT NULL DEFAULT 'Pending';

ALTER TABLE tasks
    ADD COLUMN IF NOT EXISTS image_path VARCHAR(255) NULL AFTER status;

INSERT INTO users (id, first_name, last_name, email, password, isAdmin)
VALUES
    (1, 'Admin', 'User', 'admin@example.com', '$2y$10$48haFiXLbqacfXdpDDZwRuIcBtmZu6TEirJWZDMt0OvwH4hNqgBmi', 1),
    (2, 'Standard', 'User', 'user@example.com', '$2y$10$/WjwOX8QrxQ.t5VWmxpWvO9PJGdRNBoTGCTIccgQhfd5bT08W03k2', 0)
ON DUPLICATE KEY UPDATE
    first_name = VALUES(first_name),
    last_name = VALUES(last_name),
    email = VALUES(email),
    password = VALUES(password),
    isAdmin = VALUES(isAdmin);

INSERT INTO tasks (id, user_id, title, description, status)
VALUES
    (1, 2, 'Prepare Web Programming report', 'Summarize the implemented OOP classes and project structure.', 'Pending'),
    (2, 2, 'Review task dashboard', 'Check personal task CRUD operations from the standard user account.', 'In Progress'),
    (3, 1, 'Check admin panel', 'Verify admin can manage users and all system tasks.', 'Completed')
ON DUPLICATE KEY UPDATE
    user_id = VALUES(user_id),
    title = VALUES(title),
    description = VALUES(description),
    status = VALUES(status);
