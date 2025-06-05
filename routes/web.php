<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\SupllyController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MenuController;



use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('coming-soon');
});

// Language switching routes (available to all users)
Route::get('/language/{locale}', [LanguageController::class, 'switch'])->name('language.switch');
Route::get('/api/language/info', [LanguageController::class, 'apiLanguageInfo'])->name('language.info');

// Menu routes (public access)
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/api/menu/categories', [MenuController::class, 'getCategories'])->name('menu.categories');
Route::get('/api/menu/meals/{category}', [MenuController::class, 'getMealsByCategory'])->name('menu.meals');

// Cashier-specific routes (Arabic names only)
Route::get('/api/cashier/categories', [MenuController::class, 'getCategoriesForCashier'])->name('cashier.categories');
Route::get('/api/cashier/meals/{category}', [MenuController::class, 'getMealsByCategoryForCashier'])->name('cashier.meals');

// Cache management route
Route::post('/api/clear-cache', [MenuController::class, 'clearCache'])->name('clear.cache');





// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login_user', [AuthController::class, 'login'])->name('login_user');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register_user');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Search routes
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
    Route::get('/search/quick', [SearchController::class, 'quick'])->name('search.quick');
    Route::get('/search/{type}', [SearchController::class, 'searchType'])->name('search.type');


    // Additional routes for ingredients
    Route::get('/ingredients/low-stock', [IngredientController::class, 'lowStock'])->name('ingredients.low-stock');
    Route::get('/ingredients/out-of-stock', [IngredientController::class, 'outOfStock'])->name('ingredients.out-of-stock');

    // Additional routes for meals
    Route::get('/meals/category/{category}', [MealController::class, 'byCategory'])->name('meals.by-category');
    Route::get('/meals/available', [MealController::class, 'available'])->name('meals.available');

    // Additional routes for orders
    Route::get('/orders/status/{status}', [OrderController::class, 'byStatus'])->name('orders.by-status');
    Route::get('/orders/type/{type}', [OrderController::class, 'byType'])->name('orders.by-type');
    Route::get('/orders/client/{clientId}', [OrderController::class, 'byClient'])->name('orders.by-client');
    Route::get('/orders/table/{tableNumber}', [OrderController::class, 'byTable'])->name('orders.by-table');
    Route::get('/orders/client/{clientId}/history', [OrderController::class, 'clientHistory'])->name('orders.client-history');
    Route::get('/orders/table/{tableNumber}/orders', [OrderController::class, 'tableOrders'])->name('orders.table-orders');
    Route::get('/kitchen' , [OrderController::class, 'kitchen'])->name('kitchen');


    // Another Routes
    Route::resource('clients', ClientsController::class);
    Route::post('clients/{client}/add-order', [ClientsController::class, 'addOrder'])->name('clients.add-order');
    Route::resource('projects', ProjectController::class);
    Route::resource('costs', CostController::class);
    Route::resource('supply', SupllyController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('ingredients', IngredientController::class);
    Route::resource('meals', MealController::class);
    Route::resource('orders', OrderController::class);

    // Kitchen routes
    Route::get('/kitchen', [App\Http\Controllers\KitchenController::class, 'index'])->name('kitchen.index');
    Route::post('/kitchen/complete/{order}', [App\Http\Controllers\KitchenController::class, 'completeOrder'])->name('kitchen.complete');
    Route::get('/kitchen/pending-orders', [App\Http\Controllers\KitchenController::class, 'getPendingOrders'])->name('kitchen.pending');


    Route::post('/bills/create/{sale}', [BillController::class, 'store'])->name('bills.create');
    Route::get('/bills/{bill}', [BillController::class, 'show'])->name('bills.show');

    // Search routes
    Route::get('/search', [SearchController::class, 'index'])->name('search.index');
    Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
    Route::get('/search/quick', [SearchController::class, 'quick'])->name('search.quick');
    Route::get('/search/{type}', [SearchController::class, 'searchType'])->name('search.type');


    // Mail Routes
    Route::get('/automatic-msgs', [MailController::class, 'index'])->name('mail.index');
    Route::post('/mail/send', [MailController::class, 'send'])->name('mail.send');


    Route::get('/clients-get/{id}' , [ClientsController::class , 'clients_get'])->name('clients-get');
    Route::get('/meals-get/{category}' , [MealController::class , 'meals_get'])->name('meals-get');


    // Owner only routes
    Route::middleware('role:owner')->group(function () {
        Route::resource('users', UserController::class);

        
        Route::get('/api/dashboard-stats/{days}', [DashboardController::class , 'dashboard_stats'])->name('dashboard_stats');
        Route::get('/api/chart-data', [DashboardController::class , 'getChartData'])->name('chart_data');

        Route::post('/getExcelSheet' ,[DashboardController::class , 'getExcelSheet'])->name('getExcelSheet');

        Route::get('/ai/ai-costs', [\App\Http\Controllers\AiController::class, 'costsAnalysic'])->name('ai.suggestions.costs');
        Route::get('/ai/ai-clients', [\App\Http\Controllers\AiController::class, 'clientsAnalysis'])->name('ai.suggestions.clients');
        Route::get('/ai/ai-products', [\App\Http\Controllers\AiController::class, 'mealsAnalysis'])->name('ai.suggestions.products');
        Route::get('/ai/ai-sales', [\App\Http\Controllers\AiController::class, 'ordersAnalysis'])->name('ai.suggestions.sales');
        Route::get('/ai/ai-projects', [\App\Http\Controllers\AiController::class, 'projectsAnalysis'])->name('ai.suggestions.projects');
    });

    // WhatsApp Routes
    Route::prefix('whatsapp')->name('whatsapp.')->group(function () {
        Route::post('/send-welcome', [\App\Http\Controllers\WhatsAppController::class, 'sendWelcome'])->name('send.welcome');
        Route::post('/send-marketing', [\App\Http\Controllers\WhatsAppController::class, 'sendMarketing'])->name('send.marketing');
        Route::post('/test-connection', [\App\Http\Controllers\WhatsAppController::class, 'testConnection'])->name('test.connection');
        Route::get('/status', [\App\Http\Controllers\WhatsAppController::class, 'getStatus'])->name('status');

        // WhatsApp Settings Routes
        Route::get('/settings', [\App\Http\Controllers\WhatsAppSettingsController::class, 'index'])->name('settings');
        Route::post('/settings', [\App\Http\Controllers\WhatsAppSettingsController::class, 'save'])->name('settings.save');
        Route::post('/settings/test', [\App\Http\Controllers\WhatsAppSettingsController::class, 'testConnection'])->name('settings.test');
        Route::get('/templates', [\App\Http\Controllers\WhatsAppSettingsController::class, 'templates'])->name('templates');
        Route::get('/logs', [\App\Http\Controllers\WhatsAppSettingsController::class, 'logs'])->name('logs');
    });
});
