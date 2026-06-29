<?php

class ImageUploader
{
    private string $uploadDir;
    private string $publicDir;
    private array $allowedTypes = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/gif' => 'gif',
        'image/webp' => 'webp',
    ];

    public function __construct(string $uploadDir, string $publicDir)
    {
        $this->uploadDir = rtrim($uploadDir, '/');
        $this->publicDir = trim($publicDir, '/');
    }

    public function upload(array $file): ?string
    {
        if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
            return null;
        }

        if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 2 * 1024 * 1024) {
            return null;
        }

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }

        $mimeType = mime_content_type($file['tmp_name']);

        if (!isset($this->allowedTypes[$mimeType])) {
            return null;
        }

        $fileName = uniqid('task_', true) . '.' . $this->allowedTypes[$mimeType];
        $targetPath = $this->uploadDir . '/' . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
            return null;
        }

        return $this->publicDir . '/' . $fileName;
    }
}
