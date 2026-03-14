<?php

use App\Http\Controllers\LoanPaymentHistoryReview;
use App\Http\Controllers\Otp;
use App\Models\SharedCapital;
// Guest

use App\Http\Controllers\cooplist;

use App\Http\Controllers\Loginbtn;
use App\Http\Controllers\register;
use App\Http\Controllers\OTPsubmit;
use App\Http\Controllers\AcceptLoan;

use App\Http\Controllers\adminlogin;
use App\Http\Controllers\FindMember;
use App\Http\Controllers\reviewpage;
use App\Http\Controllers\adminmanage;
use App\Http\Controllers\createstaff;
use App\Http\Controllers\LandingPage;
use App\Http\Controllers\loanRecords;
use App\Http\Controllers\MemberLogin;
use App\Http\Controllers\PaymentPage;
use Illuminate\Support\Facades\Route;

// Loan Page
use App\Http\Controllers\managemember;
use App\Http\Controllers\registration;
use App\Http\Controllers\loanDashboard;
use App\Http\Controllers\memberOTPpage;
use App\Http\Controllers\SubmitPayment;
use App\Http\Controllers\admindashboard;
use App\Http\Controllers\MemberListPage;
use App\Http\Controllers\MemberLoginBtn;
use App\Http\Controllers\ViewPastRecord;
use App\Http\Controllers\AddTransactions;





use App\Http\Controllers\admincreatestaff;
use App\Http\Controllers\LoanApplication1;
use App\Http\Controllers\ViewLoanAppFulll;
use App\Http\Controllers\AdminRegisMessege;



// to be change
use App\Http\Controllers\ApproveOrRejected;
use App\Http\Controllers\MemberLandingPage;
use App\Http\Controllers\redirectToLoanApp;
use App\Http\Controllers\registrationpage1;
use App\Http\Controllers\SharedCapitalList;
use App\Http\Controllers\ViewMemberDetails;
use App\Http\Controllers\loanpaymenthistory;
use App\Http\Controllers\redirectMemberForm;
use App\Http\Controllers\viewmembershipform;
use App\Http\Controllers\CreateSharedCapital;
use App\Http\Controllers\LoanAppConfirmation;
use App\Http\Controllers\registrationmessege;
use App\Http\Controllers\RedirectToLastRecord;
use App\Http\Controllers\LoanApplicationSubmit;
use App\Http\Controllers\RedirectBtnViewLoanApp;
use App\Http\Controllers\SaveSharedCapitalRecord;
use App\Http\Controllers\ViewSharedCapitalRecord;
use App\Http\Controllers\AdminSubmitMemberRegisForm;
use App\Http\Controllers\AdminMemberRegistrationForm;
use App\Http\Controllers\SharedCapitalPaymentHistory;
use App\Http\Controllers\LoanAppConfirmationRedirectBack;
use App\Http\Controllers\UpdateLoanRecord;
use App\Http\Controllers\viewMemberLoan;
use App\Http\Controllers\PayMongoController;
use App\Http\Controllers\ViewLoanReceipt;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MemberOTPVerify;
use App\Http\Controllers\UploadQRController;
use App\Http\Controllers\AccountSettings;
use App\Http\Controllers\ContactUs;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\ZipLookupController;
use App\Http\Controllers\MemberPasswordSetupController;
use App\Http\Controllers\MemberPasswordResetController;
use App\Http\Controllers\AdminSettingsController;



Route::get('/', function () {
    return view('welcome');
});


// Guest Routes
Route::get('/GBLDC', [LandingPage::class,'Landing'])->name('Landing.Page');
// Registration Form
Route::get('/Membership-Registration', [registration::class,'registration_page1'])->name('Registration.form1');

Route::post('/Registration-Processing', [registrationpage1::class,'registrationpage1'])->name('registration.Processing');
Route::get('/Registration-Success', [registrationmessege::class,'messege'])->name('registration.messege');

// ZIP lookup (City/Municipality → Zip Code)
Route::get('/zip-lookup', [ZipLookupController::class, 'lookup'])->name('zip.lookup');


Route::post('/Registration-submit', [register::class,'Register'] )->name('Registration.submit');


// Admin Login
Route::post('Login-button', [Loginbtn::class,'Login'])->name('Login.Btn');
Route::get('/OTP', [Otp::class,'OTPpage'])->name('Otp.Page');
Route::post('/OTP-Confirm', [OTPsubmit::class,'ConfirmOTP'])->name('OTP.Confirm');
Route::post('/OTP-Resend', [Otp::class,'resendOTP'])->name('OTP.Resend');
Route::get('/Login-Page', [adminlogin::class,'adminlogin'])->name('Admin.Login');
Route::get('/Admin-Logout', [LogoutController::class,'adminLogout'])->name('Admin.Logout');

// Admin Routes
Route::middleware(['auth:admin'])->group(function () {

Route::get('/Admin-Dashboards', [admindashboard::class,'adminDashboard'])->name('Admin.dashboard');
Route::post('/Admin-Upload-QR', [UploadQRController::class,'upload'])->name('admin.upload.qr');
Route::get('/Admin-Manage', [adminmanage::class,'adminmanage'])->name('Admin.manage');
Route::get('/Admin-Settings', [AdminSettingsController::class,'show'])->name('Admin.Settings');
Route::post('/Admin-Settings/Profile', [AdminSettingsController::class,'updateProfile'])->name('Admin.Settings.Profile');
Route::post('/Admin-Settings/Password', [AdminSettingsController::class,'updatePassword'])->name('Admin.Settings.Password');
Route::get('/Admin-Create-Staff', [admincreatestaff::class,'AdminCreate'])->name('Admin.form');
Route::post('/Admin-Create-Success', [createstaff::class,'createstaff'])->name('Create.staff');
Route::get('/Admin-Loan-Application-List', [cooplist::class,'List'])->name('LoanApp.list');

Route::get('/Manage-Member', [managemember::class,'managemember'])->name('Manage.Members');
Route::get('/Admin-Member-Registration-Form', [AdminMemberRegistrationForm::class,'AdminMemberRegisForm'])->name('Add.New.Member');
Route::post('Admin-Submit-Member-Registration-Form', [AdminSubmitMemberRegisForm::class,'AdminSubmitRegisMemForm'])->name('Admin.Submit.Mem.Regis');
Route::get('/Admin-Regitration-Success-Messege', [AdminRegisMessege::class,'AdminRegisMessege'])->name('Admin.Regis.Messege');
Route::post('/Approve', [ApproveOrRejected::class,'ApproveOrRejected'])->name('Approve.member');
Route::post('/Reject', [ApproveOrRejected::class,'Reject'])->name('Reject.member');
Route::get('/Redirect-View-Membership-Form/{id}', [redirectMemberForm::class,'redirectMF'])->name('redirect.Membershipform');
Route::get('/View-Membership-Form', [viewmembershipform::class,'ViewMF'])->name('Membership.Form');
Route::get('/Loan-Payment-History',[loanpaymenthistory::class,'LoanPH'])->name('History.LP');
Route::get('/Loan-Payment-History/{loan_number}',[loanpaymenthistory::class,'LoanPH'])->name('Loan.Payment.History');
Route::get('/Loan-Payment-History-Detail/{loan_number}',[loanpaymenthistory::class,'LoanPHDetail'])->name('Loan.Payment.History.Detail');
Route::get('/receipt/{id}',[loanpaymenthistory::class,'viewReceipt'])->name('view_receipt');
Route::get('/details/{id}',[loanpaymenthistory::class,'viewDetails'])->name('view_details');

// Member list
Route::get('/Member-List', [MemberListPage::class,'MemberList'])->name('Member.List');
Route::get('/View-Member-Details/{member_id}', [ViewMemberDetails::class,'viewDetails'])->name('View.Member.Details');

// Shared Capital List
Route::get('/Shared-Capital-List', [SharedCapitalList::class,'ViewSharedCapitalList'])->name('Shared.Capital.List.View');
Route::get('/View-Shared-Capital-Details/{member_id}', [SharedCapitalList::class,'viewSharedCapitalDetails'])->name('View.Shared.Capital.Details');
Route::get('/View-Shared-Capital-History/{member_id}', [SharedCapitalPaymentHistory::class,'ViewSHPH'])->name('View.SCP.History');
Route::post('/Mark-Shared-Capital-Fully-Paid/{member_id}', [SharedCapitalList::class,'markFullyPaid'])->name('Mark.Shared.Capital.Fully.Paid');
Route::get('/View-Shared-Capital-Payment-History-Detail/{member_id}', [SharedCapitalPaymentHistory::class,'ViewSHPHDetail'])->name('View.SCP.History.Detail');
Route::get('/shared-capital-receipt/{id}',[SharedCapitalPaymentHistory::class,'viewReceipt'])->name('shared_capital_receipt');
Route::get('/View-Shared-Capital-Record/{id}', [ViewSharedCapitalRecord::class,'ViewSCRecord'])->name('View.SC.Record');

// Add Transactions
Route::get('/Add-Transactions', [AddTransactions::class,'Transaction'])->name('Add.Transactions');
Route::get('/Find-Member', [FindMember::class,'findMember'])->name('Find.Member');
Route::post('/Find-Member', [FindMember::class,'findMemberPost'])->name('Find.Member.Post');
Route::post('/Find-Member-For-Loan', [FindMember::class,'findMemberForLoan'])->name('Find.Member.For.Loan');
Route::get('/Admin-Create-Loan/{member_id}', [LoanApplication1::class,'AdminLoanApplication'])->name('Admin.Create.Loan');
Route::post('/Admin-Loan-Submit', [LoanApplicationSubmit::class,'LoanAppSubmit'])->name('Admin.Loan.Submit');
Route::get('/Admin-Loan-Messege', [LoanAppConfirmation::class,'LoanConfirmation'])->name('Admin.Loan.Messege');
Route::get('/Admin-Shared-Capital-Form', [CreateSharedCapital::class,'ShareCapitalRecord'])->name('Shared.Capital.Form');
Route::post('/Save-Shared-Capital-Record', [SaveSharedCapitalRecord::class,'save'])->name('Save.Shared.Capital');

// Loan
Route::get('/Review-Loan-Application/{id}', [ViewLoanAppFulll::class,'ViewFullLoanApp'])->name('Review.LoanApp');
Route::get('/Member-Past-Record/{member_id}/{type?}', [RedirectToLastRecord::class,'LastRecord'])->name('Check.Last.Record');
Route::get('Review-Past-Record/{id}', [ViewPastRecord::class,'view'])->name('Review.Past.Record');
Route::post('/Accept-Loan', [AcceptLoan::class,'SaveLoan'])->name('Loan.Approval');
Route::get('/Loan-Receipt/{id}', [ViewLoanReceipt::class,'ViewLoanReceipt'])->name('View.Loan.Receipt');

Route::get('/Loan-Records', [loanRecords::class,'loans'])->name('Loan.Records');
Route::get('/View-Loan-Record/{loan_number}', [viewMemberLoan::class,'view'])->name('View.Member.Loan');

Route::get('/Update-Loan-Record/{loan_number}', [UpdateLoanRecord::class,'updateRecord'])->name('Update.Record');
Route::post('/Mark-Loan-Finished/{loan_number}', [UpdateLoanRecord::class,'markFinished'])->name('Mark.Loan.Finished');



//Payment
Route::get('/Loan-Records', [loanRecords::class,'loans'])->name('Loan.Records');
Route::get('/View-Loan-Record/{loan_number}', [viewMemberLoan::class,'view'])->name('View.Member.Loan');



//Payment
Route::get('/Payment', [PaymentPage::class,'Payment'])->name('Payment.Page');
Route::post('/Payment-Submit', [SubmitPayment::class,'pay'])->name('Payment.Submit');
Route::get('/member/lookup', [PaymentPage::class, 'memberLookup'])->name('Member.Lookup');


// PayMongo GCash Payment
Route::get('/paymongo/gcash', [PayMongoController::class, 'showGcashPage'])->name('paymongo_gcash_page');
Route::post('/paymongo/gcash/initiate', [PayMongoController::class, 'initiateGcashPayment'])->name('paymongo_gcash_initiate');
Route::get('/paymongo/success', [PayMongoController::class, 'handlePaymentSuccess'])->name('paymongo_success');
Route::get('/paymongo/failed', [PayMongoController::class, 'handlePaymentFailed'])->name('paymongo_failed');

// Manual GCash Payment Entry
Route::get('/paymongo/manual-gcash', [PayMongoController::class, 'showManualGcashPage'])->name('manual_gcash_page');
Route::post('/paymongo/manual-gcash/submit', [PayMongoController::class, 'submitManualGcashPayment'])->name('manual_gcash_submit');



});



// Member Login
Route::get('/Member-Login', [MemberLogin::class,'MemberLoginPage'])->name('Member.Login');
Route::post('/Member-Login-Submit', [MemberLoginBtn::class,'MemberLoginBtn'])->name('Member.LoginBtn');
Route::get('/Member-Forgot-Password', [MemberPasswordResetController::class, 'showForgot'])->name('Member.ForgotPassword');
Route::post('/Member-Forgot-Password', [MemberPasswordResetController::class, 'sendResetLink'])->name('Member.ForgotPassword.Send');
Route::get('/Member-Reset-Password/{token}', [MemberPasswordResetController::class, 'showReset'])->name('Member.ResetPassword');
Route::post('/Member-Reset-Password', [MemberPasswordResetController::class, 'reset'])->name('Member.ResetPassword.Save');
Route::get('/Member-OTP', [memberOTPpage::class,'MemberOTP'])->name('Member.OTPpage');
Route::post('/Member-OTP-Confirm', [MemberOTPVerify::class,'verifyMemberOTP'])->name('Member.OTP.Confirm');
Route::post('/Member-OTP-Resend', [memberOTPpage::class,'resendMemberOTP'])->name('Member.OTP.Resend');

// Member Routes
Route::middleware(['auth:officialmember'])->group(function () {
Route::get('/Member-Set-Password', [MemberPasswordSetupController::class, 'show'])->name('Member.Password.Set');
Route::post('/Member-Set-Password', [MemberPasswordSetupController::class, 'save'])->name('Member.Password.Set.Save');

Route::middleware(['must_change_password'])->group(function () {
Route::get('/Member-Landing-Page', [MemberLandingPage::class,'MemberLP'])->name('Member.Landing');
Route::get('/Redirecting-to-Loan-Application', [redirectToLoanApp::class,'RedirectToLoanApp'])->name('Redirecting.LoanApp');
Route::get('/Loan-Application', [LoanApplication1::class,'LoanApplication1'])->name('Loan.App');
Route::get('/Loan-Application-Review', [reviewpage::class,'ViewReviewPage'])->name('Display.Review');
Route::post('/Loan-Application-submit', [LoanApplicationSubmit::class,'LoanAppSubmit'])->name('Loan.Submit');
Route::get('/Loan-Application-Messege', [LoanAppConfirmation::class,'LoanConfirmation'])->name('Loan.Messege');
Route::post('/Redirect-Back-to-Dashboard', [LoanAppConfirmationRedirectBack::class,'redirectBack'])->name('Goto.Dashboard');
// loan
Route::get('/GBLDC-Member-Loan-Dashboard', [loanDashboard::class,'view'])->name('Loan.Dashboard');
Route::get('/Payment-Schedule/{type?}', [loanDashboard::class,'paymentSchedule'])->name('Payment.Schedule');
Route::get('/Member-Loan-History', [loanDashboard::class,'loanHistory'])->name('Member.Loan.History');
Route::get('/Full-Payment-History', [loanDashboard::class,'fullPaymentHistory'])->name('Full.Payment.History');
Route::get('/Under-Construction', [loanDashboard::class,'underConstruction'])->name('Under.Construction');
Route::get('/Check-Loan-Status', [loanDashboard::class,'checkLoanStatus'])->name('Member.Check.Loan.Status');
Route::get('/Member-Logout', [LogoutController::class,'memberLogout'])->name('Member.Logout');

// Account Settings
Route::get('/Member-Account-Settings', [AccountSettings::class,'index'])->name('Member.AccountSettings');
Route::put('/Member-Account-Settings-Basic', [AccountSettings::class,'updateBasicInfo'])->name('Member.AccountSettings.UpdateBasic');
Route::put('/Member-Account-Settings-Contact', [AccountSettings::class,'updateContact'])->name('Member.AccountSettings.UpdateContact');
Route::put('/Member-Account-Settings-Password', [AccountSettings::class,'updatePassword'])->name('Member.AccountSettings.UpdatePassword');
Route::put('/Member-Account-Settings-Address', [AccountSettings::class,'updateAddress'])->name('Member.AccountSettings.UpdateAddress');

// Contact Us
Route::get('/Member-Contact-Us', [ContactUs::class,'index'])->name('Member.ContactUs');
Route::post('/Member-Contact-Us-Submit', [ContactUs::class,'submit'])->name('Member.ContactUs.Submit');

// FAQ
Route::get('/Member-FAQ', [FAQController::class,'index'])->name('Member.FAQ');
});
});
