<?php

use Future\Core\Http\Controllers\MenuController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['web']], function () {
    Route::get('admin/login', [\Future\Core\Http\Controllers\AuthController::class, 'login'])->name('login');
    Route::get('admin/logout', [\Future\Core\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('admin/forgot', [\Future\Core\Http\Controllers\AuthController::class, 'forgotPassword'])->name('forgot-password');
});
Route::group(config('future.future.route'), function () {

    route::get('profile', [\Future\Core\Http\Controllers\AuthController::class, 'profile'])->name('profile');
    $directory = app_path('Future');
    $files = File::allFiles($directory);
    $filesCollection = collect($files);

    $resourceFiles = $filesCollection->filter(function ($file) {
        return Str::endsWith($file->getFilename(), 'Resource.php');
    });

    $resourceFiles->each(function ($file) {
        $classBasename = str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathName());
        $name = str_replace('Resource', '', $classBasename);
        $name = Str::lower($name) . 's';
        $className = 'App\\Future\\' . $classBasename;
        $resource = new $className();
        $routeName = $resource->getRouteName() ?? $name;
        $only = [];
        if($resource->form){
            $only[] = 'create';
            $only[] = 'edit';
        }
        if($resource->table){
            $only[] = 'index';
        }

        Route::resource($routeName, $className)->only($only)->names($name);
        $methods = get_class_methods($className);
        $remove = ['__construct', 'getRouteName', 'index', 'create', 'store', 'show', 'edit', 'update', 'destroy',
            'callAction','middleware','validate','validateWith','authorize','getMiddleware','__call','authorizeForUser','authorizeResource','validateWithBag'];
        $methods = array_diff($methods, $remove);
        foreach ($methods as $method) {
            //lấy ra các phương thức của class public không có parameter và không phải là magic method
            if ((new ReflectionMethod($className, $method))->isPublic() && (new ReflectionMethod($className, $method))->getNumberOfParameters() == 0 && !Str::startsWith($method, '__')){
                $name = $routeName . '.' . $method;
                route::get( $routeName . '/' . $method, $className . '@' . $method)->name($name);
            }
            //lấy ra các phương thức của class public có parameter và không phải là magic method
            if ((new ReflectionMethod($className, $method))->isPublic() && (new ReflectionMethod($className, $method))->getNumberOfParameters() > 0 && !Str::startsWith($method, '__')){
                $name = $routeName . '.' . $method;
                route::get( $routeName . '/' . $method . '/{id}', $className . '@' . $method)->name($name);
            }
        }
    });
});
