# Yii2 Comments Module

## Installation

```bash
composer require dmstr/yii2-comments-module
```

## Configuration

Add this to your configuration

```php
[
    'modules' => [
        'comment' => [
            'class' => dmstr\comments\Module::class
        ]
    ],
    'controllerMap' => [
        'migrate' => [
            'migrationPath' => [
                '@vendor/dmstr/comments/migrations'
            ]
        ]
    ] 
];
```