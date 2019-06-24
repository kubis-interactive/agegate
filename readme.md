# AgeGate

Laravel 5.8.+ package for websites that requires age validation.

## Installation

Via Composer

``` bash
$ composer require kubis/agegate
```

After instalation, publish the config and template files for full project implementation

```bash
$ php artisan vendor:publish --provider="Kubis\AgeGate\AgeGateServiceProvider"
```

## Usage

**Filesystem**

1. `/config/agegate.php` for package configurations
2. `/resources/views/vendor/kubis/agegate/` folder to change templates.

**Middleware**

Packages offers a middleware `age-gate` to protect desired routes (or all) behind a form verification. Verification is done by package according to configuration.

Example
```php
Route::group(['middleware' => 'age-gate'], function(){
    Route::get('/', function () {
        return view('pages.homepage');
    });
});
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## [TODO] Testing 

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email daniel[@]kubisinteractive.com instead of using the issue tracker.

## Credits

- [All Contributors](contributing.md)

## License

MIT. Please see the [license file](license.md) for more information.
