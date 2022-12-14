![Screenshot of VILT](https://raw.githubusercontent.com/3x1io/vilt-admin/main/art/stack.jpeg)

# VILT Framework

VILT stack admin panel

## Install

```bash
composer require queents/base-module
```

Publish Module vendors

```bash
php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"
```

Add Modules to PSR-4 on `composer.json` 

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Modules\\": "Modules/"
        }
    }
}
```
Tip: don't forget to run `composer dump-autoload` afterwards

create a `modules_statuses.json` file on the base folder and inside it add

```json
{
    "Base": true,
    "Roles": true,
    "Generator": true
}
```

Now Install VILT

```bash
php artisan vilt:install
```

run NPM or YARN to install and build assets

```bash
npm i & npm run build
```

OR

```bash
yarn & yarn build
```

Generate Username and Password for Dashboard

```bash
php artisan roles:install
```

## Support

you can join our discord server to get support [VILT Admin](https://discord.gg/HUNYbgKDdx)

## Docs

look to the new docs of v4.00 on my website [Docs](https://vilt.3x1.io/docs/)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [3x1](https://github.com/3x1io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

