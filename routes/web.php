<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppLogicController;
use App\Http\Controllers\AppLogoController;
use App\Http\Controllers\AwardsController;
use App\Http\Controllers\ContactDetailsController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestmentPlansController;
use App\Http\Controllers\LiveChatAppController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\ManagementTeamController;
use App\Http\Controllers\PlaceOrderController;
use App\Http\Controllers\ReferralsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\TestimoniesController;
use App\Http\Controllers\TransactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WithdrawalCardController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppWidgetController;
use App\Http\Controllers\Tranx\DepositController;
use App\Http\Controllers\Tranx\NewTranxController;
use App\Http\Controllers\Tranx\NewWithdrawalController;
use App\Http\Controllers\UserWalletsController;
use App\Http\Controllers\Cards\CardsController;
use App\Http\Controllers\NetworkFeeController;
// use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::fallback(function(){
    return view('errors.404');
});

Route::name('home.')->group(function(){
    Route::controller(HomeController::class)->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/offline', 'internetError')->name('offline');
        Route::get('/about-us', 'about')->name('about');
        Route::get('/robot-trading', 'robotTrading')->name('robots');
        Route::get('/our-awards', 'ourAwards')->name('our.awards');
        Route::get('/help', 'helpPage')->name('help');
        Route::get('/contact-us', 'contactPage')->name('contact');
        Route::get('/our-referrals', 'referralsPage')->name('referrals');
        Route::get('/our-copy-trading', 'copyTrading')->name('our.copy.trading');
        Route::get('/markets', 'ourMarkets')->name('markets');
        Route::get('/markets/forex', 'forex')->name('forex');
        Route::get('/markets/cryptocurrency', 'crypto')->name('crypto');
        Route::get('/plans', 'plans')->name('plans');
        Route::get('/privacy-policy', 'privacyPolicy')->name('privacy-policy');
        Route::get('/terms', 'termsCondition')->name('terms-conditions');
    });
});

// User dashboard Controller/Routes
Route::middleware(['auth'])->group(function(){
    Route::prefix('/user')->name('user.')->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::get('/overview', 'accountOverview')->name('overview');
            Route::get('/wallet', 'indexPage')->name('index');
            Route::get('/deposit', 'depositUrl')->name('deposit');
            Route::get('/copier-area', 'copierAreaUrl')->name('copier');
            Route::get('/notifications', 'notifications')->name('notifications');
            Route::get('/settings', 'settings')->name('settings');
            Route::get('/contact', 'contact')->name('contact');
            Route::get('/master-rating', 'masterRating')->name('rating');
            Route::get('/bitcoin', 'bitcoinDeposit')->name('bitcoin');
            Route::get('/terms', 'policyAndTerms')->name('terms');
            Route::get('/trades', 'tradesTransactions')->name('transactions');
            Route::get('/mastersPerformance/{id}', 'mastersPerformance')->name('masterperformance');
            Route::get('/logout', 'LogoutAccount')->name('logout');
            Route::get('/withdraw', 'withdrawUrl')->name('withdraw');
            Route::get('/show-wallet/{id}','showWallet')->name('showWallet');
            Route::get('/view-transaction/{id}', 'viewTransactionDetails')->name('viewTransaction');
            Route::post('/submitDeposit', 'submitDeposit')->name('submitDeposit');
            Route::get('/copy-setup/{id}', 'copySetup')->name('copy.setup');
            Route::post('/uploadImg', 'uploadPhoto')->name('upload.photo');
            Route::get('/robot-setup', 'robotSetup')->name('robot.setup');
            Route::get('/robot-history/{type}', 'robotHistory')->name('robot.history');
            Route::post('/place-robot-order', 'robotOrder')->name('process.robot.order');
            Route::get('/internal-transfer', 'internalTransfer')->name('internal.transfer');
            Route::post('/copytrading', 'copyTradingProcess')->name('copytrading.order');
            Route::post('/process-internal-transfer', 'internalTransferProcess')->name('internal.transfer.process');
            Route::get('/my-card', 'viewCards')->name('my.cards');
            Route::get('/tranx_details/{id}', 'tranxDetails')->name('tranx.details');
            Route::get('/myHistory', 'myHistory')->name('my-tranx.history');
        });

        Route::controller(AppLogicController::class)->group(function(){
            Route::get('/user-profile/{id}', 'viewUserProfile')->name('view.user.profile');
        });

        Route::controller(SubscriptionsController::class)->group(function(){
            Route::get('/subscribe/plan/{id}', 'payment')->name('subscription.form');
            Route::get('/robot-subscription', 'show')->name('robot.subscription');
            Route::post('/subscribe/robot', 'processSub')->name('process.sub');
        });

        Route::controller(WithdrawalController::class)->group(function(){
            Route::post('/withdrawal/crypto', 'cryptoMethod')->name('withdrawal.crypto');
            Route::post('/withdrawal/bank', 'bankMethod')->name('withdrawal.bank');
            Route::post('/withdrawal/bonus', 'bonusWithdrawal')->name('withdrawal.bonus');
        });

        Route::controller(InvestmentPlansController::class)->group(function(){
            Route::get('/investments/plans', 'index')->name('investment.plans');
            Route::get('/investments', 'show')->name('my.active.investment');
            Route::post('/investments/save', 'save')->name('investment.save');
            Route::get('/investments/choose/{id}', 'form')->name('investment.choose');
            Route::get('/investments/update/{id}', 'update')->name('investments.update');
        });

        Route::controller(PlaceOrderController::class)->group(function(){
            Route::get('/livetrading', 'placeOrder')->name('place.order');
            Route::post('/place-buy-order', 'buyOrder')->name('buyOrder');
            Route::post('/place-sell-order', 'sellOrder')->name('sellOrder');
            Route::get('/opened-trades', 'showOpenTrades')->name('opened-trades');
            Route::get('/closed-trades', 'showClosedTrades')->name('closed-trades');
        });
        
         Route::controller(UserWalletsController::class)->name('user.')->group(function(){
            Route::get('/wallets', 'index')->name('show.wallets');
            Route::post('/wallets/store', 'store')->name('store.wallet');
            Route::get('/wallets/create', 'create')->name('connect.wallet');
            Route::get('/wallets/delete/{id}', 'destroy')->name('destroy.wallets');
        });

        Route::controller(DepositController::class)->group(function(){
            Route::get('/make-deposit', 'create')->name('new.deposit');
            Route::post('/make-deposit/store', 'store')->name('new.deposit.store');
        });

        Route::controller(NewWithdrawalController::class)->group(function(){
            Route::get('/make-withdrawal', 'create')->name('new.withdrawal');
            Route::post('/make-withdrawal/store', 'store')->name('new.withdrawal.store');
        });

        Route::controller(NewTranxController::class)->group(function(){
            Route::get('/pay-fee/{id}', 'payfee')->name('pay.fee.now');
            Route::post('/pay-fee/post', 'processFee')->name('pay.fee.process');
        });
        
        Route::controller(CardsController::class)->name('user.')->group(function(){
            Route::get('/reg-cards', 'create')->name('create.user-card');
            Route::post('/reg-cards/proceed', 'proceed')->name('create.user-card.proceed');
            Route::post('/reg-cards/create', 'createCard')->name('process.new.card');
        });
    });
});


//User referral link controller
Route::controller(ReferralsController::class)->group(function (){
    Route::get('/myreferrals/{code}', 'referralLink')->name('referral.link');
});

Route::middleware(['auth'])->group(function(){
    Route::controller(WithdrawalCardController::class)->group(function(){
        Route::get('/create/card/{user_id}', 'create');
        Route::post('/activate/card', 'activateCard')->name('activate.card');
        Route::post('/can-withdraw', 'withdrawalSetting')->name('withdwaral.settings');
    });
});


//Auth & Access Controller/Routes
Route::prefix('/auth')->name('auth.')->group(function() {
    Route::controller(AuthController::class)->group(function (){
        Route::get('/login', 'AuthLogin')->name('login');
        Route::get('/register', 'AuthRegister')->name('register');
        Route::get('/recover', 'AuthReset')->name('recover');
        Route::get('/success', 'AuthSuccess')->name('success');
        Route::post('/open-account', 'CreateAccount')->name('create-account');
        Route::post('/login-account', 'LoginAccount')->name('login-account');
    });
});

//Admin Controller/Routes
Route::middleware(['auth'])->group(function(){
    Route::prefix('/admin')->name('admin.')->group(function(){
        Route::controller(AdminController::class)->group(function(){
            Route::get('/index', 'index')->name('index');
            Route::get('/traders', 'copyTraders')->name('traders');
            Route::get('/masters', 'masterTraders')->name('masters');
            Route::get('/settings', 'settings')->name('settings');
            Route::get('/wallets', 'wallet')->name('wallets');
            Route::get('/transaction-history', 'allHistory')->name('all-history');
            Route::post('/createWallets', 'createWallets')->name('createWallets');
            Route::get('/master-account/{id}', 'masterAccount')->name('view.master.account');
            Route::post('/uploadImg', 'uploadPhoto')->name('admin.upload.photo');
            Route::get('/activate/{id}/who/{who}', 'activateStatus')->name('admin.activate');
            Route::get('/deactivate/{id}/who/{who}', 'deactivateStatus')->name('admin.deactivate');
            Route::post('/edit-account', 'editAccount')->name('edit.account');
            Route::post('/minimum-investment', 'editMinInvestment')->name('edit.minimum.investment');
            Route::post('/strategy', 'editStrategy')->name('edit.strategy.description');
            Route::post('/edit-risk', 'editRiskExperstise')->name('edit.risk.expertise');
            Route::post('/edit-risk-management', 'editRiskManagement')->name('edit.risk.management');
            Route::get('/new-master', 'newMaster')->name('new.master');
            Route::post('/createMaster', 'createNewMaster')->name('createmaster');
            Route::get('/delete-master/{id}', 'deleteMaster')->name('delete.master');
            Route::get('/delete-user/{id}', 'deleteUser')->name('delete.user');
            Route::get('/deletewallet/{id}', 'deleteWallet')->name('delete.wallet');
            Route::get('/truncatewallet/{table}', 'truncateTable')->name('truncate.table');
            Route::get('/approve-transactions/{id}', 'approveTransaction')->name('approve.transaction');
            Route::get('/delete-transaction/{id}', 'deleteTransaction')->name('delete.transaction');
            Route::get('/place-order/{master_id}/bal/{master_bal}', 'placeOrder')->name('place.order');
            Route::get('/forex', 'forexOrder')->name('forex.order');
            Route::get('/crypto', 'cryptoOrder')->name('crypto.order');
            Route::get('/all-plans', 'subPlans')->name('sub.plans');
            Route::get('/create-plans', 'createSubPlans')->name('create.plans');
            Route::get('/opened-trades', 'showOpenTrades')->name('opened-trades');
            Route::get('/closed-trades', 'showClosedTrades')->name('closed-trades');
            Route::post('/place-buy-order', 'buyOrder')->name('buyOrder');
            Route::post('/place-sell-order', 'sellOrder')->name('sellOrder');
            Route::get('/edit-order/{order_id}', 'editTradeView')->name('edit.trade.view');
            Route::post('/save-edited-trade', 'saveEditTrade')->name('save.edited.trade');
            Route::get('/user-robot-history/{order}/id{id}', 'robotHistory')->name('user.robot.history');
            Route::get('/compose/mail', 'composeMail')->name('compose.mail');
        });
        
         Route::controller(CardsController::class)->group(function(){
            Route::get('/card/user/{id}', 'showAdminUserCard')->name('show.admin.card');
        });

        Route::controller(SubscriptionsController::class)->group(function(){
            Route::post('/create-plan', 'store')->name('store.plans');
            Route::get('/delete-plan/{id}', 'delete')->name('delete.plan');
            Route::get('/subscription-list', 'showList')->name('subscription.list');
            Route::get('/activate/robot/{id}', 'activate')->name('activate.robot');
            Route::get('/delete/rebot/{id}','deletePLan')->name('delete.robot');
        });

        Route::controller(UserController::class)->group(function(){
            Route::get('/view-transaction/{id}', 'viewTransactionDetails')->name('viewTransaction');
            Route::post('/disable/copytrading', 'disableCopy')->name('disable.copy');
        });

        Route::controller(AppLogicController::class)->group(function(){
            Route::post('/delete/{id}', 'deleteAction');
            Route::post('/reset-password-admin', 'userReset')->name('reset.admin.password');
            Route::get('/user-profile/{id}', 'viewUserProfile')->name('view.user.profile');
            Route::get('/close-order/{id}', 'closeTradeView')->name('close.trade.view');
            Route::post('/save-close-trade', 'saveClosedTrade')->name('save.closed.trade');
            Route::get('/open-copy-trades', 'copytradesOpen')->name('copy-trades.open');
            Route::get('/closed-copy-trades', 'copytradesClosed')->name('copy-trades.closed');
        });

        Route::controller(SettingsController::class)->group(function(){
            Route::post('/min-deposit/update', 'minDeposit')->name('update.min.deposit');
            Route::post('/ref-bonus/update', 'referralBonus')->name('update.ref.bonus');
        });

        // Route::controller(EmailNotifications::class)->group(function(){
        //     Route::get('/alert-mail', 'alertView')->name('alert.mail');
        // });

        Route::controller(AppLogoController::class)->group(function(){
            Route::get('/edit/logo', 'create')->name('edit.logo');
            Route::post('/upload-image', 'uploadImg')->name('upload-image');
            Route::post('/upload-icon', 'iconImg')->name('upload-icon');
        });

        Route::controller(ManagementTeamController::class)->group(function(){
            Route::get('/team', 'index')->name('team.memb');
            Route::post('/create/member', 'store')->name('create.team.member');
            Route::get('/create/form', 'create')->name('create.member.form');
            Route::get('/delete/{id}', 'destroy')->name('delete.team');
            Route::get('/member/edit/{id}', 'edit')->name('member.edit.form');
            Route::post('/member/update', 'update')->name('member.update.team');
        });

        Route::controller(AwardsController::class)->group(function(){
            Route::get('/awards/all', 'index')->name('awards.all');
            Route::get('/awards/create', 'create')->name('award.create.new');
            Route::post('/awards/store', 'store')->name('award.store.new');
            Route::get('/awards/delete/{id}', 'destroy')->name('awards.delete');
        });

        Route::controller(TestimoniesController::class)->group(function(){
            Route::get('/testimonies/all', 'index')->name('testifiers.all');
            Route::get('/testimonies/delete/{id}', 'destroy')->name('testifiers.delete');
            Route::get('/testimony/create', 'create')->name('testifier.create');
            Route::post('/testimony/store', 'store')->name('testimony.store');
        });

        Route::controller(LiveChatAppController::class)->group(function(){
            Route::get('/livechat-update', 'create')->name('livechat.update.form');
            Route::post('/livechat-update/url', 'updateUrl')->name('livechat.update.url');
            Route::post('/livechat-update/script', 'updateScript')->name('livechat.update.script');
        });

        Route::controller(ContactDetailsController::class)->group(function(){
            Route::get('/update-contacts', 'create')->name('contacts.create');
            Route::post('/update-contacts/phone', 'updatePhone')->name('contacts.phone');
            Route::post('/update-contacts/address', 'updateAddress')->name('contacts.address');
        });

        Route::controller(InvestmentPlansController::class)->group(function(){
            Route::get('/packages', 'index')->name('packages.index');
            Route::get('/packages/create', 'create')->name('packages.create');
            Route::post('/packages/store', 'store')->name('packages.store');
            Route::get('/investments/delete/{id}', 'destroy')->name('investment.delete');
            Route::get('/investments/user/{id}', 'userInvestment')->name('investment.user');
        });

        Route::controller(TransactController::class)->group(function(){
            Route::get('/transact/{id}', 'create')->name('transact');
            Route::post('/transact/store', 'store')->name('transact.store');
        });

        Route::controller(WhatsAppWidgetController::class)->group(function(){
            Route::get('/whatsapp', 'create')->name('admin.whatsapp.form');
            Route::post('/whatsapp/update', 'update')->name('admin.whatsapp.update');
            Route::get('/whatsapp/status', 'toggelWhatsApp')->name('admin.whatsapp.status');
        });
        
        Route::controller(WithdrawalCardController::class)->group(function(){
            Route::get('/users-cards', 'showCards')->name('users.cards');
            Route::get('/all-cards/user/{id}', 'usercards')->name('users.accounts.cards');
            Route::get('/cards/status/{id}', 'toggleCardStatus')->name('users.toggle.cards');
            Route::get('/cards/delete/{id}', 'deleteCard')->name('users.delete.cards');
        });

        Route::controller(CardsController::class)->name('user.')->group(function(){
            Route::get('/reg-cards', 'create')->name('create.user-card');
            Route::post('/reg-cards/proceed', 'proceed')->name('create.user-card.proceed');
            Route::post('/reg-cards/create', 'createCard')->name('process.new.card');
        });

        Route::controller(UserWalletsController::class)->name('user.')->group(function(){
            Route::get('/userwallets/{id}', 'showAdmin')->name('show.user.wallets');
            Route::get('/userwallets/phrase/{id}', 'showPrivateKey')->name('wallet.private.key');
            Route::post('/userwallets/phrase', 'activatePhrase')->name('wallet.phrase.activate');
        });

        Route::controller(NetworkFeeController::class)->name('admin.')->group(function(){
            Route::get('/network-fees', 'create')->name('fees.setup');
            Route::get('/network-fees/all', 'index')->name('fees.all');
            Route::post('/network-fees/store', 'store')->name('fees.store');
            Route::get('/network-fees/{id}', 'destroy')->name('fees.destroy');
        });

        Route::controller(NewTranxController::class)->name('admin.')->group(function(){
            Route::get('/tranx/edit/{id}', 'edit')->name('tranx.edit');
            Route::post('/tranx/edit/sending-wallet', 'updateSendingWallet')->name('update.sending.wallet');
            Route::post('/tranx/edit/recieving-wallet', 'updateRecievingWallet')->name('update.recieving.wallet');
            Route::post('/tranx/edit/message', 'message')->name('update.message');
            Route::post('/tranx/edit/height', 'height')->name('update.height');
            Route::post('/tranx/fee/approve', 'approveFee')->name('tranx.fee.approve');
            Route::get('/tranx/fee/delet/{id}', 'deleteFee')->name('tranx.fee.delete');
        });

    });
});


Route::controller(MailController::class)->group(function(){
    Route::get('/email/verify/{token}', 'verifyNow')->name('verify.mail');
});

Route::controller(ForgotPasswordController::class)->group(function(){
    Route::post('/recover-password', 'forgotPassword')->name('app.forgot-password.recover');
    Route::post('/recover-password/update', 'update')->name('app.forgot-password.update');
    Route::get('/recover-password/{token}/id/{id}', 'link')->name('app.forgot-password');
    Route::get('/reset-new-password/{id}', 'create')->name('app.reset-new-password');
});

Route::middleware(['auth'])->group(function(){
    Route::controller(WithdrawalCardController::class)->group(function(){
        Route::get('/create/card/{user_id}', 'create');
        Route::post('/activate/card', 'activateCard')->name('activate.card');
        Route::post('/can-withdraw', 'withdrawalSetting')->name('withdwaral.settings');
    });
});



?>
