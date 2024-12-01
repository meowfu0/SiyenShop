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
use App\Http\Controllers\paymentPageController;
use App\Http\Controllers\orderSummaryPageController;
use League\CommonMark\Node\Query\OrExpr;
use App\Http\Livewire\Admin\CreateShop;
use App\Http\Livewire\Admin\Updateshop;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerReviewController;
use App\Http\Controllers\MyPurchasesController;
use App\Http\Controllers\shopPageController; // Use PascalCase
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ProductDetailswithSizeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FaqController;
use App\Mail\MessageNotification;

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

Route::post('/productDetails/addToCart', [ProductDetailsController::class, 'addToCart'])->name('productDetails.addToCart');
Route::post('/productDetails/clearandadd', [ProductDetailsController::class, 'clearAndAdd'])->name('productDetails.clearandadd');
Route::post('/productDetails/buy', [ProductDetailsController::class, 'buyNow'])->name('productDetails.buy');



Route::get('/customerReview', [CustomerReviewController::class, 'index'])->name('customerReview');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


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

    Route::get('/products/add', [ShopProductsAdd::class, 'render'])->name('shop.products.add');
    Route::get('/products/edit', [ShopProductsEdit::class, 'render'])->name('shop.products.edit');
    Route::get('/products/history', [ShopProductsHistory::class, 'render'])->name('shop.products.history');
});


// admin routes
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->name('Admin');

Route::prefix('admin')->group(function () {
    //faqs
    Route::post('/faqs', [FaqController::class, 'store'])->name('admin.faqs.store');
    Route::put('/faqs/{faq}', [FaqController::class, 'edit']);
    Route::put('/faqs/{id}/hide', [FaqController::class, 'hide'])->name('admin.faqs.hide');
    Route::put('/faqs/{id}/show', [FaqController::class, 'show'])->name('admin.faqs.show'); 
    Route::delete('/faqs/{id}/delete', [FaqController::class, 'delete'])->name('admin.faqs.delete');

    Route::post('/faqs-deleted/retrieve', [AdminFaqsDeleted::class, 'retrieve'])->name('faqs.retrieve');
    Route::delete('/faqs-deleted/destroy/{id}', [AdminFaqsDeleted::class, 'destroy'])->name('faqs.delete');
    //other
    Route::get('/dashboard', [AdminDashboard::class, 'render'])->name('admin.dashboard');
    Route::get('/users', [AdminUsers::class, 'render'])->name('admin.users');
    Route::get('/sidenav', [AdminSidenav::class, 'render'])->name('admin.sidenav');
    Route::get('/shops', [AdminShops::class, 'render'])->name('admin.shops');
    Route::get('/faqs', [AdminFaqs::class, 'render'])->name('admin.faqs');
    Route::get('/faqs-deleted', [AdminFaqs::class, 'deleted'])->name('admin.faqs-deleted');
    // Route::get('/chat', [AdminChat::class, 'render'])->name('admin.chat');
    Route::get('/faqs-deleted', [AdminFaqsDeleted::class, 'render'])->name('admin.faqs-deleted'); 
    Route::prefix('shops')->group(function () {
        Route::get('/create', [CreateShop::class, 'render'])->name('admin.createshop');
        Route::get('/update', [Updateshop::class, 'render'])->name('admin.updateshop');
    });
});

use App\Http\Controllers\MessageController;

Route::middleware(['auth'])->group(function () {
    Route::get('/fetch-messages/{recipient}', [MessageController::class, 'fetchMessages']);
    Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('send.message');
    
    // Chat Routes
    Route::get('/admin/chat', [MessageController::class, 'getChatContacts'])->name('admin.chat');
    Route::get('/shop/chat', [MessageController::class, 'getChatContacts'])->name('shop.chat');
    Route::get('/chat', [MessageController::class, 'getChatContacts'])->name('chat'); 
    Route::post('chat', [MessageController::class, 'startChat'])->name('start.chat');
    Route::get('/search-users', [MessageController::class, 'searchUsers']);
    Route::post('/mark-messages-read/{recipientId}', [MessageController::class, 'markMessagesRead']);
    Route::post('/admin/faqs/retrieve', [FaqController::class, 'retrieve'])->name('faqs.retrieve');
    Route::get('/chat/view/{recipientId}', [MessageController::class, 'viewChat'])->name('chat.view');
});

Route::get('/faqs', [FaqController::class, 'index'])->name('faqs.index');
Route::get('/message_notification', [MessageController::class, 'email'])->name('components.message_notification');
Route::post('/getShopUserId', [MessageController::class, 'getShopUserId'])->name('getShopUserId');
