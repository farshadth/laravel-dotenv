<?php

namespace Farshadth\DotEnv;


use Farshadth\DotEnv\Exceptions\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;

class DotEnv
{
    private const ENV_FILE = '.env';

    private string $envPath;

    protected Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->envPath = base_path(self::ENV_FILE);
    }

    public function get(string $key): string
    {
        $envFile = file_get_contents($this->envPath);
        $matches = [];
        preg_match("/^{$key}=(.*)$/m", $envFile, $matches);

        return trim($matches[1] ?? '');
    }

    public function getList(array $data): array
    {
        return collect($data)->flatMap(function ($value, $key) {
            return [$value => $this->get($value)];
        })->toArray();
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

    public function setList(array $data): void
    {
        collect($data)->each(function ($value, $key) {
            $this->set($key, $value);
        });
    }

    public function delete(string $key): void
    {
        $envFile = file_get_contents($this->envPath);
        $envFile = preg_replace("/^{$key}=.*/m", '', $envFile);
        file_put_contents($this->envPath, $envFile);
    }

    public function deleteList(array $data): void
    {
        collect($data)->each(function ($value, $key) {
            $this->delete($value);
        });
    }

    public function exists(string $key): bool
    {
        $envFile = $this->getFileContent();

        return preg_match("/^{$key}=(.*)$/m", $envFile);
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

    public function copyFile(string $to, string $from = null): void
    {
        $from = $from ?? $this->envPath;
        $this->checkFileExists([$from, $to]);
        copy($from, $to);
    }

    public function moveFile(string $to, string $from = null): void
    {
        $from = $from ?? $this->envPath;
        $this->checkFileExists([$from, $to]);
        rename($from, $to);
    }

    public function setFilePath(string $envPath): void
    {
        $this->checkFileExists($envPath);
        $this->envPath = $envPath;
    }

    public function getFilePath(): string
    {
        return $this->envPath;
    }

    public function deleteFile(string $envPath = null): void
    {
        $envPath = $envPath ?? $this->envPath;
        $this->checkFileExists($envPath);
        unlink($envPath);
    }

    public function createFile(string $envPath = null): void
    {
        $envPath = $envPath ?? $this->envPath;

        if (!file_exists($envPath)) {
            touch($envPath);
        }
    }

    private function checkFileExists(mixed $envPath): void
    {
        $envPath = (array)$envPath;

        collect($envPath)->each(function ($path) {
            throw_if(!file_exists($path), new FileNotFoundException("File {$path} not found"));
        });
    }
}