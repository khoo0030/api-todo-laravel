<?php

Route::prefix('v1')->group(function () {
    Route::resource('todos', 'TodoController')->only([
        'index',
        'store',
        'show',
        'update',
        'destroy',
    ]);
});
