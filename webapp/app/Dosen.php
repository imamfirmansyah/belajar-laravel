<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    # Tentukan nama tabel terkait
	protected $table = 'dosen';

	# MASS ASSIGNMENT
	# Untuk membatasi attribut yang boleh di isi (Untuk keamanan)
	protected $fillable = array('nama', 'nipd');

	/*
	 * Relasi One-to-Many
	 * ==================
	 * Buat function bernama mahasiswa(), dimana model 'Dosen' akan memiliki 
	 * relasi One-to-Many terhadap model 'Mahasiswa' sebagai 'id_dosen'
	 */
	public function mahasiswa() {
		return $this->hasMany('App\Mahasiswa', 'id_dosen');
	}
}
