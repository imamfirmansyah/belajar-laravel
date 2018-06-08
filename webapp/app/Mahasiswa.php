<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    # Tentukan nama tabel terkait
	protected $table = 'mahasiswa';

	# MASS ASSIGNMENT
	# Untuk membatasi attribut yang boleh di isi (Untuk keamanan)
	protected $fillable = array('nama', 'nim', 'id_dosen');

	/*
	 * Relasi One-to-One
	 * =================
	 * Buat function bernama wali(), dimana model 'Mahasiswa' memiliki relasi One-to-One
	 * terhadap model 'Wali' sebagai 'id_mahasiswa'
	 */
	public function wali() {
		return $this->hasOne('App\Wali', 'id_mahasiswa');
	}

	/*
	 * Relasi One-to-Many
	 * =================
	 * Buat function bernama dosen(), dimana model 'Mahasiswa' memiliki 
	 * relasi One-to-Many (belongsTo) sebagai penerima 'id_dosen'
	 */
	public function dosen() {
		return $this->belongsTo('App\Dosen', 'id_dosen');
	}

	# Relasi Many-to-Many nanti disini...

	# Relasi Many-to-Many nanti disini...
}
