<!-- edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Laravel CRUD Relation - EDIT </title>
   <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
   <div class="container">
      <h2>Update Data Mahasiswa</h2><br>
      <a href="{{action('RelationCrudController@index')}}" class="btn btn-sm btn-info">Kembali</a>
      <hr>
      <form method="post" action="{{action('RelationCrudController@update', $id)}}">
         @csrf
         <input name="_method" type="hidden" value="PATCH">
         <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Nama Mahasiswa</label>
            <div class="col-sm-6">
               <input type="text" class="form-control" name="mahasiswa" value="{{$mahasiswa->nama}}">
            </div>
         </div>
         <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Dosen Pembimbing</label>
            <div class="col-sm-6">
               <select name="dosen" class="form-control">
                  <option value="">-- Nama Dosen --</option>
                  @foreach ($data_dosen as $key => $val)
                  <option value="{{ $val['id'] }}" {{ $mahasiswa->dosen->id === $val['id'] ? "selected" : "" }}>{{ $val['nama'] }}</option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Nama Orang Tua / Wali</label>
            <div class="col-sm-6">
               <input type="text" class="form-control" disabled="disabled" name="wali" value="{{$mahasiswa->wali->nama}}">

               {{-- <select name="wali" class="form-control">
                  <option value="">-- Nama Orang Tua / Wali --</option>
                  @foreach ($data_wali as $key => $val)
                  <option value="{{ $val['id'] }}" {{ $mahasiswa->wali->id === $val['id'] ? "selected" : "" }}>{{ $val['nama'] }}</option>
                  @endforeach
               </select> --}}
            </div>
         </div>
         <div class="form-group row">
            <label for="staticEmail" class="col-sm-2 col-form-label">Hobi</label>
            <div class="col-sm-6">
               @foreach ($data_hobi as $key => $val)
                  <div class="form-check">
                     <input class="form-check-input" name="hobi[]" type="checkbox" id="{{ "hobi_". $val['id'] }}" value="{{ $val['id'] }}" {{ in_array( $val['id'], $mahasiswa_hobi ) ? "checked" : "" }}>
                     <label class="form-check-label" for="{{ "hobi_". $val['id'] }}">{{ $val['hobi'] }}</label>
                  </div>
               @endforeach
            </div>
         </div>
         <div class="row">
            <div class="form-group col-md-12" style="margin-top:10px">
               <button type="submit" class="btn btn-success">Update</button>
            </div>
         </div>
      </form>
   </div>
</body>
</html>