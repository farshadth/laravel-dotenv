<?php

namespace Farshadth\DotEnv\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string get(string $key)
 * @method static void getList(array $data)
 * @method static void set(string $key, string $value)
 * @method static void setList(array $data)
 * @method static void delete(string $key)
 * @method static void deleteList(array $data)
 * @method static bool exists(string $key)
 * @method static string getFileContent()
 * @method static string getOrSet(string $key, string $value)
 * @method static string getAndDelete(string $key)
 * @method static void copyFile(string $to, string $from = null)
 * @method static void moveFile(string $to, string $from = null)
 * @method static void setFilePath(string $envPath)
 * @method static string getFilePath()
 * @method static bool deleteFile(string $envPath = null)
 * @method static bool createFile(string $envPath = null)
 *
 *
 * @see \Farshadth\DotEnv\DotEnv
 */
class DotEnv extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'DotEnv';
    }
}