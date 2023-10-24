# Laravel DotEnv 
Laravel DotEnv is a simple package for editing .env files in Laravel projects. This package allows you to read, edit, or delete values in the .env file. Additionally, you can copy or move the .env file.

# Installation
You can install this package via composer:

```php
composer require farshadth/laravel-dotenv
```

# Available Methods

>* get()
>* getList()
>* set()
>* setList()
>* delete()
>* deleteList()
>* exists()
>* getFileContent()
>* getOrSet()
>* getAndDelete()
>* copyFile()
>* moveFile()
>* setFilePath()
>* getFilePath()
>* deleteFile()
>* createFile()

# Examples

```php
use Farshadth\DotEnv\Facades\DotEnv;

DotEnv::get($key);

// get multiple keys
DotEnv::getList(['key1', 'key2'])

DotEnv::set($key, $value);

// set multiple keys and values
DotEnv::setList([
    'key1' => 'value1', 
    'key2' => 'value2'
]);

DotEnv::delete($key);

DotEnv::deleteList(['key1', 'key2'])

DotEnv::exists($key);
 
 // get the content of the .env file
DotEnv::getFileContent(); 

// get the key and if not exists
// set the key and value
DotEnv::getOrSet($key, $value); 

// get the key and delete it
DotEnv::getAndDelete($key); 

// copy the .env file to the new path
DotEnv::copyFile($to, $from);

// move the .env file to the new path
DotEnv::moveFile($to, $from);

// set another .env file path to edit that file
// instead of the default .env file
DotEnv::setFilePath($path);

// get the default .env file path,
// if another .env file is set it returns that path
DotEnv::getFilePath();

// delete the .env file
DotEnv::deleteFile($path = null);

// create an empty .env file
DotEnv::createFile($path);
``` 
