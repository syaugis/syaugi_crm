<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route = Route::current();
        $actionName = $route->getActionMethod();
        $controller = class_basename($route->getController());
        $model = str_replace('Controller', '', $controller);

        $ability = $this->getAbilityFromAction($actionName);
        $modelClass = 'App\\Models\\' . $model;

        if (isset($route->parameters()[$model])) {
            $modelInstance = $route->parameters()[$model];
        } else {
            $modelInstance = new $modelClass;
        }

        if (!Gate::allows($ability, $modelInstance)) {
            abort(403);
        }

        return $next($request);
    }

    /**
     * Get the ability name from the action method.
     *
     * @param  string  $action
     * @return string
     */
    protected function getAbilityFromAction($action)
    {
        $map = [
            'index' => 'viewAny',
            'show' => 'view',
            'create' => 'create',
            'store' => 'create',
            'edit' => 'update',
            'update' => 'update',
            'destroy' => 'delete',
            'export' => 'viewAny',
            'template' => 'viewAny',
            'import' => 'create',
        ];

        return $map[$action] ?? $action;
    }
}
