<?php

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
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('layouts.index');
});
Route::get('profil', function () {
    return view('profil');
});



Route::get('/', function() {
    return redirect(route('login'));
});
        // Auth::routes();
        // Route::group(['middleware' => 'auth'], function() {

        // //Route yang berada dalam group ini hanya dapat diakses oleh user
        // //yang memiliki role admin
        // Route::group(['middleware' => ['role:admin']], function () {
        Route::resource('/role', 'RoleController')->except([
            'create', 'show', 'edit', 'update'
        ]);

        Route::resource('/users', 'UserController')->except([
            'show'
        ]);
        Route::get('/users/roles/{id}', 'UserController@roles')->name('users.roles');
        Route::put('/users/roles/{id}', 'UserController@setRole')->name('users.set_role');
        Route::post('/users/permission', 'UserController@addPermission')->name('users.add_permission');
        Route::get('/users/role-permission', 'UserController@rolePermission')->name('users.roles_permission');
        Route::put('/users/permission/{role}', 'UserController@setRolePermission')->name('users.setRolePermission');
        Route::resource('peminjaman','PeminjamanController');

        Route::get('/peminjaman', 'PeminjamanController@index');
        Route::post('/peminjaman-store', 'PeminjamanController@store');
        Route::get('/peminjaman/{id}/edit', 'PeminjamanController@edit');
        Route::delete('/peminjaman-store/{id}', 'PeminjamanController@destroy');

        Route::get('/pengembalian', 'PengembalianController@index');
        Route::post('/pengembalian-store', 'PengembalianController@store');
        Route::get('/pengembalian/{id}/edit', 'PengembalianController@edit');
        Route::delete('/pengembalian-store/{id}', 'PengembalianController@destroy');
        Route::get('/pengembalian-db/{id}', 'PengembalianController@db');
        Route::get('viewpdf', 'PengembalianController@cetak_pdf')->name('pengembalian.cetak_pdf');
        Route::get('pengembalian-export_excel', 'PengembalianController@export_excel');

        Route::get('/petugas', 'PetugasController@index');
        Route::post('/petugas-store', 'PetugasController@store');
        Route::get('/petugas/{id}/edit', 'PetugasController@edit');
        Route::delete('/petugas-store/{id}', 'PetugasController@destroy');

        Route::get('/buku', 'BukuController@index');
        Route::post('/buku-store', 'BukuController@store');
        Route::get('/buku/{id}/edit', 'BukuController@edit');
        Route::delete('/buku-store/{id}', 'BukuController@destroy');

        Route::get('/anggota', 'AnggotaController@index');
        Route::post('/anggota-store', 'AnggotaController@store');
        Route::get('/anggota/{id}/edit', 'AnggotaController@edit');
        Route::delete('/anggota-store/{id}', 'AnggotaController@destroy');

        Route::get('/rak', 'RakController@index');
        Route::post('/rak-store', 'RakController@store');
        Route::get('/rak/{id}/edit', 'RakController@edit');
        Route::delete('/rak-store/{id}', 'RakController@destroy');
        // });
        Auth::routes();
        Route::get('/home', 'HomeController@index')->name('home');
    // });
