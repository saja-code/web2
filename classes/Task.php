<?php

require_once 'GenericModel.php';

class Task extends GenericModel
{
    public const STATUSES = [
        'Pending',
        'In Progress',
        'Review',
        'Completed',
        'Cancelled',
    ];

    public function createTask(
        $userId,
        $title,
        $description,
        $status = 'Pending',
        $imagePath = null
    )
    {
        return $this->insert('tasks', [
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'status' => $this->normalizeStatus($status),
            'image_path' => $imagePath,
        ]);
    }

    public function getUserTasks($userId)
    {
        return $this->fetchResult(
            "SELECT * FROM tasks
             WHERE user_id = ?
             ORDER BY created_at DESC",
            [$userId]
        );
    }

    public function getAllTasks()
    {
        return $this->conn->query(
            "SELECT * FROM tasks
             ORDER BY created_at DESC"
        );
    }

    public function getAllWithUsers()
    {
        return $this->conn->query(
            "SELECT tasks.*,
                    users.first_name,
                    users.last_name
             FROM tasks
             JOIN users
             ON tasks.user_id = users.id
             ORDER BY tasks.id DESC"
        );
    }

    public function getRecentPendingTasks(int $limit = 5)
    {
        $limit = max(1, min($limit, 10));

        return $this->fetchResult(
            "SELECT tasks.*,
                    users.first_name,
                    users.last_name
             FROM tasks
             JOIN users
             ON tasks.user_id = users.id
             WHERE tasks.status = ?
             ORDER BY tasks.created_at DESC
             LIMIT {$limit}",
            ['Pending']
        );
    }

    public function deleteTask($id)
    {
        return $this->deleteById(
            'tasks',
            (int) $id
        );
    }

    public function getById($id)
    {
        return $this->fetchOne(
            "SELECT * FROM tasks WHERE id = ?",
            [(int) $id]
        );
    }

    public function getUserTask($id, $userId)
    {
        return $this->fetchOne(
            "SELECT * FROM tasks WHERE id = ? AND user_id = ?",
            [(int) $id, (int) $userId]
        );
    }

    public function updateTask(
        $id,
        $title,
        $description,
        $status,
        $imagePath = null
    )
    {
        $data = [
            'title' => $title,
            'description' => $description,
            'status' => $this->normalizeStatus($status),
        ];

        if ($imagePath !== null) {
            $data['image_path'] = $imagePath;
        }

        return $this->updateById(
            'tasks',
            (int) $id,
            $data
        );
    }

    public function normalizeStatus($status): string
    {
        if (in_array($status, self::STATUSES, true)) {
            return $status;
        }

        return 'Pending';
    }

    public static function statusBadgeClass($status): string
    {
        return match ($status) {
            'In Progress' => 'task-status-pill--progress',
            'Review' => 'task-status-pill--review',
            'Completed' => 'task-status-pill--completed',
            'Cancelled' => 'task-status-pill--cancelled',
            default => 'task-status-pill--pending',
        };
    }

    public static function statusAccentClass($status): string
    {
        return match ($status) {
            'In Progress' => 'task-card--progress',
            'Review' => 'task-card--review',
            'Completed' => 'task-card--completed',
            'Cancelled' => 'task-card--cancelled',
            default => 'task-card--pending',
        };
    }
}
