<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(
[
    'prefix' => 'roles',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', 'RolesController@index')
         ->name('roles.role.index');

    Route::get('/create','RolesController@create')
         ->name('roles.role.create');

    Route::get('/show/{role}','RolesController@show')
         ->name('roles.role.show')
         ->where('id', '[0-9]+');

    Route::get('/{role}/edit','RolesController@edit')
         ->name('roles.role.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RolesController@store')
         ->name('roles.role.store');
               
    Route::put('role/{role}', 'RolesController@update')
         ->name('roles.role.update')
         ->where('id', '[0-9]+');

    Route::delete('/role/{role}','RolesController@destroy')
         ->name('roles.role.destroy')
         ->where('id', '[0-9]+');

    Route::get('/addPermission','RolesController@addPermission')
     ->name('roles.role.addPermission');

    Route::get('/lessPermission','RolesController@lessPermission')
     ->name('roles.role.lessPermission');
    
    Route::get('/addUser','RolesController@addUser')
     ->name('roles.role.addUser');

    Route::get('/lessUser','RolesController@lessUser')
     ->name('roles.role.lessUser');
    
    Route::get('/addGroup','RolesController@addGroup')
     ->name('roles.role.addGroup');

    Route::get('/lessGroup','RolesController@lessGroup')
     ->name('roles.role.lessGroup');

});

Route::group(
[
    'prefix' => 'permissions',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', 'PermissionsController@index')
         ->name('permissions.permission.index');

    Route::get('/create','PermissionsController@create')
         ->name('permissions.permission.create');

    Route::get('/show/{permission}','PermissionsController@show')
         ->name('permissions.permission.show')
         ->where('id', '[0-9]+');

    Route::get('/{permission}/edit','PermissionsController@edit')
         ->name('permissions.permission.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PermissionsController@store')
         ->name('permissions.permission.store');
               
    Route::put('permission/{permission}', 'PermissionsController@update')
         ->name('permissions.permission.update')
         ->where('id', '[0-9]+');

    Route::delete('/permission/{permission}','PermissionsController@destroy')
         ->name('permissions.permission.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'permission_groups',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', 'PermissionGroupsController@index')
         ->name('permission_groups.permission_group.index');

    Route::get('/create','PermissionGroupsController@create')
         ->name('permission_groups.permission_group.create');

    Route::get('/show/{permissionGroup}','PermissionGroupsController@show')
         ->name('permission_groups.permission_group.show')
         ->where('id', '[0-9]+');

    Route::get('/{permissionGroup}/edit','PermissionGroupsController@edit')
         ->name('permission_groups.permission_group.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PermissionGroupsController@store')
         ->name('permission_groups.permission_group.store');
               
    Route::put('permission_group/{permissionGroup}', 'PermissionGroupsController@update')
         ->name('permission_groups.permission_group.update')
         ->where('id', '[0-9]+');

    Route::delete('/permission_group/{permissionGroup}','PermissionGroupsController@destroy')
         ->name('permission_groups.permission_group.destroy')
         ->where('id', '[0-9]+');
    
    Route::get('/addPermission','PermissionGroupsController@addPermission')
         ->name('permission_groups.permission_group.addPermission');
    
    Route::get('/lessPermission','PermissionGroupsController@lessPermission')
         ->name('permission_groups.permission_group.lessPermission');
    
    Route::get('/addRole','PermissionGroupsController@addRole')
         ->name('permission_groups.permission_group.addRole');
    
    Route::get('/lessRole','PermissionGroupsController@lessRole')
         ->name('permission_groups.permission_group.lessRole');

});

Route::group(
[
    'prefix' => 'menus',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', 'MenusController@index')
         ->name('menus.menu.index');

    Route::get('/create','MenusController@create')
         ->name('menus.menu.create');

    Route::get('/show/{menu}','MenusController@show')
         ->name('menus.menu.show')
         ->where('id', '[0-9]+');

    Route::get('/{menu}/edit','MenusController@edit')
         ->name('menus.menu.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'MenusController@store')
         ->name('menus.menu.store');
               
    Route::put('menu/{menu}', 'MenusController@update')
         ->name('menus.menu.update')
         ->where('id', '[0-9]+');

    Route::delete('/menu/{menu}','MenusController@destroy')
         ->name('menus.menu.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'users',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', [
        'uses'=>'UsersController@index',
        //'middleware'=>'permission:users.user.index',
        'as'=>'users.user.index'
    ])->middleware('auth');
         
    Route::get('/create',[
        'uses'=>'UsersController@create',
        //'middleware'=>'role:users.user.create',
        'as'=>'users.user.create'
    ])->middleware('auth');

    Route::get('/show/{user}',[
        'uses'=>'UsersController@show',
        //'middleware'=>'permission:users.user.show',
        'as'=>'users.user.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{user}/edit',[
        'uses'=>'UsersController@edit',
        //'middleware'=>'permission:users.user.edit',
        'as'=>'users.user.edit'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::get('/{user}/editPerfil',[
        'uses'=>'UsersController@editPerfil',
        //'middleware'=>'permission:users.user.editPerfil',
        'as'=>'users.user.editPerfil'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'UsersController@store',
        //'middleware'=>'permission:users.user.store',
        'as'=>'users.user.store'
    ])->middleware('auth');
               
    Route::put('user/{user}', [
        'uses'=>'UsersController@update',
        //'middleware'=>'permission:users.user.update',
        'as'=>'users.user.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/user/{user}',[
        'uses'=>'UsersController@destroy',
        //'middleware'=>'permission:users.user.destroy',
        'as'=>'users.user.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/addRol',[
        'uses'=>'UsersController@addRol',
        //'middleware'=>'permission:users.user.addRol',
        'as'=>'users.user.addRol'
    ])->middleware('auth');
    
    Route::get('/lessRol',[
        'uses'=>'UsersController@lessRol',
        //'middleware'=>'permission:users.user.lessRol',
        'as'=>'users.user.lessRol'
    ])->middleware('auth');
});

Route::group(
[
    'prefix' => 'oportunity_labels',
    'middleware'=>'role:superadmin',
], function () {

    Route::get('/', [
        'uses'=>'OportunityLabelsController@index',
        'middleware'=>'permission:oportunity_labels.oportunity_label.index',
        'as'=>'oportunity_labels.oportunity_label.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'OportunityLabelsController@create',
        'middleware'=> 'permission:oportunity_labels.oportunity_label.create',
        'as'=>'oportunity_labels.oportunity_label.create'
    ])->middleware('auth');

    Route::get('/show/{oportunityLabel}',[
        'uses'=>'OportunityLabelsController@show',
        'middleware'=>'permission:oportunity_labels.oportunity_label.show',
        'as'=>'oportunity_labels.oportunity_label.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{oportunityLabel}/edit',[
        'uses'=>'OportunityLabelsController@edit',
        'middleware'=>'permission:oportunity_labels.oportunity_label.edit',
        'as'=>'oportunity_labels.oportunity_label.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'OportunityLabelsController@store',
        'middleware'=>'permission:oportunity_labels.oportunity_label.store',
        'as'=>'oportunity_labels.oportunity_label.store'
    ])->middleware('auth');
               
    Route::put('oportunity_label/{oportunityLabel}', [
        'uses'=>'OportunityLabelsController@update',
        'middleware'=>'permission:oportunity_labels.oportunity_label.update',
        'as'=>'oportunity_labels.oportunity_label.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/oportunity_label/{oportunityLabel}',[
        'uses'=>'OportunityLabelsController@destroy',
        'middleware'=>'permission:oportunity_labels.oportunity_label.destroy',
        'as'=>'oportunity_labels.oportunity_label.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'oportunities',
], function () {

    Route::get('/', [
        'uses'=>'OportunitiesController@index',
        'middleware'=>'permission:oportunities.oportunity.index',
        'as'=>'oportunities.oportunity.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'OportunitiesController@create',
        'middleware'=> 'permission:oportunities.oportunity.create',
        'as'=>'oportunities.oportunity.create'
    ])->middleware('auth');

    Route::get('/show/{oportunity}',[
        'uses'=>'OportunitiesController@show',
        'middleware'=>'permission:oportunities.oportunity.show',
        'as'=>'oportunities.oportunity.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{oportunity}/edit',[
        'uses'=>'OportunitiesController@edit',
        'middleware'=>'permission:oportunities.oportunity.edit',
        'as'=>'oportunities.oportunity.edit'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::get('/seleccionarCliente',[
        'uses'=>'OportunitiesController@seleccionarCliente',
        'middleware'=>'permission:oportunities.oportunity.seleccionarCliente',
        'as'=>'oportunities.oportunity.seleccionarCliente'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/seleccionarProducto',[
        'uses'=>'OportunitiesController@seleccionarProducto',
        'middleware'=>'permission:oportunities.oportunity.seleccionarProducto',
        'as'=>'oportunities.oportunity.seleccionarProducto'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::post('/', [
        'uses'=>'OportunitiesController@store',
        'middleware'=>'permission:oportunities.oportunity.store',
        'as'=>'oportunities.oportunity.store'
    ])->middleware('auth');
               
    Route::put('oportunity/{oportunity}', [
        'uses'=>'OportunitiesController@update',
        'middleware'=>'permission:oportunities.oportunity.update',
        'as'=>'oportunities.oportunity.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/oportunity/{oportunity}',[
        'uses'=>'OportunitiesController@destroy',
        'middleware'=>'permission:oportunities.oportunity.destroy',
        'as'=>'oportunities.oportunity.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    
    Route::post('/oportunity/enviarCorreo', [
        'uses'=>'OportunitiesController@enviarCorreo',
        //'middleware'=>'permission:oportunities.oportunity.store',
        'as'=>'oportunities.oportunity.enviarCorreo'
    ])->middleware('auth');
});

Route::group(
[
    'prefix' => 'oportunity_sts',
], function () {

    Route::get('/', [
        'uses'=>'OportunityStsController@index',
        'middleware'=>'permission:oportunity_sts.oportunity_st.index',
        'as'=>'oportunity_sts.oportunity_st.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'OportunityStsController@create',
        'middleware'=> 'permission:oportunity_sts.oportunity_st.create',
        'as'=>'oportunity_sts.oportunity_st.create'
    ])->middleware('auth');

    Route::get('/show/{oportunitySt}',[
        'uses'=>'OportunityStsController@show',
        'middleware'=>'permission:oportunity_sts.oportunity_st.show',
        'as'=>'oportunity_sts.oportunity_st.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{oportunitySt}/edit',[
        'uses'=>'OportunityStsController@edit',
        'middleware'=>'permission:oportunity_sts.oportunity_st.edit',
        'as'=>'oportunity_sts.oportunity_st.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'OportunityStsController@store',
        'middleware'=>'permission:oportunity_sts.oportunity_st.store',
        'as'=>'oportunity_sts.oportunity_st.store'
    ])->middleware('auth');
               
    Route::put('oportunity_st/{oportunitySt}', [
        'uses'=>'OportunityStsController@update',
        'middleware'=>'permission:oportunity_sts.oportunity_st.update',
        'as'=>'oportunity_sts.oportunity_st.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/oportunity_st/{oportunitySt}',[
        'uses'=>'OportunityStsController@destroy',
        'middleware'=>'permission:oportunity_sts.oportunity_st.destroy',
        'as'=>'oportunity_sts.oportunity_st.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'estados',
], function () {

    Route::get('/', [
        'uses'=>'EstadosController@index',
        'middleware'=>'permission:estados.estado.index',
        'as'=>'estados.estado.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EstadosController@create',
        'middleware'=> 'permission:estados.estado.create',
        'as'=>'estados.estado.create'
    ])->middleware('auth');

    Route::get('/show/{estado}',[
        'uses'=>'EstadosController@show',
        'middleware'=>'permission:estados.estado.show',
        'as'=>'estados.estado.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{estado}/edit',[
        'uses'=>'EstadosController@edit',
        'middleware'=>'permission:estados.estado.edit',
        'as'=>'estados.estado.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EstadosController@store',
        'middleware'=>'permission:estados.estado.store',
        'as'=>'estados.estado.store'
    ])->middleware('auth');
               
    Route::put('estado/{estado}', [
        'uses'=>'EstadosController@update',
        'middleware'=>'permission:estados.estado.update',
        'as'=>'estados.estado.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/estado/{estado}',[
        'uses'=>'EstadosController@destroy',
        'middleware'=>'permission:estados.estado.destroy',
        'as'=>'estados.estado.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    Route::get('/getCmbMunicipios', array(
        'as' => 'municipios.getCmbMunicipios',
        'uses' => 'EstadosController@getCmbMunicipios')
    )->middleware('auth');
});

Route::group(
[
    'prefix' => 'municipios',
], function () {

    Route::get('/', [
        'uses'=>'MunicipiosController@index',
        'middleware'=>'permission:municipios.municipio.index',
        'as'=>'municipios.municipio.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'MunicipiosController@create',
        'middleware'=> 'permission:municipios.municipio.create',
        'as'=>'municipios.municipio.create'
    ])->middleware('auth');

    Route::get('/show/{municipio}',[
        'uses'=>'MunicipiosController@show',
        'middleware'=>'permission:municipios.municipio.show',
        'as'=>'municipios.municipio.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{municipio}/edit',[
        'uses'=>'MunicipiosController@edit',
        'middleware'=>'permission:municipios.municipio.edit',
        'as'=>'municipios.municipio.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'MunicipiosController@store',
        'middleware'=>'permission:municipios.municipio.store',
        'as'=>'municipios.municipio.store'
    ])->middleware('auth');
               
    Route::put('municipio/{municipio}', [
        'uses'=>'MunicipiosController@update',
        'middleware'=>'permission:municipios.municipio.update',
        'as'=>'municipios.municipio.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/municipio/{municipio}',[
        'uses'=>'MunicipiosController@destroy',
        'middleware'=>'permission:municipios.municipio.destroy',
        'as'=>'municipios.municipio.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
    
});

Route::group(
[
    'prefix' => 'customers',
], function () {

    Route::get('/', [
        'uses'=>'CustomersController@index',
        'middleware'=>'permission:customers.customer.index',
        'as'=>'customers.customer.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CustomersController@create',
        'middleware'=> 'permission:customers.customer.create',
        'as'=>'customers.customer.create'
    ])->middleware('auth');
    
    Route::get('/create2',[
        'uses'=>'CustomersController@customersOportunityCreate',
        'middleware'=> 'permission:customers.oportunity.create',
        'as'=>'customers.oportunity.create'
    ])->middleware('auth');

    Route::get('/show/{customer}',[
        'uses'=>'CustomersController@show',
        'middleware'=>'permission:customers.customer.show',
        'as'=>'customers.customer.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{customer}/edit',[
        'uses'=>'CustomersController@edit',
        'middleware'=>'permission:customers.customer.edit',
        'as'=>'customers.customer.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CustomersController@store',
        'middleware'=>'permission:customers.customer.store',
        'as'=>'customers.customer.store'
    ])->middleware('auth');
    
    Route::post('/', [
        'uses'=>'CustomersController@customersOportunityStore',
        'middleware'=>'permission:customers.oportunity.store',
        'as'=>'customers.oportunity.store'
    ])->middleware('auth');
    
    Route::post('/change', [
        'uses'=>'CustomersController@customersOportunityChange',
        'middleware'=>'permission:customers.oportunity.change',
        'as'=>'customers.oportunity.change'
    ])->middleware('auth');
               
    Route::put('customer/{customer}', [
        'uses'=>'CustomersController@update',
        'middleware'=>'permission:customers.customer.update',
        'as'=>'customers.customer.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/customer/{customer}',[
        'uses'=>'CustomersController@destroy',
        'middleware'=>'permission:customers.customer.destroy',
        'as'=>'customers.customer.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'products',
], function () {

    Route::get('/', [
        'uses'=>'ProductsController@index',
        'middleware'=>'permission:products.product.index',
        'as'=>'products.product.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ProductsController@create',
        'middleware'=> 'permission:products.product.create',
        'as'=>'products.product.create'
    ])->middleware('auth');

    Route::post('/change', [
        'uses'=>'ProductsController@productsOportunityChange',
        'middleware'=>'permission:products.oportunity.change',
        'as'=>'products.oportunity.change'
    ])->middleware('auth');
    
    Route::get('/show/{product}',[
        'uses'=>'ProductsController@show',
        'middleware'=>'permission:products.product.show',
        'as'=>'products.product.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{product}/edit',[
        'uses'=>'ProductsController@edit',
        'middleware'=>'permission:products.product.edit',
        'as'=>'products.product.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ProductsController@store',
        'middleware'=>'permission:products.product.store',
        'as'=>'products.product.store'
    ])->middleware('auth');
               
    Route::put('product/{product}', [
        'uses'=>'ProductsController@update',
        'middleware'=>'permission:products.product.update',
        'as'=>'products.product.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/product/{product}',[
        'uses'=>'ProductsController@destroy',
        'middleware'=>'permission:products.product.destroy',
        'as'=>'products.product.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'type_products',
], function () {

    Route::get('/', [
        'uses'=>'TypeProductsController@index',
        'middleware'=>'permission:type_products.type_product.index',
        'as'=>'type_products.type_product.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'TypeProductsController@create',
        'middleware'=> 'permission:type_products.type_product.create',
        'as'=>'type_products.type_product.create'
    ])->middleware('auth');

    Route::get('/show/{typeProduct}',[
        'uses'=>'TypeProductsController@show',
        'middleware'=>'permission:type_products.type_product.show',
        'as'=>'type_products.type_product.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{typeProduct}/edit',[
        'uses'=>'TypeProductsController@edit',
        'middleware'=>'permission:type_products.type_product.edit',
        'as'=>'type_products.type_product.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'TypeProductsController@store',
        'middleware'=>'permission:type_products.type_product.store',
        'as'=>'type_products.type_product.store'
    ])->middleware('auth');
               
    Route::put('type_product/{typeProduct}', [
        'uses'=>'TypeProductsController@update',
        'middleware'=>'permission:type_products.type_product.update',
        'as'=>'type_products.type_product.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/type_product/{typeProduct}',[
        'uses'=>'TypeProductsController@destroy',
        'middleware'=>'permission:type_products.type_product.destroy',
        'as'=>'type_products.type_product.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'params',
], function () {

    Route::get('/', [
        'uses'=>'ParamsController@index',
        'middleware'=>'permission:params.param.index',
        'as'=>'params.param.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'ParamsController@create',
        'middleware'=> 'permission:params.param.create',
        'as'=>'params.param.create'
    ])->middleware('auth');

    Route::get('/show/{param}',[
        'uses'=>'ParamsController@show',
        'middleware'=>'permission:params.param.show',
        'as'=>'params.param.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{param}/edit',[
        'uses'=>'ParamsController@edit',
        'middleware'=>'permission:params.param.edit',
        'as'=>'params.param.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'ParamsController@store',
        'middleware'=>'permission:params.param.store',
        'as'=>'params.param.store'
    ])->middleware('auth');
               
    Route::put('param/{param}', [
        'uses'=>'ParamsController@update',
        'middleware'=>'permission:params.param.update',
        'as'=>'params.param.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/param/{param}',[
        'uses'=>'ParamsController@destroy',
        'middleware'=>'permission:params.param.destroy',
        'as'=>'params.param.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'notes',
], function () {

    Route::get('/', [
        'uses'=>'NotesController@index',
        'middleware'=>'permission:notes.note.index',
        'as'=>'notes.note.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'NotesController@create',
        'middleware'=> 'permission:notes.note.create',
        'as'=>'notes.note.create'
    ])->middleware('auth');

    Route::get('/show/{note}',[
        'uses'=>'NotesController@show',
        'middleware'=>'permission:notes.note.show',
        'as'=>'notes.note.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{note}/edit',[
        'uses'=>'NotesController@edit',
        'middleware'=>'permission:notes.note.edit',
        'as'=>'notes.note.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'NotesController@store',
        'middleware'=>'permission:notes.note.store',
        'as'=>'notes.note.store'
    ])->middleware('auth');
               
    Route::post('note/{note}', [
        'uses'=>'NotesController@update',
        'middleware'=>'permission:notes.note.update',
        'as'=>'notes.note.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/note/{note}',[
        'uses'=>'NotesController@destroy',
        'middleware'=>'permission:notes.note.destroy',
        'as'=>'notes.note.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'alerts',
], function () {

    Route::get('/', [
        'uses'=>'AlertsController@index',
        'middleware'=>'permission:alerts.alert.index',
        'as'=>'alerts.alert.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'AlertsController@create',
        'middleware'=> 'permission:alerts.alert.create',
        'as'=>'alerts.alert.create'
    ])->middleware('auth');

    Route::get('/show/{alert}',[
        'uses'=>'AlertsController@show',
        'middleware'=>'permission:alerts.alert.show',
        'as'=>'alerts.alert.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{alert}/edit',[
        'uses'=>'AlertsController@edit',
        'middleware'=>'permission:alerts.alert.edit',
        'as'=>'alerts.alert.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'AlertsController@store',
        'middleware'=>'permission:alerts.alert.store',
        'as'=>'alerts.alert.store'
    ])->middleware('auth');
               
    Route::put('alert/{alert}', [
        'uses'=>'AlertsController@update',
        'middleware'=>'permission:alerts.alert.update',
        'as'=>'alerts.alert.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/alert/{alert}',[
        'uses'=>'AlertsController@destroy',
        'middleware'=>'permission:alerts.alert.destroy',
        'as'=>'alerts.alert.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'eventos',
], function () {

    Route::get('/', [
        'uses'=>'EventosController@index',
        'middleware'=>'permission:eventos.evento.index',
        'as'=>'eventos.evento.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'EventosController@create',
        'middleware'=> 'permission:eventos.evento.create',
        'as'=>'eventos.evento.create'
    ])->middleware('auth');

    Route::get('/show/{evento}',[
        'uses'=>'EventosController@show',
        'middleware'=>'permission:eventos.evento.show',
        'as'=>'eventos.evento.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{evento}/edit',[
        'uses'=>'EventosController@edit',
        'middleware'=>'permission:eventos.evento.edit',
        'as'=>'eventos.evento.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'EventosController@store',
        'middleware'=>'permission:eventos.evento.store',
        'as'=>'eventos.evento.store'
    ])->middleware('auth');
               
    Route::put('evento/{evento}', [
        'uses'=>'EventosController@update',
        'middleware'=>'permission:eventos.evento.update',
        'as'=>'eventos.evento.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/evento/{evento}',[
        'uses'=>'EventosController@destroy',
        'middleware'=>'permission:eventos.evento.destroy',
        'as'=>'eventos.evento.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'customer_notes',
], function () {

    Route::get('/', [
        'uses'=>'CustomerNotesController@index',
        'middleware'=>'permission:customer_notes.customer_note.index',
        'as'=>'customer_notes.customer_note.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'CustomerNotesController@create',
        'middleware'=> 'permission:customer_notes.customer_note.create',
        'as'=>'customer_notes.customer_note.create'
    ])->middleware('auth');

    Route::get('/show/{customerNote}',[
        'uses'=>'CustomerNotesController@show',
        'middleware'=>'permission:customer_notes.customer_note.show',
        'as'=>'customer_notes.customer_note.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{customerNote}/edit',[
        'uses'=>'CustomerNotesController@edit',
        'middleware'=>'permission:customer_notes.customer_note.edit',
        'as'=>'customer_notes.customer_note.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'CustomerNotesController@store',
        'middleware'=>'permission:customer_notes.customer_note.store',
        'as'=>'customer_notes.customer_note.store'
    ])->middleware('auth');
               
    Route::put('customer_note/{customerNote}', [
        'uses'=>'CustomerNotesController@update',
        'middleware'=>'permission:customer_notes.customer_note.update',
        'as'=>'customer_notes.customer_note.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/customer_note/{customerNote}',[
        'uses'=>'CustomerNotesController@destroy',
        'middleware'=>'permission:customer_notes.customer_note.destroy',
        'as'=>'customer_notes.customer_note.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'tasks',
], function () {

    Route::get('/', [
        'uses'=>'TasksController@index',
        'middleware'=>'permission:tasks.task.index',
        'as'=>'tasks.task.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'TasksController@create',
        'middleware'=> 'permission:tasks.task.create',
        'as'=>'tasks.task.create'
    ])->middleware('auth');

    Route::get('/show/{task}',[
        'uses'=>'TasksController@show',
        'middleware'=>'permission:tasks.task.show',
        'as'=>'tasks.task.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{task}/edit',[
        'uses'=>'TasksController@edit',
        'middleware'=>'permission:tasks.task.edit',
        'as'=>'tasks.task.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'TasksController@store',
        'middleware'=>'permission:tasks.task.store',
        'as'=>'tasks.task.store'
    ])->middleware('auth');
               
    Route::put('task/{task}', [
        'uses'=>'TasksController@update',
        'middleware'=>'permission:tasks.task.update',
        'as'=>'tasks.task.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/task/{task}',[
        'uses'=>'TasksController@destroy',
        'middleware'=>'permission:tasks.task.destroy',
        'as'=>'tasks.task.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'related_tasks',
], function () {

    Route::get('/', [
        'uses'=>'RelatedTasksController@index',
        'middleware'=>'permission:related_tasks.related_task.index',
        'as'=>'related_tasks.related_task.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'RelatedTasksController@create',
        'middleware'=> 'permission:related_tasks.related_task.create',
        'as'=>'related_tasks.related_task.create'
    ])->middleware('auth');

    Route::get('/show/{relatedTask}',[
        'uses'=>'RelatedTasksController@show',
        'middleware'=>'permission:related_tasks.related_task.show',
        'as'=>'related_tasks.related_task.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{relatedTask}/edit',[
        'uses'=>'RelatedTasksController@edit',
        'middleware'=>'permission:related_tasks.related_task.edit',
        'as'=>'related_tasks.related_task.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'RelatedTasksController@store',
        'middleware'=>'permission:related_tasks.related_task.store',
        'as'=>'related_tasks.related_task.store'
    ])->middleware('auth');
               
    Route::put('related_task/{relatedTask}', [
        'uses'=>'RelatedTasksController@update',
        'middleware'=>'permission:related_tasks.related_task.update',
        'as'=>'related_tasks.related_task.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/related_task/{relatedTask}',[
        'uses'=>'RelatedTasksController@destroy',
        'middleware'=>'permission:related_tasks.related_task.destroy',
        'as'=>'related_tasks.related_task.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'predefined_tasks',
], function () {

    Route::get('/', [
        'uses'=>'PredefinedTasksController@index',
        'middleware'=>'permission:predefined_tasks.predefined_task.index',
        'as'=>'predefined_tasks.predefined_task.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'PredefinedTasksController@create',
        'middleware'=> 'permission:predefined_tasks.predefined_task.create',
        'as'=>'predefined_tasks.predefined_task.create'
    ])->middleware('auth');

    Route::get('/show/{predefinedTask}',[
        'uses'=>'PredefinedTasksController@show',
        'middleware'=>'permission:predefined_tasks.predefined_task.show',
        'as'=>'predefined_tasks.predefined_task.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{predefinedTask}/edit',[
        'uses'=>'PredefinedTasksController@edit',
        'middleware'=>'permission:predefined_tasks.predefined_task.edit',
        'as'=>'predefined_tasks.predefined_task.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'PredefinedTasksController@store',
        'middleware'=>'permission:predefined_tasks.predefined_task.store',
        'as'=>'predefined_tasks.predefined_task.store'
    ])->middleware('auth');
               
    Route::put('predefined_task/{predefinedTask}', [
        'uses'=>'PredefinedTasksController@update',
        'middleware'=>'permission:predefined_tasks.predefined_task.update',
        'as'=>'predefined_tasks.predefined_task.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/predefined_task/{predefinedTask}',[
        'uses'=>'PredefinedTasksController@destroy',
        'middleware'=>'permission:predefined_tasks.predefined_task.destroy',
        'as'=>'predefined_tasks.predefined_task.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});

Route::group(
[
    'prefix' => 'files_customers',
], function () {

    Route::get('/', [
        'uses'=>'FilesCustomersController@index',
        'middleware'=>'permission:files_customers.files_customer.index',
        'as'=>'files_customers.files_customer.index'
    ])->middleware('auth');

    Route::get('/create',[
        'uses'=>'FilesCustomersController@create',
        'middleware'=> 'permission:files_customers.files_customer.create',
        'as'=>'files_customers.files_customer.create'
    ])->middleware('auth');

    Route::get('/show/{filesCustomer}',[
        'uses'=>'FilesCustomersController@show',
        'middleware'=>'permission:files_customers.files_customer.show',
        'as'=>'files_customers.files_customer.show'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::get('/{filesCustomer}/edit',[
        'uses'=>'FilesCustomersController@edit',
        'middleware'=>'permission:files_customers.files_customer.edit',
        'as'=>'files_customers.files_customer.edit'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::post('/', [
        'uses'=>'FilesCustomersController@store',
        'middleware'=>'permission:files_customers.files_customer.store',
        'as'=>'files_customers.files_customer.store'
    ])->middleware('auth');
    
    Route::post('/files_customer/cargaArchivoCorreo', [
        'uses'=>'FilesCustomersController@cargaArchivoCorreo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivoCorreo',
        'as'=>'files_customers.files_customer.cargaArchivoCorreo'
    ])->middleware('auth');
    
    Route::get('/files_customer/descargarArchivo', [
        'uses'=>'FilesCustomersController@descargarArchivo',
        //'middleware'=>'permission:files_customers.files_customer.cargaArchivoCorreo',
        'as'=>'files_customers.files_customer.descargaArchivo'
    ])->middleware('auth');
               
    Route::put('files_customer/{filesCustomer}', [
        'uses'=>'FilesCustomersController@update',
        'middleware'=>'permission:files_customers.files_customer.update',
        'as'=>'files_customers.files_customer.update'
    ])->middleware('auth')->where('id', '[0-9]+');

    Route::delete('/files_customer/{filesCustomer}',[
        'uses'=>'FilesCustomersController@destroy',
        'middleware'=>'permission:files_customers.files_customer.destroy',
        'as'=>'files_customers.files_customer.destroy'
    ])->middleware('auth')->where('id', '[0-9]+');
});
