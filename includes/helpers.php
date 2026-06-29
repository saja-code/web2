<?php

function e($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function redirectTo(string $path): void
{
    header("Location: {$path}");
    exit();
}

function selected($current, $expected): string
{
    return $current === $expected ? 'selected' : '';
}

function uploadTaskImage(array $file): ?string
{
    require_once __DIR__ . '/../classes/ImageUploader.php';

    $uploader = new ImageUploader('../uploads/tasks', 'uploads/tasks');

    return $uploader->upload($file);
}
