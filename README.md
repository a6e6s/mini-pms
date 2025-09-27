# ToDo list
## User Model


-  Users

`
php artisan make:filament-resource User --soft-deletes --view
`

-  Projects

`
php artisan make:filament-resource Project --soft-deletes --view
`

-  Tasks

`
php artisan make:filament-resource Task --soft-deletes --view
`

-  Task Statuses

`
php artisan make:filament-resource TaskStatus --soft-deletes --view
`

-  Comments (polymorphic)

`
php artisan make:filament-resource Comment --soft-deletes --view
`

-  Activities (polymorphic log)

`
php artisan make:filament-resource Activity --soft-deletes --view
`

-  Attachments (polymorphic)

`
php artisan make:filament-resource Attachment --soft-deletes --view
`
