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

Route::get('belajar-relasi-table', function() {
	$html = '';

	$html .= 
		'<h2>Belajar Relasi Table</h2>
		<ul>
			<li><a href="relasi-one-to-one">Relasi One to One</a></li>
			<li><a href="relasi-one-to-many">Relasi One to Many</a></li>
			<li><a href="relasi-many-to-many">Relasi Many to Many</a></li>
		</ul>';

	return $html;
});

Route::get('relasi-one-to-one', function() {
	echo "<h3>Menampilkan Nama Wali dari Mahasiswa</h3>";
	echo '<a href="belajar-relasi-table">Kembali</a>';
	echo "<br>-----------------<br>";

	$data_mahasiswa = App\Mahasiswa::all();

	foreach ($data_mahasiswa as $data) {
		# Temukan mahasiswa berdasarkan nim
		$mahasiswa = App\Mahasiswa::where('nim', '=', $data->nim)->first();
		
		echo 'Nama : ' . $data->nama . ' - <strong>NIM : ' . $data->nim . '</strong><br>
			  Wali : ' . $mahasiswa->wali->nama . '<br>-----<br>';
	}
});

Route::get('relasi-one-to-many', function() {
	echo "<h3>Menampilkan seluruh mahasiswa bimbingan dari masing-masing dosen</h3>";
	echo '<a href="belajar-relasi-table">Kembali</a>';
	echo "<br>-----------------<br>";

	$data_dosen = App\Dosen::all();

	foreach ($data_dosen as $data) {
		
		# Temukan dosen dengan berdasarkan no induknya
		$dosen = App\Dosen::where('nipd', '=', $data->nipd)->first();
		
		# Tampilkan seluruh data mahasiswa didikannya
		echo 'Nama Dosen : <strong> ' . $dosen->nama . '</strong><br>';
		echo '-- Nama Mahasiswa bimbingan : ';
		foreach ($dosen->mahasiswa as $data) {
			echo '<li>' . $data->nama . ' - <strong>NIM : ' . $data->nim . '</strong></li>';
		}
		echo "-----<br><br>";
	}
});

Route::get('relasi-many-to-many', function() {

	echo '<div style="width: 50%; float: left;">';
	
	echo "<h3>Menampilkan Hobi dari masing-masing mahasiswa</h3>";
	echo '<a href="belajar-relasi-table">Kembali</a>';
	echo "<br>-----------------<br>";

	$data_mahasiswa = App\Mahasiswa::all();

	foreach ($data_mahasiswa as $data) {
		# Bila kita ingin melihat hobi berdasarkan nama mahasiswa
		$mahasiswa = App\Mahasiswa::where('nama', '=', $data->nama)->first();

		# Tampilkan seluruh hobi si mahasiswa
		echo 'Nama Mahasiswa : <strong> ' . $mahasiswa->nama . '</strong><br>';
		echo '-- Hobinya : ';

		foreach ($mahasiswa->hobi as $data) {
			echo '<li>' . $data->hobi . '</li>';
		}
		echo "-----<br><br>";
	}
	echo "</div>";
	
	echo '<div style="width: 50%; float: right;">';
	echo "<h3>Menampilkan Mahasiswa dari masing-masing hobi</h3>";
	echo '<a href="belajar-relasi-table">Kembali</a>';
	echo "<br>-----------------<br>";
	
	$data_hobi = App\Hobi::all();
	
	foreach ($data_hobi as $data) {
		# Temukan hobi 
		$hobi = App\Hobi::where('hobi', '=', $data->hobi)->first();

		# Tampilkan semua mahasiswa yang punya hobi mandi hujan
		echo 'Nama Mahasiswa dengan Hobi : <strong> ' . $hobi->hobi . '</strong><br>';
		echo '-- diantaranya : ';
		foreach ($hobi->mahasiswa as $data) {
			echo '<li>' . $data->nama . ' - <strong>NIM : ' . $data->nim . '</strong></li>';
		}
		echo "-----<br><br>";
	}

	echo "</div>";

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