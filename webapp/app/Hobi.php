<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hobi extends Model
{
    # Tentukan nama tabel terkait
	protected $table = 'hobi';

	# MASS ASSIGNMENT
	# Untuk membatasi attribut yang boleh di isi (Untuk keamanan)
	protected $fillable = array('hobi');

	/*
	 * Relasi Many-to-Many
	 * ===================
	 * Buat function bernama mahasiswa(), dimana model 'Hobi' memiliki relasi
	 * Many-to-Many (belongsToMany) terhadap model 'Mahasiswa' yang terhubung oleh
	 * tabel 'mahasiswa_hobi' masing-masing sebagai 'id_hobi' dan 'id_mahasiswa' 
	 */
	public function mahasiswa() {
		return $this->belongsToMany('App\Mahasiswa', 'mahasiswa_hobi', 'id_hobi', 'id_mahasiswa');
	}
}
