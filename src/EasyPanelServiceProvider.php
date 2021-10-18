<?php

namespace EasyPanel;

use EasyPanel\Directives\{AssetDirective,
    ConfigDirective,
    CountDirective,
    EndConditionDirective,
    ImageDirective,
    isActiveDirective,
    OldDirective,
    RouteDirective,
    ScriptDirective,
    SessionDirective,
    SessionExistsDirective,
    StyleDirective,
    UrlDirective,
    UserDirective
};
use EasyPanel\Commands\{Actions\DeleteCRUD,
    Actions\Install,
    Actions\MakeCRUD,
    Actions\MakeCRUDConfig,
    Actions\Migration,
    Actions\PublishStubs,
    Actions\Reinstall,
    Actions\Uninstall,
    CRUDActions\MakeCreate,
    CRUDActions\MakeRead,
    CRUDActions\MakeSingle,
    CRUDActions\MakeUpdate,
    UserActions\DeleteAdmin,
    UserActions\GetAdmins,
    UserActions\MakeAdmin
};
use EasyPanel\Http\Livewire\Todo\Create;
use EasyPanel\Http\Livewire\Todo\Lists;
use EasyPanel\Http\Livewire\Todo\Single;
use EasyPanel\Http\Middleware\isAdmin;
use EasyPanel\Http\Middleware\LangChanger;
use EasyPanel\Support\Contract\{AuthFacade, UserProviderFacade};
use Illuminate\{Routing\Router, Support\Facades\Route, Support\ServiceProvider};
use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;

class EasyPanelServiceProvider extends ServiceProvider
{
    protected const DIRECTIVES = [
        'route' => RouteDirective::class,
        'url' => UrlDirective::class,
        'asset' => AssetDirective::class,
        'isActive' => isActiveDirective::class,
        'count' => CountDirective::class,
        'endcount' => EndConditionDirective::class,
        'user' => UserDirective::class,
        'sessionExists' => SessionExistsDirective::class,
        'endsessionExists' => EndConditionDirective::class,
        'session' => SessionDirective::class,
        'image' => ImageDirective::class,
        'style' => StyleDirective::class,
        'script' => ScriptDirective::class,
        'config' => ConfigDirective::class,
        'old' => OldDirective::class,
    ];

    public function register()
    {
        // Here we merge config with 'easy_panel' key
        $this->mergeConfigFrom(__DIR__ . '/../config/easy_panel_config.php', 'easy_panel');

        // Check the status of module
        if (!config('easy_panel.enable')) {
            return;
        }

        // Facades will be set
        $this->defineFacades();
    }

    private function defineFacades()
    {
        AuthFacade::shouldProxyTo(config('easy_panel.auth_class'));
        UserProviderFacade::shouldProxyTo(config('easy_panel.admin_provider_class'));
    }

    public function boot()
    {
        if (!config('easy_panel.enable')) {
            return;
        }

        // Here we register publishes and Commands
        if ($this->app->runningInConsole()) {
            $this->mergePublishes();
        }

        // Bind Artisan commands
        $this->bindCommands();

        // Load Views with 'admin::' prefix
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'admin');

        // Register Middleware
        $this->registerMiddlewareAlias();

        // Define routes if doesn't cached
        $this->defineRoutes();

        $this->registerDirectives();

        // Load Livewire TODOs components
        $this->loadLivewireComponent();
    }

    private function mergePublishes()
    {
        $this->publishes([__DIR__ . '/../config/easy_panel_config.php' => config_path('easy_panel.php')],
            'easy-panel-config');

        $this->publishes([__DIR__ . '/../resources/views' => resource_path('/views/vendor/admin')], 'easy-panel-views');

        $this->publishes([__DIR__ . '/../resources/assets' => public_path('/assets/admin')], 'easy-panel-styles');

        $this->publishes([__DIR__ . '/../database/migrations/2020_09_05_99999_create_todos_table.php' => base_path('/database/migrations/' . date('Y_m_d') . '_99999_create_admin_todos_table.php')],
            'easy-panel-todo');

        $this->publishes([__DIR__ . '/../database/migrations/2021_07_17_99999_create_cruds_table.php' => base_path('/database/migrations/' . date('Y_m_d') . '_99999_create_cruds_table.php')],
            'easy-panel-migration');

        $this->publishes([__DIR__ . '/../resources/lang' => resource_path('/lang')], 'easy-panel-lang');

        $this->publishes([__DIR__ . '/Commands/stub' => base_path('/stubs/panel')], 'easy-panel-stubs');
    }

    protected function registerDirectives()
    {
        foreach (static::DIRECTIVES as $directive => $class) {
            Blade::directive($directive, [$class, 'handle']);
        }
    }

    private function bindCommands()
    {
        $this->commands([
            MakeAdmin::class,
            DeleteAdmin::class,
            Install::class,
            MakeCreate::class,
            MakeUpdate::class,
            MakeRead::class,
            MakeSingle::class,
            MakeCRUD::class,
            DeleteCRUD::class,
            MakeCRUDConfig::class,
            GetAdmins::class,
            Migration::class,
            Uninstall::class,
            Reinstall::class,
            PublishStubs::class
        ]);
    }

    private function registerMiddlewareAlias()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('isAdmin', isAdmin::class);
        $router->aliasMiddleware('LangChanger', LangChanger::class);
    }

    private function defineRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $middlewares = array_merge(['web', 'isAdmin', 'LangChanger'], config('easy_panel.additional_middlewares'));

            Route::prefix(config('easy_panel.route_prefix'))
                ->middleware($middlewares)
                ->name(getRouteName() . '.')
                ->group(__DIR__ . '/routes.php')
            ;
        }
    }

    private function loadLivewireComponent()
    {
        Livewire::component('admin::livewire.todo.single', Single::class);
        Livewire::component('admin::livewire.todo.create', Create::class);
        Livewire::component('admin::livewire.todo.lists', Lists::class);

        Livewire::component('admin::livewire.crud.single', Http\Livewire\CRUD\Single::class);
        Livewire::component('admin::livewire.crud.create', Http\Livewire\CRUD\Create::class);
        Livewire::component('admin::livewire.crud.lists', Http\Livewire\CRUD\Lists::class);
    }

}
