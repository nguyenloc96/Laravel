<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use App\Task;
use Illuminate\Http\Request;

/**
 * Display All Tasks
 */


Route::get('/', function () {
    return view('auth.home');
});

Route::get('/task', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});
/**
 * Add A New Task
 */
Route::post('/task', function (Request $request) {
    
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/task')
            ->withInput()
            ->withErrors($validator);
    }
    
    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/task');
});

// Shema Builder

Route::get('create/demo', function(){
    Schema::create('demo', function ($table) {
        $table->increments('id');
        $table->string('demo');
        $table->timestamps();
    });
});

Route::get('rename/demo', function(){
    Schema::rename('demo', 'my-demo');
});

Route::get('drop', function(){
    Schema::dropIfExists('demo');
    Schema::dropIfExists('my-demo');
});

Route::get('change/demo', function(){
    Schema::table('demo', function ($table) {
        $table->string('demo', 50)->change();
    });
});

Route::get('drop/col', function(){
    Schema::table('demo', function ($table) {
        $table->dropColumn('demo');
    });
    /** khoá ngoại sử dụng ubsigned() và sử dụng foreign('khoá ngoại')->reference('khoá chính của bảng') -> on('tên bảng')
    *   $table->integer('user_id')->unsigned();
    *    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    *    onDelete('cascade'): xoá hết khi xoá thằng cha
    */
});

// Query Builder
Route::get('task/get-all', function(){
    $data = DB::table('tasks')->get();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}); 
Route::get('task/get-name', function(){
    $data = DB::table('tasks')->select('name')->get();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});
Route::get('task/get-name-4', function(){
    $data = DB::table('tasks')->select('name')->where('id',4)->get();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});

// Eloquent ORM
Route::get('model/get-all-task', function(){
    $data = App\Task::all()->toArray();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});

Route::get('model/get-id-task', function(){
    $data = App\Task::findOrFail(2)->toArray();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});

Route::get('model/where-id-task', function(){
    $data = App\Task::where('id','>','3')->get()->toArray();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});

Route::get('model/where-take-task', function(){
    $data = App\Task::where('id','>','1')->select('name')->take(2)->get()->toArray();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});

Route::get('model/get-count-task', function(){
    $data = App\Task::all()->count();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});

Route::get('model/multi-where', function( App\Task $task){
    $data = $task::whereRaw('id = ? and name = ?', [1, 'Lộc Nguyễn']) -> get() -> toArray();
    echo "<pre>";
    print_r($data);
    echo "</pre>";
});
// Isnsert
Route::get('model/add-new-task', function(){
    $task = new App\Task;
    $task->name= "Phương Ngáo";
    $task->save();
    echo "Add new task";
});

Route::get('model/create-task', function(){
    $data = array(
        'name' => 'Phương Hâm'
    );
    App\Task::create($data);
    echo "Create new task";
});
// Update
Route::get('model/update-task', function(){
    $task = App\Task::find(7);
    $task->name= "Phương Hâm Hấp";
    $task->save();
    echo "Update task";
});
//Delete
Route::get('model/delete-task', function(){
    $task = App\Task::destroy(8);
    echo "Delete task";
});


// Request Respone
// Route::group(['middleware' => 'jwt.auth'], function () {
//     Route::get('form/add-task','TaskController@getAdd');

//     Route::post('form/add-task',['as'=>'addTask','uses' => 'TaskController@add']);

//     Route::get('form/delete-task/{id}','TaskController@delete');

//     Route::get('form/edit-task/{id}','TaskController@edit');

//     Route::put('form/edit-task/{id}',['as'=>'updateTask','uses' => 'TaskController@update']);
// });

Route::get('form/add-task','TaskController@getAdd');

Route::post('form/add-task',['as'=>'addTask','uses' => 'TaskController@add']);

Route::get('form/delete-task/{id}','TaskController@delete');

Route::get('form/edit-task/{id}','TaskController@edit');

Route::put('form/edit-task/{id}',['as'=>'updateTask','uses' => 'TaskController@update']);

// Login, Register
Route::get('register', ['as'=>'getRegister', 'uses' => 'Auth\AuthController@getRegister']);

Route::post('register', ['as'=>'postRegister', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('login', ['as'=>'getLogin', 'uses' => 'Auth\AuthController@getLogin']);

Route::post('login', ['as'=>'postLogin', 'uses' => 'Auth\AuthController@postLogin']);

Route::get('logout', ['as'=>'getLogout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('/home', function () {
    return view('auth/home');
});

Route::get('/login/fail', function () {
    return view('auth/login-fail');
});

Route::get('/register/success', function () {
    return view('auth/register-success');
});

Route::get('/infor/user', function () {
    return view('auth/infor-user');
});

// JWT Authorization 
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/user', 'Auth\AuthController@getAuthUser');
});

Route::group(['prefix' => 'app/api'], function (){
    Route::post('/login', ['as'=>'apiPostLogin', 'uses' => 'Api\ApiController@postLogin']);
    Route::get('/logout', ['as'=>'apiGetLogout', 'uses' => 'Api\ApiController@getLogout']);
    Route::group(['middleware' => ['jwt.auth']], function() {
        Route::post('/add-task', ['as'=>'apiAddTask', 'uses' => 'Api\ApiController@addTask']);
        Route::post('/edit-task/{id}', ['as'=>'apiEditTask', 'uses' => 'Api\ApiController@editTask']);
        Route::post('/delete-task/{id}', ['as'=>'apiDeleteTask', 'uses' => 'Api\ApiController@deteleTask']);
    });
});