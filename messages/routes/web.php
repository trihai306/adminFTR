<?php


Route::group(config('future.future.route'), function () {
 Route::get('messages', [\Future\Messages\Http\Controllers\MessageController::class,'index'])->name('messages.index');
});
