<!-- index.blade.php -->

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Relation CRUD Example</title>
   <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
   @if (\Session::has('success'))
   <div class="alert alert-success">
      <p>{{ \Session::get('success') }}</p>
   </div><br />
   @endif
   
   <body class="container">
      <h1>Data Mahasiswa</h1>
      <div class="col-sm-8 col-sm-offset-2">
         @foreach ($data_mahasiswa as $data)
            <a href="{{action('RelationCrudController@edit', $data['id'])}}" class="btn btn-sm btn-warning float-right">Edit</a>
            <form action="{{action('RelationCrudController@destroy', $data['id'])}}" method="post" class="float-right mr-2">
               @csrf
               <input name="_method" type="hidden" value="DELETE">
               <button class="btn btn-sm btn-danger" type="submit">Delete</button>
            </form>

            <h3>{{ $data['nama'] }} <small>[{{ $data['nim'] }}]</small></h3>
            <h5>Hobi : 
               @foreach($data->hobi as $temp) 
                  <small>{{ $temp['hobi']}}, </small> 
               @endforeach
            </h5>
            <h4>
               <li>Nama Wali : <strong>{{ $data->wali->nama }}</strong></li>
               <li>Dosen Pembimbing : <strong>{{ $data->dosen->nama }}</strong></li>
            </h4>
            <hr/>
         @endforeach
      </div>
   </body>
</body>
</html>