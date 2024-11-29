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
use App\Http\Controllers\cartPageController; 
use App\Http\Controllers\checkOutPageController;
use App\Http\Controllers\paymentPageController;
use App\Http\Controllers\orderSummaryPageController;
use League\CommonMark\Node\Query\OrExpr;
use App\Http\Livewire\Admin\CreateShop;
use App\Http\Livewire\Admin\Updateshop; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\MyPurchasesController;
use App\Http\Controllers\shopPageController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ProductDetailswithSizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ShopProductsAddController;
use App\Http\Controllers\ShopProductEditController;
use App\Http\Controllers\CategoryController;

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// =================== user side routes ==================================
// profile page
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

// shopping module
Route::get('/shopPage', [shopPageController::class, 'index'])->name('shopPage');
Route::get('/productDetails', [ProductDetailsController::class, 'index'])->name('productDetails');
Route::get('/productDetailswithSize', [ProductDetailswithSizeController::class, 'index'])->name('productDetailswithSize');
Route::get('/customerReview', [CustomerReviewController::class, 'index'])->name('customerReview');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// cart and checkout routes
Route::get('/cartPage', [cartPageController::class, 'index'])->name('cartPage');
Route::get('/checkOutPage', [checkOutPageController::class, 'index'])->name('checkOutPage');
Route::get('/paymentPage', [paymentPageController::class, 'index'])->name('paymentPage');
Route::get('/orderSummaryPage', [orderSummaryPageController::class, 'index'])->name('orderSummaryPage');
// =================== end of cart and checkout module =======================
// chat route
Route::get('/chat', [UserChat::class, 'render'])->name('chat');

// faqs route
Route::get('/faqs', function () {
    return view('customer_support/faqs');
})->name('faqs');

// user purchases route
Route::get('/mypurchases', [ MyPurchasesController::class, 'index'])->name('mypurchases');

// Shop Routes Group
//add middleware for authenticatio'n purposes
Route::get('/shop', function () {
    return redirect()->route('shop.dashboard');
})->name('Shop');
Route::prefix('shop')->group(function () {
    Route::get('/dashboard', [ShopDashboard::class, 'render'])->name('shop.dashboard');
    Route::get('/products', [ShopProducts::class, 'render'])->name('shop.products');
    Route::get('/orders', [ShopOrders::class, 'render'])->name('shop.orders');
    Route::get('/chat', [ShopChat::class, 'render'])->name('shop.chat');

    // Add Product
    Route::get('products/add', [ShopProductsAddController::class, 'create'])->name('shop.products.add'); 
    Route::post('products', [ShopProductsAddController::class, 'store'])->name('shop.products.store'); 

    // Edit Product
    Route::get('/products/edit/{productId}', [ShopProductEditController::class, 'edit'])->name('shop.products.edit');
    Route::post('/products/{id}', [ShopProductEditController::class, 'update'])->name('products.update');

    // Category
    Route::post('categories/add', [CategoryController::class, 'add'])->name('categories.add');
    Route::get('/products/edit', [CategoryController::class, 'showCategorySelection']);
    Route::put('/products/edit/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/products/edit/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.delete');

    //Product History
    Route::get('/products/history', [ShopProductsHistory::class, 'render'])->name('shop.products.history');
});

Route::get('/api/categories', function () {
    $categories = App\Models\Category::all(['id', 'category_name']); // Adjust fields as needed
    return response()->json(['categories' => $categories]);
});


// admin routes
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->name('Admin');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'render'])->name('admin.dashboard');
    Route::get('/users', [AdminUsers::class, 'render'])->name('admin.users');
    Route::get('/sidenav', [AdminSidenav::class, 'render'])->name('admin.sidenav');
    Route::get('/shops', [AdminShops::class, 'render'])->name('admin.shops');
    Route::get('/faqs', [AdminFaqs::class, 'render'])->name('admin.faqs');
    Route::get('/faqs-deleted', [AdminFaqs::class, 'deleted'])->name('admin.faqs-deleted');
    Route::get('/chat', [AdminChat::class, 'render'])->name('admin.chat');
    Route::prefix('shops')->group(function () {
        Route::get('/create', [CreateShop::class, 'render'])->name('admin.createshop');
        Route::get('/update', [Updateshop::class, 'render'])->name('admin.updateshop');
    });
});

// Products Routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::get('/products/history', [ProductController::class, 'history'])->name('products.history');

// Product Variant Routes
Route::get('/product-variants', [ProductVariantController::class, 'index'])->name('product-variants.index');
Route::get('/product-variants/create', [ProductVariantController::class, 'create'])->name('product-variants.create');
Route::post('/product-variants', [ProductVariantController::class, 'store'])->name('product-variants.store');
Route::get('/product-variants/{productVariant}', [ProductVariantController::class, 'show'])->name('product-variants.show');
Route::get('/product-variants/{productVariant}/edit', [ProductVariantController::class, 'edit'])->name('product-variants.edit');
Route::put('/product-variants/{productVariant}', [ProductVariantController::class, 'update'])->name('product-variants.update');
Route::delete('/product-variants/{productVariant}', [ProductVariantController::class, 'destroy'])->name('product-variants.destroy');
