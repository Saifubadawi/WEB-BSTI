<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::redirect('/', '/books');

Route::resource('books', BookController::class);

use Illuminate\Support\Facades\Storage;

Route::get('/test-s3', function () {

    Storage::disk('s3')->put(
        'test.txt',
        'Hello BSTI'
    );

    return 'S3 Berhasil';
});
