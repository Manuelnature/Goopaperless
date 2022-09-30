<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SetPasswordController;

//Pages
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserGroupController;
use App\Http\Controllers\UploadFileController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LinkController;



Route::group(['middleware' => 'disable_back_button'], function () {
    // Route::get('/', [LoginController::class, 'index'])->middleware('alreadyLoggedIn');
    Route::get('/', [LoginController::class, 'index']);

    Route::post('user_login', [LoginController::class, 'user_login'])->name('login_user');

    Route::get('auth.register', [RegisterController::class, 'index']);
    Route::post('register', [RegisterController::class, 'user_register'])->name('register_user');

    Route::get('auth.set_password', [SetPasswordController::class, 'index']);
    Route::post('auth.set_password', [SetPasswordController::class, 'set_password'])->name('set_user_password');

    Route::get('dashboard', [DashboardController::class, 'index']);

    // Route::get('pages.product', [ProductController::class, 'index']);
    // Route::post('uploadproduct', [ProductController::class, 'store']);
    // Route::get('pages.showproduct', [ProductController::class, 'show']);
    // Route::get('download/{file}', [ProductController::class, 'download']);
    // Route::get('view/{id}', [ProductController::class, 'view']);

    Route::group(['middleware' => 'isLoggedIn'], function () {

        // Route::get('pages.dashboard', [DashboardController::class, 'index']);


        // ADD USERS ========================
        Route::get('users', [UserController::class, 'index']);
        Route::post('add_user', [UserController::class, 'add_user'])->name('add_new_user');

        Route::get('edit_user/{id}', [UserController::class, 'edit_user'])->name('add_user');
        Route::post('update_user/{id}', [UserController::class, 'update_user'])->name('update_user');
        Route::post('delete_user/{id}', [UserController::class, 'delete_user'])->name('delete_user');


        // PROFILE ========================
        Route::get('profile', [ProfileController::class, 'index']);
        Route::post('update_user_profile', [ProfileController::class, 'update_user_profile'])->name('update_user_profile');
        Route::post('change_password', [ProfileController::class, 'change_password'])->name('change_password');
        Route::post('delete_picture/{id}', [ProfileController::class, 'delete_profile_picture'])->name('delete_profile_picture');



        // UPLOAD FILES ========================
        Route::get('upload_file', [UploadFileController::class, 'index']);
        Route::post('uploadfile', [UploadFileController::class, 'upload_file'])->name('upload_file');
        Route::get('show_file', [UploadFileController::class, 'show_file'])->name('show_file');
        // Route::get('download_file/{file}', [UploadFileController::class, 'download_file'])->name('download_file');
        Route::get('download_file/{id}', [UploadFileController::class, 'download_file'])->name('download_file');
        Route::get('view_file/{id}', [UploadFileController::class, 'view_file'])->name('view_file');

        Route::get('edit_file/{id}', [UploadFileController::class, 'edit_uploaded_file'])->name('edit_uploaded_file');
        Route::post('update_file/{id}', [UploadFileController::class, 'update_file'])->name('update_file');
        Route::post('delete_file/{id}', [UploadFileController::class, 'delete_file'])->name('delete_file');

        // SHARE LINK ========================
        Route::get('share_link', [LinkController::class, 'index']);
        Route::post('share_link', [LinkController::class, 'share_link'])->name('share_link');
        Route::get('edit_shared_link/{id}', [LinkController::class, 'edit_link'])->name('edit_shared_link');
        Route::post('update_link/{id}', [LinkController::class, 'update_shared_link'])->name('update_shared_link');
        Route::post('delete_link/{id}', [LinkController::class, 'delete_shared_link'])->name('delete_shared_link');

        // Route::get('pages.edit_file/{id}', [UploadFileController::class, 'edit_uploaded_file']);

        // CREATE FOLDER ========================
        Route::get('create_folder', [FolderController::class, 'index']);
        Route::post('create_folder', [FolderController::class, 'create_folder'])->name('create_folder');
        Route::post('delete_folder/{id}', [FolderController::class, 'delete_folder'])->name('delete_folder');

        // USER GROUPS ========================
        Route::get('user_group', [UserGroupController::class, 'index']);
        Route::post('update_user_group', [UserGroupController::class, 'assign_group'])->name('assign_new_group');

        // LOGOUT ======================
        Route::get('logout', [LoginController::class, 'logout_user'])->name('logout');

    });

});


