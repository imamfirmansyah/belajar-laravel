<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wali extends Model
{
    # Tentukan nama tabel terkait
	protected $table = 'wali';

	# MASS ASSIGNMENT
	# Untuk membatasi attribut yang boleh di isi (Untuk keamanan)
	protected $fillable = array('nama', 'id_mahasiswa');

	/*
	 * Relasi One-to-One
	 * =================
	 * Sebaliknya, buat function bernama mahasiswa(), dimana model 'Wali' memiliki relasi One-to-One (belongsTo)
	 * sebagai timbal balik terhadap model 'Mahasiswa'
	 */
	public function mahasiswa() {
		return $this->belongsTo('Mahasiswa', 'id_mahasiswa');
	}
}
