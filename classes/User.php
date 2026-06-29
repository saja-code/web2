<?php

require_once 'GenericModel.php';

class User extends GenericModel
{
    public function register(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        int $isAdmin = 0
    ): bool {

        $hashedPassword = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        try {
            return $this->insert('users', [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => $hashedPassword,
                'isAdmin' => $isAdmin,
            ]);
        } catch (mysqli_sql_exception $exception) {
            return false;
        }
    }

    public function login(
        string $email,
        string $password
    ) {
        $user = $this->fetchOne(
            "SELECT * FROM users WHERE email = ?",
            [$email]
        );

        if (!$user) {
            return false;
        }

        if (
            password_verify(
                $password,
                $user['password']
            )
        ) {
            return $user;
        }

        return false;
    }

    public function getById(int $id)
    {
        return $this->fetchOne(
            "SELECT * FROM users WHERE id = ?",
            [$id]
        );
    }

    public function getAll()
    {
        return $this->conn->query(
            "SELECT * FROM users ORDER BY id DESC"
        );
    }

    public function updateUser(
        int $id,
        string $firstName,
        string $lastName,
        string $email,
        int $isAdmin
    ): bool {
        try {
            return $this->updateById('users', $id, [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'isAdmin' => $isAdmin,
            ]);
        } catch (mysqli_sql_exception $exception) {
            return false;
        }
    }

    public function deleteUser(int $id): bool
    {
        return $this->deleteById('users', $id);
    }

    public function changePassword(
        int $id,
        string $currentPassword,
        string $newPassword
    ): bool {
        $user = $this->getById($id);

        if (!$user || !password_verify($currentPassword, $user['password'])) {
            return false;
        }

        return $this->updatePassword($id, $newPassword);
    }

    public function updatePassword(int $id, string $newPassword): bool
    {
        return $this->updateById('users', $id, [
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
        ]);
    }
}
