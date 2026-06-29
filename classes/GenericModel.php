<?php

class GenericModel
{
    protected mysqli $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    protected function executeQuery(string $sql, array $params = [])
    {
        $stmt = $this->conn->prepare($sql);
        if ($params) {
            $types = $this->getParamTypes($params);
            $refs = [];

            foreach ($params as $key => $value) {
                $refs[$key] = &$params[$key];
            }

            $stmt->bind_param($types, ...$refs);
        }

        $stmt->execute();

        return $stmt;
    }

    protected function fetchOne(string $sql, array $params = [])
    {
        $stmt = $this->executeQuery($sql, $params);

        return $stmt
            ->get_result()
            ->fetch_assoc();
    }

    protected function fetchResult(string $sql, array $params = [])
    {
        $stmt = $this->executeQuery($sql, $params);

        return $stmt->get_result();
    }

    protected function insert(string $table, array $data): bool
    {
        $columns = array_keys($data);
        $placeholders = array_fill(0, count($columns), '?');

        $sql = "INSERT INTO {$table} (" . implode(', ', $columns) . ")
                VALUES (" . implode(', ', $placeholders) . ")";

        return $this->executeQuery($sql, array_values($data))->affected_rows > 0;
    }

    protected function updateById(string $table, int $id, array $data): bool
    {
        $columns = array_keys($data);
        $set = implode(
            ', ',
            array_map(
                fn($column) => "{$column} = ?",
                $columns
            )
        );

        $params = array_values($data);
        $params[] = $id;

        $sql = "UPDATE {$table} SET {$set} WHERE id = ?";

        return $this->executeQuery($sql, $params)->affected_rows >= 0;
    }

    protected function deleteById(string $table, int $id): bool
    {
        $sql = "DELETE FROM {$table} WHERE id = ?";

        return $this->executeQuery($sql, [$id])->affected_rows > 0;
    }

    private function getParamTypes(array $params): string
    {
        $types = '';

        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }

        return $types;
    }
}
