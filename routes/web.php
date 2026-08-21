<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return "All caches cleared!";
});


Route::get('about', function () {
    return view('about');
});
Route::get('team', function () {
    return view('team');
});
Route::get('careers', function () {
    return view('careers');
});
Route::get('faq', function () {
    return view('faq');
});
//accounts
Route::get('accounts', function () {
    return view('accounts');
});
Route::get('account-savings', function () {
    return view('account-savings');
});
Route::get('account-current', function () {
    return view('account-current');
});
Route::get('account-fd', function () {
    return view('account-fd');
});
Route::get('account-salary', function () {
    return view('account-salary');
});
Route::get('cards', function () {
    return view('cards');
});
Route::get('credit', function () {
    return view('credit');
});
Route::get('step-up', function () {
    return view('step-up');
});
Route::get('fetch-qr/{agent_code}', 'AdminController@getagentqr');
Route::get('download-page', 'AdminController@downloadagentqr');
Route::get('/','PublicController@getHomePage');

//loan
Route::get('/loan/{url}','LoanController@getHomeLoan');
Route::post('/loan/{url}','LoanController@postHomeLoan');

// Route::get('personal-loan','LoanController@getPersonalLoan');
// Route::post('personal-loan','LoanController@postPersonalLoan');

// Route::get('vehicle-loan','LoanController@getVehicleLoan');
// Route::post('vehicle-loan','LoanController@postVehicleLoan');

// Route::get('education-loan','LoanController@getEducationLoan');
// Route::post('education-loan','LoanController@postEducationLoan');

// Route::get('business-loan','LoanController@getBusinessLoan');
// Route::post('business-loan','LoanController@postBusinessLoan');

// Route::get('gold-loan','LoanController@getGoldLoan');
// Route::post('gold-loan','LoanController@postGoldLoan');




//Route::post('check-customer', 'BankController@postcheckcustomer')->name('check-customer');

Auth::routes();
Route::get('register-agent','AgentController@getagent');
Route::post('registeragent','AgentController@postAddagent');

Route::get('agent-otp/{id}','AgentController@getagentotp');
Route::get('/resent-otp/{user_id}', 'AgentController@resentOtp')->name('resentOtp');
Route::post('agent','AgentController@postagentotp');

Route::get('agent-kyc/{id}','AgentController@getagentkyc');
Route::post('agent-kyc','AgentController@postagentkyc');


Route::post('sendnotificationdetails', ['middleware' =>'auth', 'uses' =>'NotificationController@sendnotificationdetails']);
Route::post('select1', ['middleware' => 'auth','uses' => 'PublicController@postselect1']);
Route::post('sendbankid','PublicController@getbankid');

Route::get('/reset-password/{token}', 'ResetPasswordController@showResetPasswordForm')->name('password.reset');
Route::post('/reset-password', 'ResetPasswordController@resetPassword');

Route::get('register-user','PublicController@getuser');
Route::post('registeruser','PublicController@postAdduser');

Route::get('contact','ContactController@getContact');
Route::post('contact','ContactController@postContact');

Route::get('logout',['middleware' => 'auth', 'uses' =>'PublicController@getLogout']);



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/export-users',[App\Http\Controllers\ReportController::class,'exportUsers'])->name('export-users');
Route::get('/export-services',[App\Http\Controllers\AdminController::class,'exportServices'])->name('export-services');
Route::get('/export-sub-services',[App\Http\Controllers\AdminController::class,'exportSubservices'])->name('export-sub-services');
Route::get('/export-bank',[App\Http\Controllers\BankController::class,'exportBank'])->name('export-bank');
Route::get('/export-commission',[App\Http\Controllers\CommissionController::class,'exportCommission'])->name('export-commission');
Route::get('/export-notification',[App\Http\Controllers\NotificationController::class,'exportNotification'])->name('export-notification');
Route::get('/admin/cibil/export', [App\Http\Controllers\CibilController::class, 'export'])->name('admin.cibil.export');
Route::get('/admin/bank-clicks/export', [App\Http\Controllers\BankClickController::class, 'export'])->name('admin.bank-clicks.export');
// Route::get('import/file-import',[PincodeController::class,'importView'])->name('file-import');
Route::get('admin/direct-services', 'AdminController@getServices');

Route::get('admin/direct-services/{url}', 'AdminController@getserviceType');

Route::get('admin/direct-services/bank/{id}', 'BankController@getusersignin');
Route::post('admin/direct-services/bank/{id}', 'BankController@postusersignin');

Route::get('admin/direct-services/select-bank/{id}','BankController@getBanks');

Route::get('admin/direct-services/form/apply-user','AdminController@getusernew');
Route::post('admin/direct-services/form/apply-user', 'AdminController@postusernew');

Route::get('admin/direct-services/otp/{id}','BankController@getotp');
Route::post('admin/direct-services/otp/{id}','BankController@postotp');
Route::post('resend-otp', 'BankController@resendOtp')->name('resendOtp');

Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function(){
	
	Route::group(['prefix' => 'user',  'middleware' => 'auth'], function(){
		Route::get('all', ['middleware' =>'auth', 'uses' =>'UserController@getAlluser']);
		Route::get('allData', ['middleware' =>'auth', 'uses' =>'UserController@getAlluserdata']);
		Route::get('add', ['middleware' =>'auth', 'uses' =>'UserController@getAdduser']);
		Route::post('add', ['middleware' =>'auth', 'uses' =>'UserController@postAdduser']);
		Route::get('{id}', ['middleware' =>'auth', 'uses' =>'UserController@getEdituser']);
		Route::post('{id}', ['middleware' =>'auth', 'uses' =>'UserController@postEdituser']);
		});
	
	Route::group(['prefix' => 'commission',  'middleware' => 'auth'], function(){
	Route::get('all', ['middleware' =>'auth', 'uses' =>'CommissionController@getAllCommission']);
	Route::get('allData', ['middleware' =>'auth', 'uses' =>'CommissionController@getAllCommissiondata']);
	Route::get('add', ['middleware' =>'auth', 'uses' =>'CommissionController@getAddCommission']);
	Route::post('add', ['middleware' =>'auth', 'uses' =>'CommissionController@postAddCommission']);
	Route::get('{id}', ['middleware' =>'auth', 'uses' =>'CommissionController@getEditCommission']);
	Route::post('{id}', ['middleware' =>'auth', 'uses' =>'CommissionController@postEditCommission']);
	});
		Route::group(['prefix' => 'agent-commission',  'middleware' => 'auth'], function(){
		Route::get('all', ['middleware' =>'auth', 'uses' =>'AgentCommissionController@getAllagentCommission']);
		Route::get('allData', ['middleware' =>'auth', 'uses' =>'AgentCommissionController@getAllagentCommissiondata']);
		Route::get('add', ['middleware' =>'auth', 'uses' =>'AgentCommissionController@getAddagentCommission']);
		Route::post('add', ['middleware' =>'auth', 'uses' =>'AgentCommissionController@postAddagentCommission']);
		Route::get('{id}', ['middleware' =>'auth', 'uses' =>'AgentCommissionController@getEditagentCommission']);
		Route::post('{id}', ['middleware' =>'auth', 'uses' =>'AgentCommissionController@postEditagentCommission']);
		});
	Route::group(['prefix' => 'training',  'middleware' => 'auth'], function(){
	Route::get('all', ['middleware' =>'auth', 'uses' =>'TrainingController@getAllTraining']);
	Route::get('allData', ['middleware' =>'auth', 'uses' =>'TrainingController@getAllTrainingdata']);

	Route::get('add', ['middleware' =>'auth', 'uses' =>'TrainingController@getAddTraining']);
	Route::post('add', ['middleware' =>'auth', 'uses' =>'TrainingController@postAddTraining']);
	Route::get('{id}', ['middleware' =>'auth', 'uses' =>'TrainingController@getEditTraining']);
	Route::post('{id}', ['middleware' =>'auth', 'uses' =>'TrainingController@postEditTraining']);
	});
		Route::group(['prefix' => 'notification',  'middleware' => 'auth'], function(){
		Route::get('all', ['middleware' =>'auth', 'uses' =>'NotificationController@getAllNotification']);
		Route::get('allData', ['middleware' =>'auth', 'uses' =>'NotificationController@getAllNotificationdata']);

		Route::get('add', ['middleware' =>'auth', 'uses' =>'NotificationController@getAddNotification']);
		Route::post('add', ['middleware' =>'auth', 'uses' =>'NotificationController@postAddNotification']);
		Route::get('{id}', ['middleware' =>'auth', 'uses' =>'NotificationController@getEditNotification']);
		Route::post('{id}', ['middleware' =>'auth', 'uses' =>'NotificationController@postEditNotification']);

		});
		Route::group(['prefix' => 'role',  'middleware' => 'auth'], function(){
			Route::get('all', ['middleware' =>'auth', 'uses' =>'RoleController@getAllRole']);
			Route::get('allData', ['middleware' =>'auth', 'uses' =>'RoleController@getAllRoledata']);
			Route::get('add', ['middleware' =>'auth', 'uses' =>'RoleController@getAddRole']);
			Route::post('add', ['middleware' =>'auth', 'uses' =>'RoleController@postAddRole']);
			Route::get('{id}', ['middleware' =>'auth', 'uses' =>'RoleController@getEditRole']);
			Route::get('{id}/allData', ['middleware' =>'auth', 'uses' =>'RoleController@getEditRolealldata']);
			Route::post('{id}', ['middleware' =>'auth', 'uses' =>'RoleController@postEditRole']);
			Route::post('delete/postdeletepermissionRole', ['middleware' =>'auth', 'uses' =>'RoleController@postdeletepermissionRole']);

	
			});
			Route::group(['prefix' => 'walletreason',  'middleware' => 'auth'], function(){
				Route::get('all', ['middleware' =>'auth', 'uses' =>'WalletreasonController@getAllreason']);
				Route::get('allData', ['middleware' =>'auth', 'uses' =>'WalletreasonController@getAllDatareason']);
				Route::get('add', ['middleware' =>'auth', 'uses' =>'WalletreasonController@getAddreason']);
				Route::post('add', ['middleware' =>'auth', 'uses' =>'WalletreasonController@postAddreason']);
				Route::get('{id}', ['middleware' =>'auth', 'uses' =>'WalletreasonController@getEditreason']);
				Route::post('{id}', ['middleware' =>'auth', 'uses' =>'WalletreasonController@postEditreason']);
		
				});
				
			Route::group(['prefix' => 'sub-agent',  'middleware' => 'auth'], function(){
				Route::get('all', ['middleware' =>'auth', 'uses' =>'SubagentController@getAllsubagent']);
				Route::get('allData', ['middleware' =>'auth', 'uses' =>'SubagentController@getAllDatasubagent']);
				Route::get('add', ['middleware' =>'auth', 'uses' =>'SubagentController@getAddsubagent']);
				Route::post('add', ['middleware' =>'auth', 'uses' =>'SubagentController@postAddsubagent']);
				Route::get('{id}', ['middleware' =>'auth', 'uses' =>'SubagentController@getEditsubagent']);
				Route::post('{id}', ['middleware' =>'auth', 'uses' =>'SubagentController@postEditsubagent']);
		
				});

			Route::group(['prefix' => 'pincode',  'middleware' => 'auth'], function(){
			Route::get('all', ['middleware' =>'auth', 'uses' =>'PincodeController@getAllPincode']);
			Route::get('allData', ['middleware' =>'auth', 'uses' =>'PincodeController@getAllPincodedata']);
			Route::get('add', ['middleware' =>'auth', 'uses' =>'PincodeController@getAddPincode']);
			Route::post('add', ['middleware' =>'auth', 'uses' =>'PincodeController@postAddPincode']);
			Route::get('import/file-import', ['middleware' =>'auth', 'uses' =>'PincodeController@importView']);
			Route::post('import/import-pincode',[App\Http\Controllers\PincodeController::class,'importPincode'])->name('import-pincode');
			Route::get('export/export-pincode',[App\Http\Controllers\PincodeController::class,'exportPincode'])->name('export-pincode');
			Route::get('{id}', ['middleware' =>'auth', 'uses' =>'PincodeController@getEditPincode']);
			Route::post('{id}', ['middleware' =>'auth', 'uses' =>'PincodeController@postEditPincode']);

			});
	//MIS
			Route::get('mis', ['middleware' =>'auth', 'uses' =>'MisController@getAllMis']);
			Route::get('mis/allData', ['middleware' =>'auth', 'uses' =>'MisController@getAllMisData']);
			Route::get('mis/add', ['middleware' =>'auth', 'uses' =>'MisController@getAddMis']);
			Route::post('mis/addMis', ['middleware' =>'auth', 'uses' =>'MisController@postAddMis']);
			Route::get('mis/{id}', ['middleware' =>'auth', 'uses' =>'MisController@getEditMis']);
			Route::post('mis/{id}', ['middleware' =>'auth', 'uses' =>'MisController@postEditMis']);


	Route::get('approve/wallet/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getApproveWallet']);

	Route::get('wallet/all', ['middleware' =>'auth', 'uses' =>'AdminController@getAllWallet']);

	Route::get('wallet/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getAllWalletData']);

	//Redeem
	Route::get('redeem/all', ['middleware' =>'auth', 'uses' =>'AdminController@getAllRedeem']);

	Route::get('redeem/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getAllRedeemData']);

	//Branch details
	Route::get('user/userbranch/all/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getAllBranch']);

	Route::get('user/userbranch/allData/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getAllBranchData']);

	Route::get('partner/partnerloan/all/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getAllPartnerLoan']);

	Route::get('partner/partnerloan/allData/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getAllPartnerLoanData']);

	
	Route::get('dashboard', ['middleware' =>'auth', 'uses' =>'AdminController@getDashboard']);
	Route::get('training', ['middleware' =>'auth', 'uses' =>'AdminController@gettraining']);
	Route::get('all-customers', ['middleware' =>'auth', 'uses' =>'AdminController@getallcustomers']);
	Route::get('all-customers/alldata', ['middleware' =>'auth', 'uses' =>'AdminController@getallcustomersalldata']);

	Route::get('all-notifications', ['middleware' =>'auth', 'uses' =>'NotificationController@getAllNotificationcontent']);
	// Route::post('sendnotificationdetails', ['middleware' =>'auth', 'uses' =>'NotificationController@sendnotificationdetail']);
	
    
	Route::get('change-password', ['middleware' =>'auth', 'uses' =>'PasswordController@showChangePasswordForm'])->name('password.change');
	Route::post('change-password', ['middleware' =>'auth', 'uses' =>'PasswordController@changePassword'])->name('password.update');

	Route::get('readnotify/{id}',['middleware' =>'auth', 'uses' =>'AdminController@getReadAdminNotify']);
	//Commission-------------------------
	Route::get('commission/allData', ['middleware' =>'auth', 'uses' =>'CommissionController@getAllCommissionData']);
	Route::get('commission-structure', ['middleware' =>'auth', 'uses' =>'AgentController@commissionstructure']);
	Route::get('agent-profile', ['middleware' =>'auth', 'uses' =>'AgentController@agentprofile']);
	Route::post('update-profile', ['middleware' =>'auth', 'uses' =>'AgentController@updateagentprofile']);
	

	//Edit Commission
	Route::get('commission/{id}', ['middleware' =>'auth', 'uses' =>'CommissionController@getEditCommission']);
	Route::post('commission/{id}', ['middleware' =>'auth', 'uses' =>'CommissionController@postEditCommission']);

	Route::get('property/add', ['middleware' =>'auth', 'uses' =>'PropertyController@getAddProperty']);
	Route::post('property/add', ['middleware' =>'auth', 'uses' =>'PropertyController@postAddProperty']);

	Route::get('property/all', ['middleware' =>'auth', 'uses' =>'PropertyController@getAllProperty']);
	Route::get('property/allData', ['middleware' =>'auth', 'uses' =>'PropertyController@getAllPropertyData']);
	Route::get('property/inactive/{id}', ['middleware' =>'auth', 'uses' =>'PropertyController@getDeleteProperty']);
	Route::get('property/active/{id}', ['middleware' =>'auth', 'uses' =>'PropertyController@getActiveProperty']);
	Route::get('property/{id}', ['middleware' =>'auth', 'uses' =>'PropertyController@getEditProperty']);
	Route::post('property/{id}', ['middleware' =>'auth', 'uses' =>'PropertyController@postEditProperty']);
	Route::get('property/remove_amenity/{id}', ['middleware' =>'auth', 'uses' =>'PropertyController@postDeleteAmenity']);
	Route::get('property/remove_propertyimage/{id}', ['middleware' =>'auth', 'uses' =>'PropertyController@postDeleteImage']);
	
	//Status
	Route::get('status/all', ['middleware' =>'auth', 'uses' =>'StatusController@getAllStatus']);
	Route::get('status/allData', ['middleware' =>'auth', 'uses' =>'StatusController@getAllStatusData']);
	Route::get('status/add', ['middleware' =>'auth', 'uses' =>'StatusController@getAddStatus']);
	Route::post('status/add', ['middleware' =>'auth', 'uses' =>'StatusController@postAddStatus']);
	Route::get('status/{id}', ['middleware' =>'auth', 'uses' =>'StatusController@getEditStatus']);
	Route::post('status/{id}', ['middleware' =>'auth', 'uses' =>'StatusController@postEditStatus']);
    

	//Bank
	Route::get('bank/add', ['middleware' =>'auth', 'uses' =>'BankController@getAddBank']);
	Route::post('bank/add', ['middleware' =>'auth', 'uses' =>'BankController@postAddBank']);
	Route::get('bank/all', ['middleware' =>'auth', 'uses' =>'BankController@getAllBank']);
	Route::get('bank/allData', ['middleware' =>'auth', 'uses' =>'BankController@getAllBankData']);
	Route::get('bank/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getEditBank']);
	Route::post('bank/{id}', ['middleware' =>'auth', 'uses' =>'BankController@postEditBank']);
	Route::get('bank/{id}/delete/all', ['middleware' =>'auth', 'uses' =>'BankController@getdeleteBankall']);
	Route::get('bank/{id}/{service_id}', ['middleware' =>'auth', 'uses' =>'BankController@getEditBankservices']);
	Route::post('bank/{id}/{service_id}', ['middleware' =>'auth', 'uses' =>'BankController@postEditBankservices']);
	

	Route::get('sub-services/add', ['middleware' =>'auth', 'uses' =>'AdminController@getAddsubservice']);
	Route::post('sub-services/add', ['middleware' =>'auth', 'uses' =>'AdminController@postAddsubservice']);
	Route::get('sub-services/all', ['middleware' =>'auth', 'uses' =>'AdminController@getallsubServices']);
	Route::get('sub-services/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getallsubServicesData']);
	Route::get('sub-services/edit/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@geteditsubservice']);
	Route::post('sub-services/edit/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@posteditsubservice']);

	// Route::get('bank/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getAllBankData']);
	
	Route::get('bank/inactive/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getDeleteBlog']);
	Route::get('bank/active/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getActiveBank']);
	Route::get('bank/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getEditBank']);
	Route::post('bank/{id}', ['middleware' =>'auth', 'uses' =>'BankController@postEditBank']);
    Route::get('bank/inactive/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getInactiveBank']);
	Route::get('bank/active/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getActiveBank']);
		//* Blog

	Route::get('blog/add', ['middleware' =>'auth', 'uses' =>'BlogController@getAddBlog']);
	Route::post('blog/add', ['middleware' =>'auth', 'uses' =>'BlogController@postAddBlog']);
	
		Route::get('delete/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getDeleteAdmin']);

	Route::get('blog/all', ['middleware' =>'auth', 'uses' =>'BlogController@getAllBlog']);
	Route::get('blog/allData', ['middleware' =>'auth', 'uses' =>'BlogController@getAllBlogData']);
	Route::get('blog/inactive/{id}', ['middleware' =>'auth', 'uses' =>'BlogController@getDeleteBlog']);
	Route::get('blog/active/{id}', ['middleware' =>'auth', 'uses' =>'BlogController@getActiveBlog']);
	Route::get('blog/{id}', ['middleware' =>'auth', 'uses' =>'BlogController@getEditBlog']);
	Route::post('blog/{id}', ['middleware' =>'auth', 'uses' =>'BlogController@postEditBlog']);

	Route::get('mutual-fund/add', ['middleware' =>'auth', 'uses' =>'AdminController@getAddMutualFund']);
	Route::post('mutual-fund/add', ['middleware' =>'auth', 'uses' =>'AdminController@postAddMutualFund']);
	Route::get('apply_now/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLApplyNow']);
	Route::get('apply_now/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getAllApplyNowData']);

	Route::get('term_insurance/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLTermInsurance']);
	Route::get('term_insurance/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getAllTermInsuranceData']);

	Route::get('health_insurance/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLHealthInsurance']);
	Route::get('health_insurance/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getALLHealthInsuranceData']);

	Route::get('services/form/apply-user', ['middleware' =>'auth', 'uses' =>'AdminController@getusernew']);
	Route::post('services/form/apply-user', ['middleware' =>'auth', 'uses' =>'AdminController@postusernew']);
	// Route::post('getapply-user-detail', ['middleware' =>'auth', 'uses' =>'AdminController@postusernewdetail']);
	Route::get('document-upload/{loanid}', ['middleware' =>'auth', 'uses' =>'AdminController@getdocuments']);
	Route::post('document-upload/{loanid}', ['middleware' =>'auth', 'uses' =>'AdminController@postdocuments']);
	Route::post('document-load/delete', ['middleware' =>'auth', 'uses' =>'AdminController@postdeletedocuments']);

	//Documents Pending
	Route::get('docpendingall', ['middleware' =>'auth', 'uses'=>'AdminController@getDocPendinglLoanAll']);
	Route::get('docpendingallData', ['middleware' =>'auth', 'uses' =>'AdminController@getDocPendingLoanAllData']);

	//Pending Loans---------------------
	Route::get('pendingall', ['middleware' =>'auth', 'uses'=>'AdminController@getPendinglLoanAll']);
	Route::get('pendingallData', ['middleware' =>'auth', 'uses' =>'AdminController@getPendingLoanAllData']);
	Route::get('loanDetails/{id}', ['middleware' =>'auth', 'uses'=>'AdminController@getLoanDetails']);

	Route::get('deletecomment/{id}', ['middleware' =>'auth', 'uses'=>'AdminController@postDeleteComment']);
	Route::get('delete_document/{id}', ['middleware' =>'auth', 'uses'=>'AdminController@postDeleteDocument']);

	//Approved Loans-----------------------
	Route::get('approvedall', ['middleware' =>'auth', 'uses'=>'AdminController@getApprovedLoanAll']);
	Route::get('approvedallData', ['middleware' =>'auth', 'uses' =>'AdminController@getApprovedLoanAllData']);


	//Rejected Loans------------------
	Route::get('rejectedall', ['middleware' =>'auth', 'uses' =>'AdminController@getRejectedLoanAll']);
	Route::get('rejectedallData', ['middleware' =>'auth', 'uses' =>'AdminController@getRejectedLoanAllData']);

	//Show Notifications
	Route::get('notificationall', ['middleware' =>'auth', 'uses' =>'AdminController@getAdminNotificationAll']);

	//Loan Status Change-----------------------
	Route::post('loaninprocess/{id}', 'AdminController@postStatusLoanInprocess');
	Route::get('loanrejected/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@postStatusLoanRejected']);
	Route::get('loanapproved/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@postStatusLoanApproved']);
	Route::post('loandocpending/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@postStatusLoanDocPending']);

   

	Route::post('sendcomment', ['middleware' =>'auth', 'uses' =>'AdminController@postSendComment']);

	

	Route::get('mutual_fund/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLMutualFund']);
	Route::get('mutual_fund/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getALLMutualFundData']);


	Route::get('refer_earn/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLReferEarn']);
	Route::get('refer_earn/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getALLReferEarnData']);

    Route::get('referal_tools/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLReferalTool']);
	Route::get('referal_tools/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getALLReferalToolData']);
	
	Route::get('property_lead/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLPropertyLead']);
	Route::get('property_lead/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getALLPropertyLeadData']);
	
	// Route::get('user/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLUser']);
	// Route::get('user/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getALLUserData']);


	Route::get('partner/all', ['middleware' =>'auth', 'uses' =>'AdminController@getALLPartner']);
	Route::get('partner/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getALLPartnerData']);

	Route::get('get_started/all', ['middleware' =>'auth', 'uses' =>'AdminController@getAllGetStarted']);
	Route::get('get_started/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getAllGetStartedData']);

   
   
   	Route::get('admin/add', ['middleware' =>'auth', 'uses' =>'AdminController@getAddAdmin']);
	Route::post('admin/add', ['middleware' =>'auth', 'uses' =>'AdminController@postAddAdmin']);
	Route::get('admin/all', ['middleware' =>'auth', 'uses' =>'AdminController@getAllAdmin']);
	Route::get('admin/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getAllAdminData']);
//	Route::get('admin/inactive/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getDeleteAdmin']);
	Route::get('admin/active/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getActiveAdmin']);
	
	Route::get('user/status/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getStatusUser']);
	Route::get('admin/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getEditAdmin']);
	Route::post('admin/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@postEditAdmin']);
    
	

	Route::get('services', ['middleware' =>'auth', 'uses' =>'AdminController@getServices']);
	Route::get('service/add', ['middleware' =>'auth', 'uses' =>'AdminController@getaddServices']);
	Route::post('service/add', ['middleware' =>'auth', 'uses' =>'AdminController@postaddServices']);

	Route::get('support', ['middleware' =>'auth', 'uses' =>'SupportController@getagentcomplaint']);//agent
	Route::post('support', ['middleware' =>'auth', 'uses' =>'SupportController@postagentcomplaint']);//agent
	
	Route::get('help&support/all', ['middleware' =>'auth', 'uses' =>'SupportController@gethelpandSupport']);
	Route::get('help&support/allData', ['middleware' =>'auth', 'uses' =>'SupportController@gethelpandSupportData']);
	Route::get('help&support/{id}/delete/all', ['middleware' =>'auth', 'uses' =>'SupportController@getdeletesupportall']);
	
	Route::get('help&support/{id}', ['middleware' =>'auth', 'uses' =>'SupportController@getedithelpandSupport']);
	Route::post('help&support/{id}', ['middleware' =>'auth', 'uses' =>'SupportController@postedithelpandSupport']);

	Route::get('services/otp/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getotp']);
	Route::post('services/otp/{id}', ['middleware' =>'auth', 'uses' =>'BankController@postotp']);


	Route::get('services/select-bank/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getBanks']);
	Route::get('services/bank/{id}', ['middleware' =>'auth', 'uses' =>'BankController@getusersignin']);
	Route::post('services/bank/{id}', ['middleware' =>'auth', 'uses' =>'BankController@postusersignin']);
	Route::post('check-customer', ['middleware' =>'auth', 'uses' =>'BankController@postcheckcustomer'])->name('check-customer');
    // Route::post('check-customer', 'BankController@postcheckcustomer')->name('check-customer');
	Route::get('services/{url}', ['middleware' =>'auth', 'uses' =>'AdminController@getserviceType']);

	Route::get('service/all', ['middleware' =>'auth', 'uses' =>'AdminController@getallServices']);
	Route::get('service/allData', ['middleware' =>'auth', 'uses' =>'AdminController@getallServicesAllData']);
	
	Route::get('service/edit/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@geteditServices']);
	Route::post('service/edit/{id}', ['middleware' =>'auth', 'uses' =>'AdminController@getpostServices']);

	Route::get('services/cards', ['middleware' =>'auth', 'uses' =>'AdminController@getCards']);
	Route::get('services/bank/loan', ['middleware' =>'auth', 'uses' =>'AdminController@getLoan']);
	Route::get('services/bank/loan/otp', ['middleware' =>'auth', 'uses' =>'AdminController@getOtp']);

	Route::get('report/commision-report', ['middleware' =>'auth', 'uses' =>'ReportController@getcommisionreport']);
		Route::post('report/commision-report/remark', ['middleware' =>'auth', 'uses' =>'ReportController@postcommisionremark']);
	Route::get('report/commision-report/alldata', ['middleware' =>'auth', 'uses' =>'ReportController@getcommisionreportalldata']);
    Route::get('report/auto-import', [App\Http\Controllers\ReportController::class, 'autoImportFromEmail']);
	Route::get('report/customer-report', ['middleware' =>'auth', 'uses' =>'ReportController@getcustomerreport']);
	Route::get('report/import/file-loan-import', ['middleware' =>'auth', 'uses' =>'ReportController@importLoanView']);
	Route::post('report/import/import-loan',[App\Http\Controllers\ReportController::class,'importLoanreport'])->name('import-loan');
	Route::get('report/customer-reports/alldata', ['middleware' =>'auth', 'uses' =>'ReportController@getcustomerreportdata']);
	Route::get('report/customer-report/{id}', ['middleware' =>'auth', 'uses' =>'ReportController@getcustomer']);
    
	Route::post('report/customer-report/{id}', ['middleware' =>'auth', 'uses' =>'ReportController@postusernewdetail']);
	
	Route::get('report/agent-report', ['middleware' =>'auth', 'uses' =>'ReportController@getagentreport']);
	Route::get('report/agent-report/alldata', ['middleware' =>'auth', 'uses' =>'ReportController@getagentreportdata']);

	Route::get('report/agent-report-download', ['middleware' =>'auth', 'uses' =>'ReportController@downloadagentreport'])->name('export-users');
	Route::get('qrcode/{id}', ['middleware' =>'auth', 'uses' =>'ReportController@getagentqr']);
	Route::get('qrcodegenerator/{id}', ['middleware' =>'auth', 'uses' =>'ReportController@generator'])->name('generator');
	

	Route::get('report/{id}', ['middleware' =>'auth', 'uses' =>'ReportController@getagentdetail']);
	Route::get('report/{id}/allData', ['middleware' =>'auth', 'uses' =>'ReportController@getcustomeralldata']);

	Route::post('report/{id}', ['middleware' =>'auth', 'uses' =>'ReportController@postagentdetail']);
	
	Route::get('report/change-password/{id}', ['middleware' =>'auth', 'uses' =>'ReportController@getagentpassword']);
	Route::post('report/change-password/{id}', ['middleware' =>'auth', 'uses' =>'ReportController@postagentpassword']);	
	Route::get('reports/user-journey-report',['middleware' => 'auth','uses' => 'ReportController@userJourneyReport'])->name('admin.user.journey.report');

    Route::get('reports/user-journey-export', ['middleware' => 'auth', 'uses' => 'ReportController@userJourneyExport'])
     ->name('admin.reports.user-journey.export');
     
     
		Route::group(['prefix' => 'contact'], function(){
      
		Route::get('all', ['middleware' => 'auth','uses' => 'AdminController@getAllContact']);
		Route::get('allData', ['middleware' => 'auth','uses' => 'AdminController@getAllContactData']);
		

	});

});
Route::get('logout',['middleware' => 'auth', 'uses' =>'PublicController@getLogout']);

//contact-us
Route::get('/admin/user-contacts', [App\Http\Controllers\UserContactController::class, 'index'])->name('admin.user.contacts');
Route::get('/admin/user-contacts/export',[App\Http\Controllers\UserContactController::class, 'export'])->name('user.contacts.export');


//menu clicks count report
Route::get('/admin/menu-clicks', [App\Http\Controllers\MenuClickReportController::class, 'index'])->name('admin.menu.clicks');
Route::get('/admin/reports/menu-clicks/export',[App\Http\Controllers\MenuClickReportController::class, 'export'])->name('menu.clicks.export');


//insurance leads report
Route::get('/admin/insurance-leads', [App\Http\Controllers\InsuranceLeadController::class, 'index'])->name('admin.insurance.leads');
Route::get('/admin/insurance-leads/export',[App\Http\Controllers\InsuranceLeadController::class, 'export'])->name('insurance.leads.export');

//loan leads report
Route::get('/admin/loan-leads', [App\Http\Controllers\LoanLeadController::class, 'index'])->middleware('auth')->name('admin.loan.leads');
Route::get('/admin/loan-leads/export',[App\Http\Controllers\LoanLeadController::class, 'export'])->name('loan.leads.export');
Route::post('/admin/loan-leads/{id}/status', [App\Http\Controllers\LoanLeadController::class, 'updateStatus'])->name('loan.leads.updateStatus');


//Credit card lead report
Route::get('/admin/credit-card-leads', [App\Http\Controllers\CreditCardLeadController::class, 'index'])->middleware('auth')->name('admin.credit-cards.leads');
Route::get('/admin/credit-card-leads/export',[App\Http\Controllers\CreditCardLeadController::class, 'export'])->name('credit.card.leads.export');

Route::get('/admin/cibil-reports', [App\Http\Controllers\CibilController::class, 'index'])->name('admin.cibil.reports');
Route::get('/admin/cibil-reports/{id}', [App\Http\Controllers\CibilController::class, 'show'])->name('admin.cibil.details');
//Loan Application
Route::get('/admin/loan-applications', [App\Http\Controllers\LoanApplicationController::class, 'index'])->middleware('auth')->name('admin.loan.applications');
Route::get('/admin/loan-applications/export',[App\Http\Controllers\LoanApplicationController::class, 'export'])->name('loan.applications.export');
// show upload page
Route::get('/admin/loan-applications/{id}/documents',[App\Http\Controllers\LoanApplicationController::class, 'showDocumentUploadForm'])->name('loan-applications.documents');
Route::post('/admin/loan-applications/{id}/documents',[App\Http\Controllers\LoanApplicationController::class, 'uploadDocuments'])->name('loan-applications.upload-documents');
Route::post('/admin/loan-applications/{id}/approval',[App\Http\Controllers\LoanApplicationController::class, 'toggleApproval'])->middleware('auth')->name('loan-applications.toggle-approval');
Route::post('loan-applications/{id}/reject',[App\Http\Controllers\LoanApplicationController::class, 'reject'])->name('loan-applications.reject');
Route::get('/admin/loan-applications/{id}/document/{type}',[App\Http\Controllers\LoanApplicationController::class, 'viewDocument'])->middleware('auth');


//Loan service management
Route::get('/admin/loan-services', [App\Http\Controllers\LoanServiceController::class, 'index']);
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/loan-services', [App\Http\Controllers\LoanServiceController::class, 'index'])->name('admin.loan.services');
    Route::post('/loan-services', [App\Http\Controllers\LoanServiceController::class, 'store'])->name('admin.loan.services.store');
});
Route::post('admin/loan-services/field', [App\Http\Controllers\LoanServiceController::class, 'storeField'])->name('admin.loan.services.field.store');
Route::patch('/admin/loan-services/fields/{id}/toggle',[App\Http\Controllers\LoanServiceController::class, 'toggleField'])->name('admin.loan.services.field.toggle');
Route::patch('/admin/loan-services/{id}/toggle',[App\Http\Controllers\LoanServiceController::class, 'toggleService'])->name('admin.loan.services.toggle');
Route::get('/admin/bank-clicks', [App\Http\Controllers\BankClickController::class, 'index'])->name('admin.bank.clicks');

Route::get('/admin/send-notification',[App\Http\Controllers\NotificationWebController::class,'index']);
Route::post('/admin/send-notification',[App\Http\Controllers\NotificationWebController::class,'send']);
//Blogs
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [App\Http\Controllers\BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs', [App\Http\Controllers\BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/{blog}/edit', [App\Http\Controllers\BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{blog}', [App\Http\Controllers\BlogController::class, 'destroy'])->name('admin.blogs.destroy');
    
});
 Route::post('/admin/send-bulk-whatsapp', [App\Http\Controllers\AdminController::class, 'sendBulkWhatsapp'])
   ->name('admin.bulk.whatsapp');
// Route::post('admin/send-bulk-whatsapp', ['middleware' => 'auth', 'uses' => 'AdminController@sendBulkWhatsapp', 'as' => 'admin.bulk.whatsapp']);

Route::get('/check-imap', function () {
    return function_exists('imap_open') ? 'IMAP Enabled ' : 'IMAP NOT Enabled ❌';
});


Route::get('/test-imap', function () {
    try {
        $hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
        $username = env('GMAIL_USERNAME');
        $password = env('GMAIL_PASSWORD');

        $inbox = imap_open($hostname, $username, $password);

        if (!$inbox) {
            return 'Connection failed: ' . imap_last_error();
        }

        imap_close($inbox);

        return 'Gmail IMAP Connected Successfully ✅';

    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});
