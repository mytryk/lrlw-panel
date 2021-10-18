```bash
composer require mytryk/laravel-easypanel
php artisan panel:install
php artisan panel:add [user_id]
php artisan panel:remove [user_id]
php artisan panel:migration
```

### Base Config

| Key | Type | Description |
| --- | --- | --- |
| `enable` | `bool` | Module status |
| `todo` | `bool` | TODO feature status |
| `rtl_model` | `bool` | If you want a RTL base panel set it `true` |
| `lang` | `bool` | Your default language with this format : `**_panel.json` which you have to just use `**` like `en` or `fa` |
| `user_model` | `string` | Address of User model class |
| `auth_class` | `string` | Address of user authentication class |
| `admin_provider_class` | `string` | Address of user provider class |
| `column` | `string` | That column in `users` table which determine user is admin or not |
| `redirect_unauthorized` | `string` | If user is unauthenticated it will be redirected to this address |
| `route_prefix` | `string` | Prefix of admin panel address e.g: if set it `admin` address will be : http://127.0.0.1/admin |
| `pagination_count` | `int` | Count of data which is showed in read action |
| `lazy_mode` | `bool` | Lazy mode for Real-Time Validation |
| `actions` | `array` | List of enabled action which you have created a crud config for them. |

### CRUD Component methods

| Method/Property | Return Type | Description |
| --- | --- | --- |
| `create` | `bool` | Create Action for this model |
| `update` | `bool` | Update Action for this model |
| `delete` | `bool` | Delete Action for this model |
| `with_auth` | `bool` | It will fill `user_id` key for create and update action with `auth()->user()->id` |
| `getModel` | `string` | CRUD Model |
| `searchable` | `array` | Columns in model table which you want to search in read action |
| `validationRules` | `array` | Validation rules in create and update action (it uses Laravel validation system) |
| `inputs` | `array` | Input name as key and Input type as value (for update and create action) |
| `storePaths` | `array` | Where every files of inputs will store |
| `fields` | `array` | Every data which you want to show in read action (if data is related on other tables pass it as an array, key is relation name and value is column name in related table) |

## Examples:

### Fields:

```php
    public function fields()
    {
        return ['title', 'image', 'user.name'];
    }
```

### Form Inputs:

```php
    public function inputs()
    {
        return [
            'name' => 'text',
            'email' => 'email',
            'password' => 'password',
            'avatar' => 'file'
        ];
    }
```

```php
    public function inputs()
    {
        return [
            'title' => 'text',
            'body' => 'ckeditor',
            'photo' => 'file',
            'status' => ['select' => [
                'published' => 'Publish Now!',
                'unpublished' => 'Publish Later..',
            ]],
        ];
    }
```

#### Dynamic value from a table

```php
    public function inputs()
    {
        return [
            'title' => 'text',
            'body' => 'ckeditor',
            'photo' => 'file',
            'category' => ['select' => 
                Category::where('active', true)
                    ->get()
                    ->pluck('name', 'id') // [1 => 'IT', 2 => 'History', 2 => 'Medicine']
            ],
        ];
    }
```
