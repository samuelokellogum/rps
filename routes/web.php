<?php

use Illuminate\Http\Request;

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


Auth::routes();

Route::get('/', 'HomeController@index')->name('/');


//school
Route::get('regSchool', "HomeController@regSchool")->name("regSchool");
Route::post('addSchoolData', "HomeController@addSchoolData")->name("addSchoolData");

//class
Route::get('clazz', "ClassController@index")->name("clazz");
Route::get('loadClassList', "ClassController@loadClassList")->name("loadClassList");
Route::post('addClassData', "ClassController@addClassData")->name("addClassData");
Route::get('onClassUpdate', "ClassController@onClassUpdate")->name("onClassUpdate");
Route::post('addClassStream', "ClassController@addClassStream")->name("addClassStream");
Route::get('onClassStreamUpdate', "ClassController@onClassStreamUpdate")->name("onClassStreamUpdate");

//subject
Route::get('subject', "SubjectController@index")->name("subject");
Route::get('loadAllSubjects', "SubjectController@loadAllSubjects")->name("loadAllSubjects");
Route::get('loadAllClassWithSubjects', "SubjectController@loadAllClassWithSubjects")->name("loadAllClassWithSubjects");
Route::post('addSubject', "SubjectController@addSubject")->name("addSubject");
Route::get('onSubjectUpdate', "SubjectController@onSubjectUpdate")->name("onSubjectUpdate");
Route::post('addSubjectPat', "SubjectController@addSubjectPat")->name("addSubjectPat");
Route::get('onSubjectPatUpdate', "SubjectController@onSubjectPatUpdate")->name("onSubjectPatUpdate");
Route::get('classSubject', "SubjectController@classSubject")->name("classSubject");
Route::get('addClassSubject', "SubjectController@addClassSubject")->name("addClassSubject");

//Term
Route::get("term", "TermController@index")->name("term");
Route::get("loadAllTerms", "TermController@loadAllTerms")->name("loadAllTerms");
Route::post("addTerm", "TermController@addTerm")->name("addTerm");
Route::get("onTermUpdate", "TermController@onTermUpdate")->name("onTermUpdate");

//grading
Route::get("grading", "GradingController@index")->name("grading");
Route::get("loadAllGrading", "GradingController@loadAllGrading")->name("loadAllGrading");
Route::post("addGrading", "GradingController@addGrading")->name("addGrading");
Route::get("onGradingUpdate", "GradingController@onGradingUpdate")->name("addGrading");
Route::post("addGradeDetails", "GradingController@addGradeDetails")->name("addGradeDetails");
Route::get("onGradeDetailUpdate", "GradingController@onGradeDetailUpdate")->name("addGradeDetails");


//student
Route::get("student", "StudentController@index")->name("student");
Route::get("loadAllStudents", "StudentController@loadAllStudents")->name("loadAllStudents");
Route::get("listStudentsBy", "StudentController@listStudentsBy")->name("listStudentsBy");
Route::post("addStudent", "StudentController@addStudent")->name("addStudent");
Route::get("onStudentUpdate", "StudentController@onStudentUpdate")->name("onStudentUpdate");
Route::get("deleteStudent", "StudentController@deleteStudent")->name("deleteStudent");

//import/ export students
Route::get("importStudents", "ImportStudentsController@index")->name("importStudents");
Route::get("getAjaxClassData", "ImportStudentsController@getAjaxClassData")->name("getAjaxClassData");
Route::get("viewStudentImport", "ImportStudentsController@viewStudentImport")->name("viewStudentImport");
Route::get("onUpdateTempData", "ImportStudentsController@onUpdateTempData")->name("onUpdateTempData");
Route::get("confirmStudentImport", "ImportStudentsController@confirmStudentImport")->name("confirmStudentImport");
Route::post("importStudentFile", "ImportStudentsController@importStudentFile")->name("importStudentFile");
Route::post("updateTempData", "ImportStudentsController@updateTempData")->name("updateTempData");


//exam
Route::get("examSet", "ExamController@index")->name("examSet");
Route::get("onExamSetUpdate", "ExamController@onExamSetUpdate")->name("onExamSetUpdate");
Route::post("addEXamSet", "ExamController@addEXamSet")->name("addEXamSet");

//report config
Route::get("reportConfig", "ReportConfigController@index")->name("reportConfig");
Route::get("getSubjectPatsForClass", "ReportConfigController@getSubjectPatsForClass")->name("getSubjectPatsForClass");
Route::get("addPartsToClass", "ReportConfigController@addPartsToClass")->name("addPartsToClass");
Route::get("getAdGrade", "ReportConfigController@getAdGrade")->name("getAdGrade");
Route::get("addReportConfig", "ReportConfigController@addReportConfig")->name("addReportConfig");
Route::get("getReportConfig", "ReportConfigController@getReportConfig")->name("getReportConfig");
Route::post("addAdvancedGrade", "ReportConfigController@addAdvancedGrade")->name("addAdvancedGrade");

//marks
Route::get("marks", "MarksController@index")->name("marks");
Route::get("loadAllExamData", "MarksController@loadAllExamData")->name("loadAllExamData");
Route::get("allowedPats", "MarksController@allowedPats")->name("allowedPats");
Route::get("onConfirm", "MarksController@onConfirm")->name("onConfirm");


//results
Route::get("results", "ResultsController@index")->name("results");
Route::get("onMarksUpdate", "ResultsController@onMarksUpdate")->name("onMarksUpdate");
Route::post("updateMark", "ResultsController@updateMark")->name("updateMark");

//reports
Route::get("studentReport", "ReportController@studentReport")->name("studentReport");
Route::get("reportCards", "ReportController@index")->name("reportCards");
Route::post("generateReports", "ReportController@generateReports")->name("generateReports");
Route::get("printReports", "ReportController@printReports")->name("printReports");
Route::get("viewGenReports", "ReportController@viewGenReports")->name("viewGenReports");

//fees
Route::get('feesStructure', 'FeesController@index')->name('feesStructure');
Route::get('allFeesData', 'FeesController@allFeesData')->name('allFeesData');
Route::post('addStudentType', 'FeesController@addStudentType')->name('addStudentType');
Route::post('addOtherFees', 'FeesController@addOtherFees')->name('addOtherFees');
Route::post('confirmFeesStruct', 'FeesController@confirmFeesStruct')->name('confirmFeesStruct');
Route::get('FeeStudenList', 'FeesController@FeeStudenList')->name('FeeStudenList');
Route::get('getStudentList', 'FeesController@getStudentList')->name('getStudentList');
Route::get('assignStudentType', 'FeesController@assignStudentType')->name('assignStudentType');
Route::get('showPay', 'FeesController@showPay')->name('showPay');
Route::get('showStatement', 'FeesController@showStatement')->name('showStatement');
Route::post('confirmPayment', 'FeesController@confirmPayment')->name('confirmPayment');









Route::get("test", function(Request $req){
 $student = \App\Student::find(3);
// dd($student->statement(1));
  return view("test");
});