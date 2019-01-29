<?php
/**
 * Short description for file
 * 
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 2018 PHP
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link      link
 **/


Route::get('/', 'LoginController@index');
Route::get('/login', 'LoginController@show');
Route::post('/login', 'LoginController@start');
Route::get('/login/out', 'LoginController@end');
Route::post('/impuesto/estado/', 'ImpuestoController@updateStatus');
Route::post('/impuesto/search', 'ImpuestoController@search');
Route::post('/impuesto/deleteFile', 'ImpuestoController@deleteFile');
Route::post('/impuesto/saveNote', 'ImpuestoController@saveNote');
Route::post('/impuesto/addNote', 'ImpuestoController@addNote');
Route::post('/impuesto/deleteNote', 'ImpuestoController@deleteNote');
Route::post('/impuesto/updateNote', 'ImpuestoController@updateNote');
Route::post('/impuesto/sendTeam', 'ImpuestoController@sendTeam');



Route::get('/task', 'TaskController@index');
Route::post('/task/editDocumentsName', 'TaskController@editDocumentsName');
Route::get('/task/meeting', 'TaskController@indexMeeting');
Route::get('/task/project', 'TaskController@indexProject');
Route::post('/task/addTaskA', 'TaskController@addTaskA');
Route::post('/task/editTaskA', 'TaskController@editTaskA');
Route::post('/task/nif', 'TaskController@nif');
Route::post('/task/getTask', 'TaskController@getTask');
Route::post('/task/completedTask', 'TaskController@completedTask');
Route::post('/task/searchCustomer', 'TaskController@searchCustomer');
Route::post('/task/addSubTask', 'TaskController@addSubTask');
Route::post('/task/incompleteTask', 'TaskController@incompleteTask');
Route::post('/task/editTaskSon', 'TaskController@editTaskSon');
Route::post('/task/getOneTask', 'TaskController@getOneTask');
Route::post('/task/addNote', 'TaskController@addNote');
Route::post('/task/addNoteFather', 'TaskController@addNoteFather');
Route::post('/task/updateNote', 'TaskController@updateNote');
Route::post('/task/deleteNote', 'TaskController@deleteNote');
Route::post('/task/getNotes', 'TaskController@getNotes');
Route::post('/task/uploadFile', 'TaskController@uploadFile');
Route::post('/task/getDocuments', 'TaskController@getDocuments');
Route::post('/task/deleteFileTask', 'TaskController@deleteFileTask');
Route::post('/task/getMeetingInvited', 'TaskController@getMeetingInvited');
Route::post('/task/removeMeetingInvited', 'TaskController@removeMeetingInvited');
Route::get('/task/{link}', 'TaskController@link');





// Route::post('/impuesto/nif', 'ImpuestoController@nif');

Route::get('/impuesto', 'ImpuestoController@index');

Route::get('/impuesto/descargar/{id}/{mode}', 'ImpuestoPdfController@descargar');
Route::get('/impuesto/consultar', 'ImpuestoController@showAll');
Route::get('/impuesto/{id}', 'ImpuestoController@show');
Route::post('/impuesto/file', 'ImpuestoController@uploadFile');


Route::get('mail/send', 'MailController@send');
Route::get('/descargar/{id}/{mode}', 'PresupuestoPdfController@descargar');
Route::get('/consultar', 'PresupuestosController@showAll');
Route::resource('usuario', 'UsuariosController');


 
Route::get('presupuesto', 'PresupuestosController@index');
Route::resource('impuesto', 'ImpuestoController');
Route::get('/presupuesto/{id}', 'PresupuestosController@show');
Route::resource('presupuesto', 'PresupuestosController');


Route::get('/{user_name}', 'LoginController@startSimple');
//Route::get('/{user_name}', 'PagesController@index');


