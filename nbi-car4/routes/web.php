<?php
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
Route::get('/', function () {
    //return view('auth/login');
    return redirect('/index');
});

Auth::routes();
//route::resource('/index','IndexController');

//AGENT ROLES
Route::group(['middleware' => ['web','agent']], function() {

    route::resource('/agentHome','agent\HomeController');
    route::resource('/agentCase','agent\assignedCaseController');
    route::resource('/agentProfile','agent\userProfileController');
    route::resource('/agentChangePassword','agent\changePasswordController');
    route::get('/getCaseData/{caseid}','agent\caseDataController@show')->name('getCaseData');
    Route::get('/getCaseReports/{agentReport}','agent\caseDataController@getCaseReports')->name('getAgentReport');
    Route::get('/uploadfile','agent\assignedCaseController@uploadfile');
    Route::post('/uploadfile','agent\assignedCaseController@uploadFilePost');
    route::get('/getCaseDetails/{caseid}','agent\viewCaseController@show')->name('getViewCase');
    Route::get('/getAgentReport/{aReport}','agent\viewCaseController@getAReport')->name('getAReport');
    route::resource('/agentSearch','agent\searchController');
    route::post('/agentSearchResult','agent\searchController@show');
    Route::get('/recordDetails/{caseid}','agent\searchController@showCase');
});



########################AGENT#######################################################
  /*Route::group(['middleware' => ['web','agent']], function() {

    route::resource('/index','IndexController');
    route::resource('/agentHome','agent\HomeController');
    route::resource('/agentCase','agent\assignedCaseController');
    route::resource('/agentProfile','agent\userProfileController');
    route::resource('/agentChangePassword','agent\changePasswordController');

});*/
#####################################################################################

########################ENCODER######################################################
Route::group(['middleware' => ['web','encoder']], function() {
    route::resource('/encoderHome','encoder\HomeController');
    route::resource('/encoderProfile','encoder\userProfileController');
    route::resource('/encoderCCN','encoder\ccnController');
    route::resource('/encoderChangePassword','encoder\changePasswordController');
    route::resource('/complaintSheet','encoder\ComplaintSheetController');
    Route::resource('/caseRecords','encoder\updateController');

    Route::get('/updateRecords/{caseid}','encoder\updateController@show');
    Route::post('/updatedCaseRecords','encoder\updateController@update');

});
#####################ENCODER UPDATE##################################################
Route::post('/ccnUpdate','encoder\ccnController@update');
#####################ENCODER STORE###################################################
Route::post('/encoderAddComplaintSheet','encoder\ComplaintSheetController@store');
route::post('/validateData','encoder\ComplaintSheetController@validateMe');
#####################################################################################

#############################ADMIN###################################################
Route::group(['middleware' => ['web','admin']], function() {
    route::resource('/adminHome','admin\homeController');
    route::post('/showStatistics','admin\homeController@show');
    route::resource('/ComplaintSheet','admin\ComplaintSheetController');
    Route::post('/adminAddComplaintSheet','admin\ComplaintSheetController@store');
    route::post('/validatedData','admin\ComplaintSheetController@validateMe');
    //Advanced Searchs
    route::resource('/advancedSearch','admin\advancedSearchController');
    Route::get('/searchDetails/{caseid}','admin\advancedSearchController@showCase');
    route::post('/searchResult','admin\advancedSearchController@show');

    route::resource('/userHistory','admin\userHistoryController');
    route::resource('/userLogs','admin\userLogsController');
    //CASE NATURE
    route::resource('/caseNature','admin\caseNatureController');
    Route::post('/natureUpdate','admin\caseNatureController@update');
    Route::post('/createNature','admin\caseNatureController@store');
    Route::post('/deleteNature','admin\caseNatureController@delete');
    //CASE STATUS
    route::resource('/caseStatus','admin\CaseStatusController');
    Route::post('/updateCaseStatus','admin\CaseStatusController@update');
    Route::post('/addCaseStatus','admin\CaseStatusController@store');
    //Archive Records
    route::resource('/archivedNature','admin\archivedNatureController');
    route::post('/unarchivedNature','admin\archivedNatureController@update');

    Route::get('/unArchivedCase/{caseid}','admin\archivedRecordsController@showcase');
    Route::post('/processUnarchived','admin\archivedRecordsController@delete');
    //MANAGE ACCOUNT
    route::resource('/manageAccounts','admin\manageAccountController');
    Route::post('/userUpdate','admin\manageAccountController@update');
    Route::post('/othersUpdate','admin\manageAccountController@updateOthers');
    Route::post('/addNewUser','admin\manageAccountController@store');
    Route::post('/passwordReset','admin\manageAccountController@edit');
    //
    route::resource('/profile','admin\ProfileController');
    route::resource('/adminChangePassword','admin\changePasswordController');
    Route::resource('/caseReview','admin\caseReviewController');
    Route::get('/viewCase/{caseid}','admin\caseReviewController@showCase');
    //Route::get('/getCaseReport/{report}','admin\caseReviewController@getCaseReport')->name('getReport'); UNCOMMENT ME
    //Route::resource('/deleteCase','admin\caseDeleteController');
    //Route::resource('/updateCase','admin\caseReportController@show');
    Route::resource('/caseReport','admin\caseReportController');
    Route::resource('/updateCase','admin\caseReportController');
    Route::post('/updatedCase','admin\caseReportController@update');

    //Route::get('/updateCase/{caseid}','admin\caseReportController@show');

    /**This for archiving the records */
    //Route::get('/archiveCase/{caseid}','admin\caseReportController@showcase');
    //Route::post('/caseDeleted','admin\caseReportController@delete');
    //route::resource('/archivedRecords','admin\archivedRecordsController');
    //Route::resource('/moreDetails','admin\archivedRecordsController');

    #Export Terminated
    Route::get('/downloadterminated/excel', 'admin\terminatedCrimeCaseController@export');
    Route::get('/downloadterminated/pdf', 'admin\terminatedCrimeCaseController@exportPDF');

    #Export Pending
    Route::get('/downloadpendingcrime/excel', 'admin\pendingCrimesController@export');
    Route::get('/downloadpendingcrime/pdf', 'admin\pendingCrimesController@exportPDF');

    #Export CCN
    Route::get('/downloadccn/excel', 'admin\ccnAcmoRequestController@export');

    #Export Transmittal
    Route::get('/download/transmittal','admin\terminatedCasesController@export');

    #Terminated Controller
    route::resource('/terminatedCrimeCase','admin\terminatedCrimeCaseController');
    Route::post('/terminatedCrimeCase','admin\terminatedCrimeCaseController@date_filter')->name('daterange.fetch_terminated');

    #Pending Controller
    route::resource('/pendingCrimes','admin\pendingCrimesController');
    Route::post('/pendingCrimes','admin\pendingCrimesController@date_filter')->name('daterange.fetch_pending');

    #CCN ACMO Controller
    route::resource('/ccnAcmoRequest','admin\ccnAcmoRequestController');
    Route::post('/ccnAcmoRequest','admin\ccnAcmoRequestController@date_filter')->name('daterange.fetch_ccn');

    #Transmittal Controller
    Route::resource('/terminatedCases','admin\terminatedCasesController');
    Route::post('/terminatedCases', 'admin\terminatedCasesController@date_filter')->name('daterange.fetch_transmittal');

});
    Route::get('/changePassword','HomeController@showChangePasswordForm');
    Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
    
    Route::get('/getCaseReport/{report}','admin\caseReviewController@getCaseReport')->name('getReport');

    Route::get('/backupdatabase', function () {
        $exitCode = Artisan::call('mysql:backup');
        return redirect('/caseReport');
    });


Route::group(['middleware' => ['web', 'auth']], function(){
    /*
    Route::get('/', function () {
        return view('auth/login');
    });
    */
    route::get('/', function(){
    if(Auth::user()->role == 'Encoder'){
        return redirect('/encoderHome');
    } else if(Auth::user()->role == 'Investigator') {
        return redirect('/agentHome');
    }else {
        return redirect('/adminHome');
    }
    });
});

