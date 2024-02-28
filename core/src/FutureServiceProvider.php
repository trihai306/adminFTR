<?php

namespace Future\Core;

use Exception;
use Future\Form\Future\BaseForm;
use Future\Table\Future\BaseTable;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Livewire\Component;
use Livewire\Livewire;

class FutureServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->autoRegisterLivewireComponents(app_path('Future'));
    }

    protected function autoRegisterLivewireComponents($directory)
    {
        $namespace = 'App\Future';
        try {
            $files = File::allFiles($directory);
            $aliases = [];
            foreach ($files as $file) {
                $componentPath = $file->getRelativePathName();
                $classBasename = str_replace(['/', '.php'], ['\\', ''], $componentPath);
                $className = $namespace . '\\' . $classBasename;
                if (is_subclass_of($className, BaseForm::class) || is_subclass_of($className, BaseTable::class) || is_subclass_of($className, Component::class)) {
                    $alias = str_replace('\\', '.', $classBasename);
                    Livewire::component($alias, $className);
                }
            }
        } catch (Exception $e) {
            // do nothing
        }
    }
}
