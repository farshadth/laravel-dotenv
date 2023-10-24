<?php

namespace Farshadth\DotEnv;

class DotEnv
{
    private string $envPath;

    public function __construct(string $envPath = null)
    {
        $this->envPath = $envPath ?? base_path('.env');
        throw_if(!file_exists($this->envPath), new \Exception('.env file not found'));
    }

    public function get(string $key): ?string
    {
        $content = parse_ini_file($this->envPath);

        return $content[$key] ?? null;
    }

    public function set(string $key, string $value): void
    {
        $envFile = file_get_contents($this->envPath);

        if (preg_match("/^{$key}=/m", $envFile)) {
            $envFile = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $envFile);
        } else {
            $envFile .= PHP_EOL . "{$key}={$value}";
        }

        file_put_contents($this->envPath, $envFile);
    }

    public function delete(string $key): void
    {
        $envFile = file_get_contents($this->envPath);
        $envFile = preg_replace("/^{$key}=.*/m", '', $envFile);
        file_put_contents($this->envPath, $envFile);
    }

    public function exists(string $key): bool
    {
        $content = parse_ini_file($this->envPath);

        return isset($content[$key]);
    }

    public function getFileContent(): string
    {
        return file_get_contents($this->envPath);
    }

    public function getOrSet(string $key, string $value): string
    {
        if ($this->exists($key)) {
            return $this->get($key);
        }

        $this->set($key, $value);

        return $value;
    }

    public function getAndDelete(string $key): ?string
    {
        $value = $this->get($key);
        $this->delete($key);

        return $value;
    }
}
