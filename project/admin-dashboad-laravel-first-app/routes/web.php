<?php

use App\Http\Controllers\Apps\ApiKeyAppController;
use App\Http\Controllers\Apps\CalendarAppController;
use App\Http\Controllers\Apps\ChatAppController;
use App\Http\Controllers\Apps\CrmAppController;
use App\Http\Controllers\Apps\CryptoAppController;
use App\Http\Controllers\Apps\EcommerceAppController;
use App\Http\Controllers\Apps\EmailAppController;
use App\Http\Controllers\Apps\FileManagerAppController;
use App\Http\Controllers\Apps\InvoiceAppController;
use App\Http\Controllers\Apps\JobAppController;
use App\Http\Controllers\Apps\NftMarketPlaceAppController;
use App\Http\Controllers\Apps\ProjectAppController;
use App\Http\Controllers\Apps\SupportTicketAppController;
use App\Http\Controllers\Apps\TaskAppController;
use App\Http\Controllers\Apps\ToDoAppController;
use App\Http\Controllers\Auth\ErrorsController;
use App\Http\Controllers\Auth\LockScreenController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\PasswordCreateController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\Auth\SuccessMsgController;
use App\Http\Controllers\Auth\TwoStepVerificationController;
use App\Http\Controllers\Dashboards\AnalyticDashboardController;
use App\Http\Controllers\Dashboards\CrmDashboardController;
use App\Http\Controllers\Dashboards\CryptoDashboardController;
use App\Http\Controllers\Dashboards\EcommerceDashboardController;
use App\Http\Controllers\Dashboards\JobDashboardController;
use App\Http\Controllers\Dashboards\NftDashboardController;
use App\Http\Controllers\Dashboards\ProjectsDashboardController;
use App\Http\Controllers\Landing\LandingPageController;
use App\Http\Controllers\Pages\BlogController;
use App\Http\Controllers\Pages\PageController;
use App\Http\Controllers\Pages\ProfileController;
use Illuminate\Support\Facades\Route;

/* Dashboard. */
Route::get('/', [EcommerceDashboardController::class, 'showEcommerceDashboard'])->name('default');
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/analytics', [AnalyticDashboardController::class, 'showAnalyticDashboard'])->name('showAnalyticDashboard');
    Route::get('/crm', [CrmDashboardController::class, 'showCrmDashboard'])->name('showCrmDashboard');
    Route::get('/ecommerce', [EcommerceDashboardController::class, 'showEcommerceDashboard'])->name('showEcommerceDashboard');
    Route::get('/crypto', [CryptoDashboardController::class, 'showCryptoDashboard'])->name('showCryptoDashboard');
    Route::get('/projects', [ProjectsDashboardController::class, 'showProjectsDashboard'])->name('showProjectsDashboard');
    Route::get('/nft', [NftDashboardController::class, 'showNftDashboard'])->name('showNftDashboard');
    Route::get('/job', [JobDashboardController::class, 'showJobDashboard'])->name('showJobDashboard');
});

/* Apps. */
Route::prefix('apps')->name('app.')->group(function () {
    /* Calendar. */
    Route::prefix('calendar')->name('calendar.')->group(function () {
        Route::get('/', [CalendarAppController::class, 'showMainCalendar'])->name('main');
        Route::get('/month-grid', [CalendarAppController::class, 'showCalendarMonthGrid'])->name('monthGrid');
    });

    /* Chat. */
    Route::get('/chat', [ChatAppController::class, 'showChat'])->name('showChat');

    /* Email. */
    Route::get('/mailbox', [EmailAppController::class, 'showMailbox'])->name('email.showMailbox');
    Route::prefix('email-templates')->name('email.')->group(function () {
        Route::get('/basic', [EmailAppController::class, 'showEmailTemplateBasic'])->name('basic');
        Route::get('/ecommerce', [EmailAppController::class, 'showEmailTemplateEcommerce'])->name('ecommerce');
    });

    /* Ecommerce. */
    Route::prefix('ecommerce')->name('ecommerce.')->group(function () {
        Route::get('/products', [EcommerceAppController::class, 'showProducts'])->name('products');
        Route::get('/product-detail', [EcommerceAppController::class, 'showProductDetails'])->name('productDetails');
        Route::get('/create-product', [EcommerceAppController::class, 'showCreateProduct'])->name('createProduct');
        Route::get('/orders', [EcommerceAppController::class, 'showOrders'])->name('orders');
        Route::get('/order-details', [EcommerceAppController::class, 'showOrderDetails'])->name('orderDetails');
        Route::get('/customers', [EcommerceAppController::class, 'showCustomers'])->name('customers');
        Route::get('/shopping-cart', [EcommerceAppController::class, 'showShoppingCart'])->name('shoppingCart');
        Route::get('/checkout', [EcommerceAppController::class, 'showCheckout'])->name('checkout');
        Route::get('/sellers', [EcommerceAppController::class, 'showSellers'])->name('sellers');
        Route::get('/seller-details', [EcommerceAppController::class, 'showSellerDetails'])->name('sellerDetails');
    });

    /* Project. */
    Route::prefix('project')->name('project.')->group(function () {
        Route::get('/list', [ProjectAppController::class, 'showProjectList'])->name('list');
        Route::get('/overview', [ProjectAppController::class, 'showProjectOverview'])->name('overview');
        Route::get('/create', [ProjectAppController::class, 'showCreateProject'])->name('create');
    });

    /* Tasks. */
    Route::prefix('task')->name('task.')->group(function () {
        Route::get('/kanban-board', [TaskAppController::class, 'showKanbanBoard'])->name('kanbanBoard');
        Route::get('/list', [TaskAppController::class, 'showTaskList'])->name('list');
        Route::get('/details', [TaskAppController::class, 'showTaskDetails'])->name('details');
    });

    /* CRM. */
    Route::prefix('crm')->name('crm.')->group(function () {
        Route::get('/contacts', [CrmAppController::class, 'showCrmContacts'])->name('contacts');
        Route::get('/companies', [CrmAppController::class, 'showCrmCompanies'])->name('companies');
        Route::get('/deals', [CrmAppController::class, 'showCrmDeals'])->name('deals');
        Route::get('/leads', [CrmAppController::class, 'showCrmLeads'])->name('leads');
    });

    /* Crypto. */
    Route::prefix('crypto')->name('crypto.')->group(function () {
        Route::get('/transactions', [CryptoAppController::class, 'showCryptoTransactions'])->name('transactions');
        Route::get('/buy-sell', [CryptoAppController::class, 'showCryptoBuyAndSell'])->name('buySell');
        Route::get('/orders', [CryptoAppController::class, 'showCryptoOrders'])->name('orders');
        Route::get('/my-wallet', [CryptoAppController::class, 'showCryptoMyWallet'])->name('myWallet');
        Route::get('/ico-list', [CryptoAppController::class, 'showCryptoIcoList'])->name('icoList');
        Route::get('/kyc-application', [CryptoAppController::class, 'showKycApplication'])->name('kycApplication');
    });

    /* Invoice. */
    Route::prefix('invoice')->name('invoice.')->group(function () {
        Route::get('/list', [InvoiceAppController::class, 'showInvoiceList'])->name('list');
        Route::get('/details', [InvoiceAppController::class, 'showInvoiceDetails'])->name('details');
        Route::get('/create', [InvoiceAppController::class, 'showCreateInvoice'])->name('create');
    });

    /* Support Ticket. */
    Route::prefix('support-ticket')->name('supportTicket.')->group(function () {
        Route::get('/list', [SupportTicketAppController::class, 'showList'])->name('list');
        Route::get('/details', [SupportTicketAppController::class, 'showTicketDetails'])->name('details');
    });

    /* NFT Marketplace. */
    Route::prefix('nft')->name('nft.')->group(function () {
        Route::get('/marketplace', [NftMarketPlaceAppController::class, 'showMarketPlace'])->name('marketplace');
        Route::get('/explore', [NftMarketPlaceAppController::class, 'showExploreNow'])->name('explore');
        Route::get('/auction', [NftMarketPlaceAppController::class, 'showLiveAuction'])->name('auction');
        Route::get('/item-details', [NftMarketPlaceAppController::class, 'showItemDetails'])->name('itemDetails');
        Route::get('/collections', [NftMarketPlaceAppController::class, 'showCollections'])->name('collections');
        Route::get('/creators', [NftMarketPlaceAppController::class, 'showCreators'])->name('creators');
        Route::get('/ranking', [NftMarketPlaceAppController::class, 'showRanking'])->name('ranking');
        Route::get('/wallet', [NftMarketPlaceAppController::class, 'showWalletConnect'])->name('wallet');
        Route::get('/create', [NftMarketPlaceAppController::class, 'showCreateNFT'])->name('create');
    });

    /* File Manager. */
    Route::get('/file-manager', [FileManagerAppController::class, 'showFileManager'])->name('fileManager');

    /* To Do. */
    Route::get('/to-do', [ToDoAppController::class, 'showToDo'])->name('todo');

    /* Jobs. */
    Route::prefix('job')->name('job.')->group(function () {
        Route::get('/statistics', [JobAppController::class, 'showStatistics'])->name('statistics');
        Route::get('/list', [JobAppController::class, 'showJobList'])->name('list');
        Route::get('/grid', [JobAppController::class, 'showJobGridList'])->name('grid');
        Route::get('/details', [JobAppController::class, 'showJobOverview'])->name('overview');
        Route::get('/candidate-list', [JobAppController::class, 'showCandidateListView'])->name('candidateList');
        Route::get('/candidate-grid', [JobAppController::class, 'showCandidateGridView'])->name('candidateGrid');
        Route::get('/application', [JobAppController::class, 'showApplication'])->name('application');
        Route::get('/new-job', [JobAppController::class, 'showNewJob'])->name('newJob');
        Route::get('/companies-list', [JobAppController::class, 'showCompaniesList'])->name('companies');
        Route::get('/categories', [JobAppController::class, 'showJobCategories'])->name('categories');
    });

    /* API Key. */
    Route::get('/api-key', [ApiKeyAppController::class, 'showApiKey'])->name('apiKey');
});

/* Layouts. */
Route::prefix('layouts')->name('layout.')->group(function () {
});


/* Authentication. */
Route::prefix('auth')->name('auth.')->group(function () {
    /* Sign In. */
    Route::name('signIn.')->group(function () {
        Route::get('/sign-in-basic', [SignInController::class, 'showSignInBasic'])->name('basic');
        Route::get('/sign-in-cover', [SignInController::class, 'showSignInCover'])->name('cover');
    });

    /* Sign Up. */
    Route::name('signUp.')->group(function () {
        Route::get('/sign-up-basic', [SignUpController::class, 'showSignUpBasic'])->name('basic');
        Route::get('/sign-up-cover', [SignUpController::class, 'showSignUpCover'])->name('cover');
    });

    /* Password Reset. */
    Route::name('pwdReset.')->group(function () {
        Route::get('/pwd-reset-basic', [PasswordResetController::class, 'showPasswordResetBasic'])->name('basic');
        Route::get('/pwd-reset-cover', [PasswordResetController::class, 'showPasswordResetCover'])->name('cover');
    });

    /* Password Create. */
    Route::name('pwdCreate.')->group(function () {
        Route::get('/pwd-create-basic', [PasswordCreateController::class, 'showPasswordCreateBasic'])->name('basic');
        Route::get('/pwd-create-cover', [PasswordCreateController::class, 'showPasswordCreateCover'])->name('cover');
    });

    /* Look Screen. */
    Route::name('lockScreen.')->group(function () {
        Route::get('/lock-screen-basic', [LockScreenController::class, 'showLockScreenBasic'])->name('basic');
        Route::get('/lock-screen-cover', [LockScreenController::class, 'showLockScreenCover'])->name('cover');
    });

    /* Log Out. */
    Route::name('logout.')->group(function () {
        Route::get('/logout-basic', [LogoutController::class, 'showLogoutBasic'])->name('basic');
        Route::get('/logout-cover', [LogoutController::class, 'showLogoutCover'])->name('cover');
    });

    /* Success Message. */
    Route::name('successMsg.')->group(function () {
        Route::get('/success-msg-basic', [SuccessMsgController::class, 'showSuccessMessageBasic'])->name('basic');
        Route::get('/success-msg-cover', [SuccessMsgController::class, 'showSuccessMessageCover'])->name('cover');
    });

    /* Two Step Verification. */
    Route::name('twoStepVerification.')->group(function () {
        Route::get('/two-step-verification-basic', [TwoStepVerificationController::class, 'showTwoStepVerificationBasic'])->name('basic');
        Route::get('/two-step-verification-cover', [TwoStepVerificationController::class, 'showTwoStepVerificationCover'])->name('cover');
    });

    /* Errors. */
    Route::name('errors.')->group(function () {
        Route::get('/400-basic', [ErrorsController::class, 'showTwoStepVerificationBasic'])->name('400basic');
        Route::get('/400-cover', [ErrorsController::class, 'showTwoStepVerificationCover'])->name('400cover');
        Route::get('/400-alt', [ErrorsController::class, 'showTwoStepVerificationCover'])->name('400alt');
        Route::get('/500', [ErrorsController::class, 'showTwoStepVerificationCover'])->name('500');
        Route::get('/offline-page', [ErrorsController::class, 'showTwoStepVerificationCover'])->name('offlinePage');
    });
});

/* Pages. */
Route::prefix('pages')->name('page.')->group(function () {
    Route::get('/starter', [PageController::class, 'showStarterPage'])->name('starter');
    Route::get('/team', [PageController::class, 'showTeamPage'])->name('team');
    Route::get('/timeline', [PageController::class, 'showTimelinePage'])->name('timeline');
    Route::get('/faqs', [PageController::class, 'showFrequentlyAskedQuestionsPage'])->name('faqs');
    Route::get('/pricing', [PageController::class, 'showPricingPage'])->name('pricing');
    Route::get('/gallery', [PageController::class, 'showGalleryPage'])->name('gallery');
    Route::get('/maintenance', [PageController::class, 'showMaintenancePage'])->name('maintenance');
    Route::get('/coming-soon', [PageController::class, 'showComingSoonPage'])->name('comingSoon');
    Route::get('/sitemap', [PageController::class, 'showSitemapPage'])->name('sitemap');
    Route::get('/search-results', [PageController::class, 'showSearchResultPage'])->name('searchResults');
    Route::get('/privacy-policy', [PageController::class, 'showPrivacyPolicyPage'])->name('privacyPolicy');
    Route::get('/term-conditions', [PageController::class, 'showTermAndConditionsPage'])->name('termConditions');

    /* Profile. */
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/simple-page', [ProfileController::class, 'showProfileSimplePage'])->name('simplePage');
        Route::get('/settings', [ProfileController::class, 'showProfileSettings'])->name('settings');
    });

    /* Blog. */
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/list', [BlogController::class, 'showBlogListView'])->name('list');
        Route::get('/grid', [BlogController::class, 'showBlogGridView'])->name('grid');
        Route::get('/overview', [BlogController::class, 'showBlogOverView'])->name('settings');
    });
});

/* Landing. */
Route::prefix('landing')->name('landing.')->group(function () {
    Route::get('/', [LandingPageController::class, 'showLandingPage'])->name('landingPage');
    Route::get('/nft', [LandingPageController::class, 'showNFTLandingPage'])->name('landingPageNFT');
    Route::get('/job', [LandingPageController::class, 'showJobLandingPage'])->name('landingPageJob');
});


/* Base UI. */
Route::prefix('base-ui')->name('baseUi.')->group(function () {
});

/* Advance UI. */
Route::prefix('advance-ui')->name('advanceUi.')->group(function () {
});

/* Widgets. */


/* Forms. */
Route::prefix('forms')->name('form.')->group(function () {
});

/* Tables. */
Route::prefix('tables')->name('table.')->group(function () {
});

/* Charts. */
Route::prefix('charts')->name('chart.')->group(function () {
});

/* Icons. */
Route::prefix('icons')->name('icon.')->group(function () {
});

/* Maps. */
Route::prefix('maps')->name('map.')->group(function () {
});

/* Multi Level. */
