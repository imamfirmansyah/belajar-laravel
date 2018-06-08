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

Auth::routes();

Route::get('/', function () {
	return view('welcome');
});

Route::get('relasi-1', function() {
	# Temukan mahasiswa dengan NIM 1015015072
	$mahasiswa = App\Mahasiswa::where('nim', '=', '19300338')->first();

	# Tampilkan nama wali mahasiswa
	return $mahasiswa->wali->nama;

});

Route::get('relasi-2', function() {

	# Temukan mahasiswa dengan NIM 1015015072
	$mahasiswa = App\Mahasiswa::where('nim', '=', '49891287')->first();

	# Tampilkan nama dosen pembimbing
	return $mahasiswa->dosen->nama;

});

Route::get('relasi-3', function() {

	# Temukan dosen dengan yang bernama Elizabeth Fay
	$dosen = App\Dosen::where('nipd', '=', '49582134')->first();

	# Tampilkan seluruh data mahasiswa didikannya
	foreach ($dosen->mahasiswa as $temp)
		echo '<li> Nama : ' . $temp->nama . ' <strong>' . $temp->nim . '</strong></li>';
});

Route::group(['middleware' => ['web', 'auth']], function() {

	Route::get('/home', function() {
	    if (Auth::user()->admin == 0) {
	    	return view('home');
	    } else {
	    	$users['users'] = \App\User::all();
	    	return view('home_admin', $users);
	    }
	});
});

Route::resource('employees', 'EmployeeController');