<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\ComponentController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PreferenceController;
use App\Http\Controllers\Backend\ProfileController;

Route::name('backend.')->prefix('backend')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['logged-in', 'active'])->group(function () {

        Route::get('/', [DashboardController::class, 'redirectToIndex']);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

        // Preferences
        Route::patch('/update', [PreferenceController::class, 'update'])->name('update');

        // Profile
        Route::name('profile.')->prefix('profile')->group(function () {
            Route::get('/', [ProfileController::class, 'edit'])->name('edit');
            Route::patch('/update', [ProfileController::class, 'update'])->name('update');
            Route::patch('/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');
        });

        // Users
        Route::name('users.')->prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::get('/{user}', [UserController::class, 'show'])->name('show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::patch('/{user}/update', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}/delete', [UserController::class, 'delete'])->name('delete');
            Route::post('/delete-many', [UserController::class, 'deleteMany'])->name('delete-many');

            Route::patch('/{user}/activate-user', [UserController::class, 'activateUser'])->name('activate-user');
            Route::patch('/{user}/deactivate-user', [UserController::class, 'deactivateUser'])->name('deactivate-user');
        });

        // Roles
        Route::name('roles.')->prefix('roles')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::get('/{role}', [RoleController::class, 'show'])->name('show');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('edit');
            Route::patch('/{role}/update', [RoleController::class, 'update'])->name('update');
            Route::delete('/{role}/delete', [RoleController::class, 'delete'])->name('delete');
            Route::post('/delete-many', [RoleController::class, 'deleteMany'])->name('delete-many');
        });

        // Permissions
        Route::name('permissions.')->prefix('permissions')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('/{user}', [PermissionController::class, 'show'])->name('show');
        });

        // Components
        Route::prefix('components')->name('components.')->group(function () {

            Route::get('/', [ComponentController::class, 'index'])->name('index');
            Route::get('/accordion', [ComponentController::class, 'accordion'])->name('accordion');
            Route::get('/alert', [ComponentController::class, 'alert'])->name('alert');
            Route::get('/alert-dialog', [ComponentController::class, 'alertDialog'])->name('alert-dialog');
            Route::get('/aspect-ratio', [ComponentController::class, 'aspectRatio'])->name('aspect-ratio');
            Route::get('/avatar', [ComponentController::class, 'avatar'])->name('avatar');
            Route::get('/badge', [ComponentController::class, 'badge'])->name('badge');
            Route::get('/breadcrumb', [ComponentController::class, 'breadcrumb'])->name('breadcrumb');
            Route::get('/button', [ComponentController::class, 'button'])->name('button');
            Route::get('/button-group', [ComponentController::class, 'buttonGroup'])->name('button-group');
            Route::get('/calendar', [ComponentController::class, 'calendar'])->name('calendar');
            Route::get('/card', [ComponentController::class, 'card'])->name('card');
            Route::get('/carousel', [ComponentController::class, 'carousel'])->name('carousel');
            Route::get('/chart', [ComponentController::class, 'chart'])->name('chart');
            Route::get('/checkbox', [ComponentController::class, 'checkbox'])->name('checkbox');
            Route::get('/collapsible', [ComponentController::class, 'collapsible'])->name('collapsible');
            Route::get('/combobox', [ComponentController::class, 'combobox'])->name('combobox');
            Route::get('/command', [ComponentController::class, 'command'])->name('command');
            Route::get('/context-menu', [ComponentController::class, 'contextMenu'])->name('context-menu');
            Route::get('/data-table', [ComponentController::class, 'dataTable'])->name('data-table');
            Route::get('/date-picker', [ComponentController::class, 'datePicker'])->name('date-picker');
            Route::get('/dialog', [ComponentController::class, 'dialog'])->name('dialog');
            Route::get('/drawer', [ComponentController::class, 'drawer'])->name('drawer');
            Route::get('/dropdown-menu', [ComponentController::class, 'dropdownMenu'])->name('dropdown-menu');
            Route::get('/empty', [ComponentController::class, 'empty'])->name('empty');
            Route::get('/field', [ComponentController::class, 'field'])->name('field');
            Route::get('/react-hook-form', [ComponentController::class, 'reactHookForm'])->name('react-hook-form');
            Route::get('/hover-card', [ComponentController::class, 'hoverCard'])->name('hover-card');
            Route::get('/input', [ComponentController::class, 'input'])->name('input');
            Route::get('/input-group', [ComponentController::class, 'inputGroup'])->name('input-group');
            Route::get('/input-otp', [ComponentController::class, 'inputOtp'])->name('input-otp');
            Route::get('/item', [ComponentController::class, 'item'])->name('item');
            Route::get('/kbd', [ComponentController::class, 'kbd'])->name('kbd');
            Route::get('/label', [ComponentController::class, 'label'])->name('label');
            Route::get('/menubar', [ComponentController::class, 'menubar'])->name('menubar');
            Route::get('/navigation-menu', [ComponentController::class, 'navigationMenu'])->name('navigation-menu');
            Route::get('/pagination', [ComponentController::class, 'pagination'])->name('pagination');
            Route::get('/popover', [ComponentController::class, 'popover'])->name('popover');
            Route::get('/progress', [ComponentController::class, 'progress'])->name('progress');
            Route::get('/radio-group', [ComponentController::class, 'radioGroup'])->name('radio-group');
            Route::get('/resizable', [ComponentController::class, 'resizable'])->name('resizable');
            Route::get('/scroll-area', [ComponentController::class, 'scrollArea'])->name('scroll-area');
            Route::get('/select', [ComponentController::class, 'select'])->name('select');
            Route::get('/separator', [ComponentController::class, 'separator'])->name('separator');
            Route::get('/sheet', [ComponentController::class, 'sheet'])->name('sheet');
            Route::get('/sidebar', [ComponentController::class, 'sidebar'])->name('sidebar');
            Route::get('/skeleton', [ComponentController::class, 'skeleton'])->name('skeleton');
            Route::get('/slider', [ComponentController::class, 'slider'])->name('slider');
            Route::get('/sonner', [ComponentController::class, 'sonner'])->name('sonner');
            Route::get('/spinner', [ComponentController::class, 'spinner'])->name('spinner');
            Route::get('/switch', [ComponentController::class, 'switch'])->name('switch');
            Route::get('/table', [ComponentController::class, 'table'])->name('table');
            Route::get('/tabs', [ComponentController::class, 'tabs'])->name('tabs');
            Route::get('/textarea', [ComponentController::class, 'textarea'])->name('textarea');
            Route::get('/toast', [ComponentController::class, 'toast'])->name('toast');
            Route::get('/toggle', [ComponentController::class, 'toggle'])->name('toggle');
            Route::get('/toggle-group', [ComponentController::class, 'toggleGroup'])->name('toggle-group');
            Route::get('/tooltip', [ComponentController::class, 'tooltip'])->name('tooltip');
            Route::get('/typography', [ComponentController::class, 'typography'])->name('typography');

        });
    });
});
