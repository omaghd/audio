<?php

use App\Http\Controllers\AudioController;
use App\Http\Controllers\AudioTopicController;
use App\Http\Controllers\TopicController;
use App\Models\Topic;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('audios');
})->name('root');

Route::middleware(['auth'])->group(function () {
    Route::prefix('/audios')->group(function () {
        Route::get('', [AudioController::class, 'index'])->name('audios');
        Route::middleware(['can:is-admin'])->group(function () {
            Route::get('create', [AudioController::class, 'create'])->name('audios.create');
            Route::post('', [AudioController::class, 'store']);
            Route::get('{audio}/edit', [AudioController::class, 'edit'])->name('audios.edit');
            Route::put('{audio}', [AudioController::class, 'update'])->name('audios.update');
            Route::delete('{audio}', [AudioController::class, 'destroy'])->name('audios.destroy');
        });

        Route::get('{audio}/topics', [AudioTopicController::class, 'index'])->name('audios.topics');
        Route::post('{audio}/topics', [AudioTopicController::class, 'store'])->name('audios.topics.create');
    });

    Route::prefix('/topics')->group(function () {
        Route::get('', [TopicController::class, 'index'])->name('topics');

        Route::delete('{topic}', [TopicController::class, 'destroy'])
            ->name('topics.destroy')
            ->can('delete-topic', 'topic');
    });
});

require __DIR__ . '/auth.php';
