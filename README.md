# Simple Role Permission Package for Laravel Application

This is a lightweight and easy-to-use Laravel package that allows you to manage user roles and permissions in your application with minimal effort. With this package, you can use lots of pre-defined methods for implementing roles and permissions, as well as assign roles to users and check their permissions. This package provides a simple and intuitive way of coding that makes it easy to integrate with your existing application. It also comes with built-in middleware that you can use to protect routes based on user roles and permissions. Whether you're building a small application or a large-scale system, "Simple Role Permission" provides a flexible and scalable solution for managing user roles and permissions. It's perfect for developers who want a simple and lightweight package that gets the job done without any unnecessary complexity.

## Installation

Use the package manager [composer](https://getcomposer.org/installer) to install this package.

```bash
composer require raisulhridoy/simplerolepermission
```
Add the service provider in config/app.php file in the providers array as below:
```bash
RaisulHridoy\SimpleRolePermission\SRPServiceProvider::class,
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
```php
# Initialize the namespace
use RaisulHridoy\SimpleRolePermission\Http\App\SRP;
```

## Create a new role
```php
# Create a new role with name 'admin'
SRP::createRole('Admin');

# Can also be catch response as
$response = SRP::createRole('Admin');

# Response will be like
$response = [
    'status' => 'success',
    'message' => 'Role created successfully',
    'data' => [
        'id' => 1, // this is the role-ID will be the primary-key
        'name' => 'Admin',
        'slug' => 'admin',
        'identifier' => 569832,
    ]
];
```

## Remove a role
```php
# Remove an existing role with role-ID like example below
SRP::deleteRole(1);

# Can also catch response as
$response = SRP::deleteRole(1);
```

## Update a role
```php
# update role by adding params role-ID & role-name like example below
SRP::updateRole(1,'Admin');

# Can also catch response as
$response = SRP::updateRole(1,'Admin');
```

## View all roles
```php
# Get all roles from database without paginate
$response = SRP::allRoles();

# Get all roles with paginate by adding params
$response = SRP::allRoles(10);
```

## View all permissions
```php
# Get all permissions from database without paginate
$response = SRP::allPermissions();

# Get all permissions with paginate by adding params
$response = SRP::allPermissions(10);
```

## Sync Permission for Role
```php
# Update permissions for a specific role by role-ID & array of permission-ID as params
SRP::syncPermission(1, [2,3,4]);
```

## Assigned Permissions for User
```php
# Get assigned permissions details collection by role-ID in param
$response = SRP::assignedPermissions(1);

# Get assigned permissions details collection as group by role-ID in param
$response = SRP::assignedPermissionsGroup(1);

# Get assigned permissions-ID as array by role-ID in param
$response = SRP::assignedPermissionIDs(1);
```

## Create New Permission
```php
# Create new permission by adding permission-name in param like below
SRP::createPermission('Permission Name');

# Create new permission with group by adding extra param like below
SRP::createPermission('Permission Name','Permission Group');
```

## Update Permission
```php
# Update permission by adding permission-ID, permission-name in param like below
SRP::updatePermission(1,'Permission Name');

# Create new permission with group by adding extra param like below
SRP::updatePermission(1,'Permission Name','Permission Group');
```

## Remove Permission
```php
# Remove a permission by adding permission-ID in param like below
SRP::deletePermission(1);
```

## Check User Accessibility
```php
# Checking accessibility with permission-name & role-ID
SRP::checkPermissionByName('Permission Name',1);

# Checking accessibility with permission-ID & role-ID
SRP::checkPermissionByID(2,1);
```

## Check User Accessibility in Blade
```php
# Checking accessibility with blade directive with param role name or role slug & permission name or permission group like below
@cando('Admin','Dashboard')
@endcando
```


## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

MIT License

Copyright (c) 2023 || Developed by [Raisul Islam Hridoy](https://bd.linkedin.com/in/raisulhridoy)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

## Publisher
### Raisul Hridoy
###### Email: raisulhridoy@hotmail.com
###### Phone: (+880)-1686-851584
