<?php

if (!function_exists('loadEnvFile')) {
    function loadEnvFile($envPath = null)
    {
        $envPath = $envPath ?: dirname(__DIR__) . '/.env';

        if (!is_readable($envPath)) {
            return;
        }

        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);

            if ($line === '' || strpos($line, '#') === 0 || strpos($line, '=') === false) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if ($key === '' || !preg_match('/^[A-Z0-9_]+$/i', $key)) {
                continue;
            }

            if (
                (substr($value, 0, 1) === '"' && substr($value, -1) === '"') ||
                (substr($value, 0, 1) === "'" && substr($value, -1) === "'")
            ) {
                $value = substr($value, 1, -1);
            }

            $value = str_replace(["\0", "\r", "\n"], '', $value);

            putenv($key . '=' . $value);
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }
}

if (!function_exists('envRequired')) {
    function envRequired($key)
    {
        $value = envValue($key);
        if ($value === null || $value === '') {
            throw new RuntimeException('Missing required environment variable: ' . $key);
        }

        return $value;
    }
}

if (!function_exists('envValue')) {
    // Note: these values are raw config values; validate/escape according to their usage context.
    function envValue($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false && isset($_ENV[$key])) {
            $value = $_ENV[$key];
        }
        if ($value === false && isset($_SERVER[$key])) {
            $value = $_SERVER[$key];
        }

        return $value === false ? $default : $value;
    }
}
