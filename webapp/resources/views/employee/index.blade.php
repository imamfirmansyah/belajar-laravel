<!-- index.blade.php -->

<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>List Employee</title>
   <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
   <div class="container">
      <br />
      @if (\Session::has('success'))
      <div class="alert alert-success">
         <p>{{ \Session::get('success') }}</p>
      </div><br />
      @endif
      <div class="row">
         <div class="col-md-6"></div>
         <div class="col-md-6 text-right">
            <a href="{{action('EmployeeController@create')}}" class="btn btn-success">Create</a>
         </div>
         <div class="col-md-12">
            <br>
         </div>
      </div>
      
      <table class="table table-striped">
         <thead>
            <tr>
               <th>ID</th>
               <th>Name</th>
               <th colspan="2" class="text-center">Action</th>
            </tr>
         </thead>
         <tbody>
            @php 
               $no = 1;
            @endphp

            @foreach($employees as $employee)
            <tr>
               <td>{{ $no++ }}</td>
               <td>{{ $employee['name'] }}</td>

               <td align="right"><a href="{{action('EmployeeController@edit', $employee['id'])}}" class="btn btn-warning">Edit</a></td>
               <td align="left">
                  <form action="{{action('EmployeeController@destroy', $employee['id'])}}" method="post">
                     @csrf
                     <input name="_method" type="hidden" value="DELETE">
                     <button class="btn btn-danger" type="submit">Delete</button>
                  </form>
               </td>
            </tr>
            @endforeach
         </tbody>
      </table>
   </div>
</body>
</html>