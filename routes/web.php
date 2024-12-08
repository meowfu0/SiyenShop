<?php

use App\Http\Livewire\Admin\AdminChat;
use App\Http\Livewire\Admin\AdminFaqs;
use App\Http\Livewire\Admin\AdminFaqsDeleted;
use App\Http\Livewire\Admin\AdminShops;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\Admin\AdminUsers;
use App\Http\Livewire\Admin\AdminSidenav;
use App\Http\Livewire\UserChat;
use App\Http\Livewire\UserMyPurchases;
use App\Http\Livewire\UserProfile;
use App\Http\Livewire\UserSidenav;
use App\Http\Livewire\ShopChat;
use App\Http\Livewire\ShopDashboard;
use App\Http\Livewire\ShopOrders;
use App\Http\Livewire\ShopProducts;
use App\Http\Livewire\ShopProductsAdd;
use App\Http\Livewire\ShopProductsEdit;
use App\Http\Livewire\ShopProductsHistory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartPageController;
use App\Http\Controllers\checkOutPageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\paymentPageController;
use App\Http\Controllers\orderSummaryPageController;
use App\Http\Controllers\UserController;
use League\CommonMark\Node\Query\OrExpr;
use App\Http\Livewire\Admin\CreateShop;
use App\Http\Livewire\Admin\Updateshop;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\MyPurchasesController;
use App\Http\Controllers\OrderEmailsController;
use App\Http\Controllers\shopPageController; // Use PascalCase
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ProductDetailswithSizeController;
use App\Http\Controllers\CreateShopController;
use App\Http\Controllers\Status;
use App\Http\Controllers\UpdateShopController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\GCashInfoController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FaqController;
use App\Mail\MessageNotification;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ShopProductsAddController;
use App\Http\Controllers\ShopProductEditController;
use App\Http\Controllers\ShopProductDeleteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopProductHistoryRestoreController;
use App\Http\Controllers\OrderController;


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['role:Student'])->group(function () {
        // =================== user side routes ==================================
    // profile page
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::get('/profile', [UserProfileController::class, 'showProfile'])->name('profile')->middleware('auth');

Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::put('/profile/update/{user}', [UserProfileController::class, 'update'])->name('profile.update')->middleware('auth');







    // shopping module
    Route::get('/shopPage', [ShopController::class, 'index'])->name('shopPage');
    Route::get('/productDetails', [ProductDetailsController::class, 'index'])->name('productDetails');
    
Route::post('/productDetails/addToCart', [ProductDetailsController::class, 'addToCart'])->name('productDetails.addToCart');
Route::post('/productDetails/clearandadd', [ProductDetailsController::class, 'clearAndAdd'])->name('productDetails.clearandadd');
Route::post('/productDetails/buy', [ProductDetailsController::class, 'buyNow'])->name('productDetails.buy');



    Route::get('/customerReview', [CustomerReviewController::class, 'index'])->name('customerReview');

    

//=================== cart and checkout routes================================
//THE ID MUST BE FROM THE BUY NOW BUTTON
    Route::get('/cartPage/{id?}', [CartPageController::class, 'index'])->name('cartPage');
    
Route::delete('/cart/remove/{id}', [CartPageController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartPageController::class, 'updateQuantity'])->name('cart.updateQuantity');
// Route to update the size of a cart item
Route::patch('/cart/update/size/{id}', [CartPageController::class, 'updateSize'])->name('cart.updateSize');
// Route to update the quantity of a cart item
Route::patch('/cart/update/quantity/{id}', [CartPageController::class, 'updateQuantity'])->name('cart.updateQuantity');

Route::get('/checkOutPage', [checkOutPageController::class, 'index'])->name('checkOutPage');
    Route::get('/checkOutPage/Checkout-Items/{encodedIds}', [CheckOutPageController::class, 'index'])->name('checkOutPage.Checkout-Items');
Route::post('/update-total-amount', [checkOutPageController::class, 'updateTotalAmount'])->name('updateTotalAmount');


Route::post('/payment/{id}', [paymentPageController::class, 'payment'])->name('payment');
Route::get('/paymentPage', [paymentPageController::class, 'index'])->name('paymentPage');
    Route::get('/paymentPage/{id}', [paymentPageController::class, 'index'])->name('paymentPage.i');


Route::get('/orderSummaryPage', [orderSummaryPageController::class, 'index'])->name('orderSummaryPage');
    Route::get('/orderSummaryPage/{gcashNumber}/{id}', [orderSummaryPageController::class, 'index'])->name('orderSummaryPage');
// =================== end of cart and checkout module =======================
    


// chat route
    Route::get('/chat', [UserChat::class, 'render'])->name('chat');

    // faqs route
    Route::get('/faqs', function () {
        return view('customer_support/faqs');
    })->name('faqs');

    // user purchases route
    Route::get('/mypurchases', [ MyPurchasesController::class, 'index'])->name('mypurchases');
Route::post('/submit-review', [MyPurchasesController::class, 'submitReview'])->name('submit.review');
Route::get('/count-orders/{orderId}', [MyPurchasesController::class, 'countOrders'])->name('count_orders');
Route::post('/orders-pdf-print', [OrderController::class, 'processDataTable']);
Route::get('/mypurchases/{orderId}', [MyPurchasesController::class, 'mypurchases'])->name('mypurchases-open');

Route::get('/email', [ OrderEmailsController::class, 'index'])->name('email');

});
Route::put('/profile/{user}', [UserProfileController::class, 'update'])->name('profile.update');

Route::middleware(['role:Business Manager'])->group(function () {
    // Shop Routes Group
    //add middleware for authenticatio'n purpose
    Route::get('/shop', function () {
        return redirect()->route('shop.dashboard');
    })->name('Shop');

    Route::prefix('shop')->middleware(['auth'])->group(function () {
        Route::get('/dashboard', [ShopDashboard::class, 'render'])->name('shop.dashboard');
        Route::get('/products', [ShopProducts::class, 'render'])->name('shop.products');
        Route::post('/orders/{id}/change-status', [OrderController::class, 'changeStatus']);



    //ORDER MANAGEMENT
    Route::get('/orders', [ShopOrders::class, 'render'])->name('shop.orders');
        Route::post('/orders', [ShopOrders::class, 'store'])->name('shop.orders');//pang store order
    
    
    Route::get('/orders', [OrderController::class, 'index']);
    // Updated route to fetch the shop details for the authenticated user
    Route::get('/shop', [OrderController::class, 'getShop'])->name('shop.index');
    Route::get('shop/orders/take', [OrderController::class, 'getOrders']);

    

    Route::post('/orders/update-status', [OrderController::class, 'updateStatus'])
    ->middleware('auth')
    ->name('orders.update-status');


    Route::get('/chat', [ShopChat::class, 'render'])->name('shop.chat');
    
        // Add Product
    Route::get('products/add', [ShopProductsAddController::class, 'create'])->name('shop.products.add'); 
    Route::post('products', [ShopProductsAddController::class, 'store'])->name('shop.products.store'); 

    // Edit Product
        Route::get('/products/edit/{id}', [ShopProductEditController::class, 'edit'])->name('shop.products.edit');
    Route::put('/products/{id}', [ShopProductEditController::class, 'update'])->name('shop.products.update');

    // Category
    Route::post('categories/add', [CategoryController::class, 'add'])->name('categories.add');
    
    Route::get('/products/edit', [CategoryController::class, 'showCategorySelection']);
    Route::put('/products/edit/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/products/edit/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

    //Delete
    Route::delete('/shop/products/delete/{id}', [ShopProductDeleteController::class, 'delete'])->name('shop.products.delete');
    Route::post('/shop/products/delete/multiple', [ShopProductDeleteController::class, 'deleteMultiple'])->name('shop.products.delete.multiple');

    //Product History
        Route::get('/products/history', [ShopProductsHistory::class, 'render'])->name('shop.products.history');
        
    });
    
Route::get('/api/categories', function () {
    $categories = App\Models\Category::all(['id', 'category_name']); // Adjust fields as needed
    return response()->json(['categories' => $categories]);
});

}); 
//roles management module


Route::middleware(['role:Admin'])->group(function () {

    // admin routes
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    })->name('Admin');

        Route::prefix('admin')->group(function () {
            Route::get('/dashboard', [AdminDashboard::class, 'render'])->name('admin.dashboard');
            //Route::get('/users', [AdminUsers::class, 'render'])->name('admin.users');
            Route::get('/users', [UserController::class, 'index'])->name('admin.users');
            Route::get('/shops', [shopPageController::class, 'index'])->name('admin.shops');
            Route::get('/sidenav', [AdminSidenav::class, 'render'])->name('admin.sidenav');
            Route::get('/faqs', [AdminFaqs::class, 'render'])->name('admin.faqs');
            Route::get('/faqs-deleted', [AdminFaqs::class, 'deleted'])->name('admin.faqs-deleted');
            Route::get('/chat', [AdminChat::class, 'render'])->name('admin.chat');
            Route::prefix('shops')->group(function () {
                Route::get('/create', [CreateShop::class, 'store'])->name('admin.createshop');
                Route::get('/update', [Updateshop::class, 'render'])->name('admin.updateshop');
                Route::get('/shops/create', [CreateShopController::class, 'index'])->name('admin.createshop');
                Route::get('/create', [CreateShopController::class, 'index'])->name('admin.shops.create');  // Form for creating a shop
                Route::post('/', [CreateShopController::class, 'store'])->name('admin.shops.store');  // Store shop data

        // Route to edit a shop (Form)
                Route::get('/update/access/{shopId}', [UpdateShopController::class, 'edit'])->name('admin.shops.edit');
                Route::put('/update/change/{shopId}', [UpdateShopController::class, 'uploadUpdate'])->name('admin.shopUpdate.reflect'); 

        // Route to update the shop (Form submission)
            Route::put('/update/{id}', [UpdateShopController::class, 'update'])->name('admin.shops.update');
            Route::get('/shops/update/{id}', [shopPageController::class, 'edit'])->name('shops.update');
            Route::get('/shops/update/view', [Updateshop::class, 'render'])->name('shops.update.view'); 

            });
            //Role Edit / Update
            Route::get('/users/{userId}/edit', [UserController::class, 'edit'])->name('users.edit'); // Fetch user and roles
            Route::put('/users/{userId}/update-role', [UserController::class, 'updateRole'])->name('users.updateRoles'); // Update role
            Route::put('/users/{userId}/status', [UserController::class, 'statusChange'])->name('users.status'); // Update role
            Route::get('/users/{userId}/permissions', [UserController::class, 'getUserPermissions'])->name('users.permissions');
            

            
    });
    

       
});



