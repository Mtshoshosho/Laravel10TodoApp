<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;

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

class Task
{
    // この関数はTaskクラスのコンストラクタです。
    // 以下のパラメータを受け取ります：
    // id: タスクのID
    // title: タスクのタイトル
    // description: タスクの短い説明
    // long_description: タスクの詳細な説明（null可能）
    // completed: タスクが完了したかどうかを示すブール値
    // created_at: タスクが作成された日時
    // updated_at: タスクが最後に更新された日時
    public function __construct(
        public int $id,
        public string $title,
        public string $description,
        public ?string $long_description,
        public bool $completed,
        public string $created_at,
        public string $updated_at
    ) {
    }
}

$tasks = [
    new Task(
        1,
        '食料品を買う',
        'タスク1の説明',
        'タスク1の詳細な説明',
        false,
        '2023-03-01 12:00:00',
        '2023-03-01 12:00:00'
    ),
    new Task(
        2,
        '古いものを売る',
        'タスク2の説明',
        null,
        false,
        '2023-03-02 12:00:00',
        '2023-03-02 12:00:00'
    ),
    new Task(
        3,
        'プログラミングを学ぶ',
        'タスク3の説明',
        'タスク3の詳細な説明',
        true,
        '2023-03-03 12:00:00',
        '2023-03-03 12:00:00'
    ),
    new Task(
        4,
        '犬を散歩に連れて行く',
        'タスク4の説明',
        null,
        false,
        '2023-03-04 12:00:00',
        '2023-03-04 12:00:00'
    ),
];

Route::get('/', function () {
    return redirect()->route('tasks.index');
});

// ここでは、全てのタスクを取得し、それらをビューに渡しています
Route::get('/tasks', function () use ($tasks) {
    return view('index', ['tasks' => $tasks]);
})->name('tasks.index');

// ここでは、指定されたIDのタスクを取得します
Route::get('/tasks/{id}', function ($id) use ($tasks) {
    $task = collect($tasks)->firstWhere('id', $id);
    // タスクが見つからなかった場合の処理
    if (!$task) {
        // タスクが見つからなかった場合、エラーメッセージを表示します
        abort(Response::HTTP_NOT_FOUND);
    }
    return view('show', ['task' => $task]);
})->name('tasks.show');

Route::fallback(function () {
    return 'Still got somewhere!';
});
