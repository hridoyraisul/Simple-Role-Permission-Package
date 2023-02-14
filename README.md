# Simple Role Permission

This package will provide simple role permission functionalities for the user.

## Installation

Use the package manager [composer](https://getcomposer.org/installer) to install this package.

```bash
composer require raisulhridoy/simplerolepermission
```
Publish the package configuration
```bash
php artisan vendor:publish --provider="RaisulHridoy\SimpleRolePermission\SRPServiceProvider"
```
Specify table name corresponding to the role and permission functionality in ".env" file. By default, it will be 'users' respectively and "role_id" column will be added in this table.
```bash
ROLE_WITH_TABLE=
```
For example, if you want to use "admins" table for the role functionality, then you have to specify like this in ".env" file.
```bash
ROLE_WITH_TABLE=admins
```

Run these commands to clear the cache and migrate the database.
```bash
php artisan config:clear
php artisan cache:clear
php artisan migrate
```


# Basic Usage

## Create a new role
```php
# Initialize the namespace
use RaisulHridoy\SimpleRolePermission\Http\App\SRP;

# Create a new role with name 'admin'
(new SRP)->createRole('Admin');

# Can also be catch response as
$response = (new SRP)->createRole('Admin');

# Response will be like
$response = [
    'status' => 'success',
    'message' => 'Role created successfully',
    'data' => [
        'id' => 1,
        'name' => 'Admin',
        'slug' => 'admin',
        'identifier' => 569832,
    ]
];
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
