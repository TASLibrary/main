<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $usecase = null;
    $featuredUsecase = \App\Models\Usecase::where('featured', true)->get();
    if (!$featuredUsecase->isEmpty()){
        $usecase = $featuredUsecase->first();
    }
    return view('tas/main/index', ['usecase' => $usecase]);
})->name('home');

Route::get('/library', function (){
    $usecases = \App\Models\Usecase::where('status', \App\Enum\UsecaseStatus::Approved)->get();
    $dimensions = \App\Models\Dimension::all();
    return view('tas/main/library', [
        'usecases' => $usecases,
        'dimensions' => $dimensions
    ]);
})->name('library');

Route::get('/library/usecase/{usecase}', function (\App\Models\Usecase $usecase){
    $evaluations = \App\Models\Evaluation::where('usecase_id', $usecase->id)->where('status', \App\Enum\EvaluationStatus::Approved->value)->paginate(5);
    return view('tas/library/usecase', [
        'usecase' => $usecase,
        'evaluations' => $evaluations
    ]);
})->name('library.usecase');

Route::get('/content/{page_id}', function (string $page_id){
    $content = \App\Models\Setting::where('name', $page_id)->first()->value;
    return view('tas/main/content', ['content' => $content]);
})->name('content');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::middleware([
        'role:Administrator',
    ])->group(function (){

        /**
         * DASHBOARD
         */
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        /**
         * USECASE
         */

        Route::get('/usecase/list', [\App\Http\Controllers\Usecase::class, 'list'])->name('usecase.list');

        Route::get('/usecase/read/{usecase}', [\App\Http\Controllers\Usecase::class, 'read'])->name('usecase.read');

        Route::get('/usecase/update/{usecase}', [\App\Http\Controllers\Usecase::class, 'update'])->name('usecase.update');

        Route::post('/usecase/update/{usecase}', [\App\Http\Controllers\Usecase::class, 'update'])->name('usecase.update');

        Route::get('/usecase/approve/{usecase}', [\App\Http\Controllers\Usecase::class, 'approve'])->name('usecase.approve');

        Route::get('/usecase/reject/{usecase}', [\App\Http\Controllers\Usecase::class, 'reject'])->name('usecase.reject');

        Route::get('/usecase/feature/{usecase}', [\App\Http\Controllers\Usecase::class, 'feature'])->name('usecase.feature');

        /**
         * USER
         */

        Route::get('user/list', [\App\Http\Controllers\User::class, 'list'])->name('user.list');

        Route::get('user/read/{user}', [\App\Http\Controllers\User::class, 'read'])->name('user.read');

        Route::get('user/update/{user}', [\App\Http\Controllers\User::class, 'update'])->name('user.update');

        Route::post('user/update/{user}', [\App\Http\Controllers\User::class, 'update'])->name('user.update');

        Route::get('user/ban/{user}', [\App\Http\Controllers\User::class, 'ban'])->name('user.ban');

        Route::get('user/activate/{user}',[\App\Http\Controllers\User::class, 'activate'])->name('user.activate');

        /**
         * MESSAGE
         */

        Route::get('message/list', [\App\Http\Controllers\Message::class, 'list'])->name('message.list');

        Route::get('message/read/{message}', [\App\Http\Controllers\Message::class, 'read'])->name('message.read');

        Route::get('message/resolve/{message}', [\App\Http\Controllers\Message::class, 'resolve'])->name('message.resolve');

        /**
         * ISSUE
         */

        Route::get('issue/list', [\App\Http\Controllers\Issue::class, 'list'])->name('issue.list');

        Route::get('issue/read/{issue}', [\App\Http\Controllers\Issue::class, 'read'])->name('issue.read');

        Route::get('issue/resolve/{issue}', [\App\Http\Controllers\Issue::class, 'resolve'])->name('issue.resolve');

        /**
         * EVALUATION
         */

        Route::get('evaluation/list', [\App\Http\Controllers\Evaluation::class, 'list'])->name('evaluation.list');

        Route::get('evaluation/read/{evaluation}', [\App\Http\Controllers\Evaluation::class, 'read'])->name('evaluation.read');

        Route::get('evaluation/update/{evaluation}', [\App\Http\Controllers\Evaluation::class, 'update'])->name('evaluation.update');

        Route::post('evaluation/update/{evaluation}', [\App\Http\Controllers\Evaluation::class, 'update'])->name('evaluation.update');

        Route::get('evaluation/approve/{evaluation}', [\App\Http\Controllers\Evaluation::class, 'approve'])->name('evaluation.approve');

        Route::get('evaluation/reject/{evaluation}', [\App\Http\Controllers\Evaluation::class, 'reject'])->name('evaluation.reject');
    });

    Route::middleware([
        'role:Administrator|ContentManager',
    ])->group(function (){

        /**
         * DASHBOARD
         */
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        /**
         * SETTING
         */

        Route::get('setting/list', [\App\Http\Controllers\Setting::class, 'list'])->name('setting.list');

        Route::post('setting/list', [\App\Http\Controllers\Setting::class, 'update'])->name('setting.list');

        /**
         * DIMENSION
         */
        Route::get('/dimension/list', [\App\Http\Controllers\Dimension::class, 'list'])->name('dimension.list');

        Route::get('/dimension/create', [\App\Http\Controllers\Dimension::class, 'create'])->name('dimension.create');

        Route::post('/dimension/create', [\App\Http\Controllers\Dimension::class, 'create'])->name('dimension.create');

        Route::get('/dimension/update/{dimension}', [\App\Http\Controllers\Dimension::class, 'update'])->name('dimension.update');

        Route::post('/dimension/update/{dimension}', [\App\Http\Controllers\Dimension::class, 'update'])->name('dimension.update');

        Route::get('/dimension/delete/{dimension}', [\App\Http\Controllers\Dimension::class, 'delete'])->name('dimension.delete');

        Route::post('/dimension/delete/{dimension}', [\App\Http\Controllers\Dimension::class, 'delete'])->name('dimension.delete');


        /**
         * CHARACTERISTIC
         */

        Route::get('/characteristic/list/{dimension}', [\App\Http\Controllers\Characteristic::class, 'list'])->name('characteristic.list');

        Route::get('/characteristic/create/{dimension}', [\App\Http\Controllers\Characteristic::class, 'create'])->name('characteristic.create');

        Route::post('/characteristic/create/{dimension}', [\App\Http\Controllers\Characteristic::class, 'create'])->name('characteristic.create');

        Route::get('/characteristic/update/{characteristic}', [\App\Http\Controllers\Characteristic::class, 'update'])->name('characteristic.update');

        Route::post('/characteristic/update/{characteristic}', [\App\Http\Controllers\Characteristic::class, 'update'])->name('characteristic.update');

        Route::get('/characteristic/delete/{characteristic}', [\App\Http\Controllers\Characteristic::class, 'delete'])->name('characteristic.delete');

        Route::post('/characteristic/delete/{characteristic}', [\App\Http\Controllers\Characteristic::class, 'delete'])->name('characteristic.delete');

        /**
         * UserInput
         */

        Route::get('/user_input/list/{dimension}', [\App\Http\Controllers\UserInput::class, 'list'])->name('user_input.list');

        Route::get('/user_input/create/{dimension}', [\App\Http\Controllers\UserInput::class, 'create'])->name('user_input.create');

        Route::post('/user_input/create/{dimension}', [\App\Http\Controllers\UserInput::class, 'create'])->name('user_input.create');

        Route::get('/user_input/update/{user_input}', [\App\Http\Controllers\UserInput::class, 'update'])->name('user_input.update');

        Route::post('/user_input/update/{user_input}', [\App\Http\Controllers\UserInput::class, 'update'])->name('user_input.update');

        Route::get('/user_input/delete/{user_input}', [\App\Http\Controllers\UserInput::class, 'delete'])->name('user_input.delete');

        Route::post('/user_input/delete/{user_input}', [\App\Http\Controllers\UserInput::class, 'delete'])->name('user_input.delete');

        /**
         * USECASE
         */

        Route::get('/usecase/list', [\App\Http\Controllers\Usecase::class, 'list'])->name('usecase.list');

        Route::get('/usecase/feature/{usecase}', [\App\Http\Controllers\Usecase::class, 'feature'])->name('usecase.feature');

    });
});
