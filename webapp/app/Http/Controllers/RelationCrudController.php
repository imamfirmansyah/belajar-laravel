<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use App\Dosen;
use App\Wali;
use App\Hobi;

class RelationCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_mahasiswa = Mahasiswa::with('wali', 'dosen', 'hobi')->get();
        
        return view('relation_crud.index', compact('data_mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa_hobi = array();

        $data_dosen = Dosen::all()->toArray();
        $data_wali = Wali::all()->toArray();
        $data_hobi = Hobi::all()->toArray();

        foreach ($mahasiswa->hobi as $data) {
            $mahasiswa_hobi[] = $data->pivot->id_hobi;
        }

        return view('relation_crud.edit', compact('mahasiswa', 'data_dosen', 'data_wali', 'data_hobi', 'mahasiswa_hobi', 'id')
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nama = $request->get('mahasiswa');
        $mahasiswa->id_dosen = $request->get('dosen');
        $mahasiswa->hobi()->detach();
        $mahasiswa->hobi()->attach( $request->get('hobi') );

        $mahasiswa->save();

        return redirect('relation-crud');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return redirect('relation-crud')->with('success', 'Data Mahasiswa Has Been Deleted');
    }
}
