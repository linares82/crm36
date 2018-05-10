## v2.2.7
 - Added capability to lock down resource from with in the resource file. This is helpful if you make code changes to a file and you want the code generator to protect the file from accidentally overriding it when using --force
 - When creating resources from existing database, the table name is stored in the resource-file. This step will save you from having to provide the table name via command line each time you create model.



## v2.2.0 - v2.2.6
### Upgrade
 - If you are upgrading from v2.0, v2.1, v2.2, v2.3 to v2.4 or v2.5 make sure you publish the vendor resource. There are some updates to the config file.
 - If you are upgrading from v2.0, v2.1 or v2.2 to v2.3 make sure you publish the vendor resource. There are some updates to the config file.
 - If you are upgrading from v2.0 or v2.1 to v2.2 make sure you publish the vendor resource. There are some changes to the templates that required to be updated.
-- If you are upgrading any version prior v2.2 follow the upgrate instruction on https://crestapps.com/laravel-code-generator/docs/2.2#upgrade-guide

### Options Changes

 - The **--fields-file** option in all command have been renamed to **--resource-file** since that file is no longer just a fields-file. 
 - This completely drop support for fields from raw string. We relay heavy on the JSON-based resource-file. The resource-file allows you to define any relations, indexes and fields all at once.
 - The **--lang-file-name** options have been changed to **--language-filename** any where it exists
 - The **--without-migration** option with **create:resources** command has been reversed. It is now **--with-migration** and should only be passed when you need a new migration created.
 - The options `--names` in the `resource-file:create`, `resource-file:append`, or `resource-file:reduce` has been renamed to `--fields`.
 - `--indexes` and `--relations` have been added to the following commands `resource-file:create`, `resource-file:append`, or `resource-file:reduce` to allow you to interact with the resource-file freely.
 -- The options `--fields`, `--indexes` and `--relations` for the `resource-file:create`, `resource-file:append`, or `resource-file:reduce` commands accept complex string to allow you to pass more values to add to the resource-file.
 -- Added `--without-languages`, `--without-controller`, `--without-form-request`, `--without-views` and `without-model` options to the `create:resources` command.


## New Features
 - Added Smart migrations! smart migrations will keep trak of all your migration and determine the next migration based on the changes made to your resource files. So when you add a field after the table is migrated, the system will generate an alter migration to allow you to add the new field to the database.
 - Ability to organize the migration using one folder per table.
 - The CodeGenerator is now able to automatically create `hasOne` and `hasMany` relations when creating resource-file from existing database using `php artisan resource-file:from-database` command
 - A new file `codegenerator_custom.php` to allow you to store all of your custom configuration was added.
 - Added the ability to delete already uploaded file in edit mode.
 - The CodeGenerator allows you to add compound index in the resource-file directly to give you the ability to reuse the setting in the future.
 - The CodeGenerator allows you to add any type of relation in the resource-file directly to give you the ability to reuse the setting in the future.
 - New configuration option was added (i.e. `irregular_plurals`) to allow you to define a non-english singular to plural words. This is helpfull if your coding using a non-english language like Spanish or Frensh. For more info go to https://github.com/CrestApps/laravel-code-generator/pull/25
 - Added `plural_names_for` config option to allow the user to set whether to create the resource in a plural or singular version.
 - Added `controller_name_postfix` config option to allow the user to change the controller post-fix or even remove it altogether.
 - Added `form_request_name_postfix` config option to allow the user to change the form-request post-fix or even remove it altogether.
 - You can use Laravel 5.5 custom validation rule directly in the validations string.
 - Added `create_move_file_method` config option to allow the user to chose not to create moveFile method on every CRUD when file-upload is required.


## Clean up
 - The `codegenerator-templates` and `codegenerate-files` folder have been moved from `/resources` to `/resources/laravel-code-generator` by default. Also, the folder `codegenerator-templates` was renamed to `templates` and the `codegenerator-files` to `sources`. Finally, a new folder (i.e system) will be generated when needed by the system in `/resources/laravel-code-generator`.



## Template Changes
 - A new stub was added controller-getdata-method-5.5.stub to allow you to simplify your validation when using Laravel 5.5! This will make your code much cleaner and simpler thanks to the new Laravel 5.5 validation.
 - The stub `controller-getdata-method.stub` has a slight change to increase the security of the generate code. instead of using `$request->all()` to get all the data from the request, we do `$request->only([...])` to only get the fields that should be needed only!
 - The variable `[% use_auth_namespace %]` in the `form-request.stub` file has been renamed to `[% use_command_placeholder %]`.
 - New template file have been added `controller-getdata-method-5.5.stub`
 - New template file have been added `controller-upload-method-5.3.stub` to improve the syntax in the moveFile() method for Laravel 5.3+.
 - The content of the `form-file-field.blade.stub` changed to show the uploaded filename.
 - The content of the `layout.stub` and `layout-with-validation.stub` were updated to show the file name for uploaded files.
 - The content of the `schema-up.stub` changed to allow for alter operation.
 - The stub `schema-down.stub` was renamed to `migration-schema-down.stub`.
 - The stub `schema-up.stub` was renamed to `migration-schema-up.stub`.
 - The `edit.blade.stub` has been modified
 - The `create.blade.stub` has been modified

## Command Changes
The following command have been renamed

 - The command create:fields-file has been renamed to resource-file:from-database
 - The command fields-file:create has been renamed to resource-file:create
 - The command fields-file:delete has been renamed to resource-file:delete
 - The command fields-file:append has been renamed to resource-file:append
 - The command fields-file:reduce has been renamed to resource-file:reduce
 - The following commands were added `php artisan migrate-all`, `php artisan migrate:rollback-all`, `php artisan migrate:reset-all`, `php artisan migrate:refresh-all` and `php artisan migrate:status-all` which should help you when chosing to turn on the `organize_migration` options


## Eliminated Options

The following options have been removed from all commands
 - --fields
 - --fillable
 - --relationships
 - --indexes
 - --foreign-keys

