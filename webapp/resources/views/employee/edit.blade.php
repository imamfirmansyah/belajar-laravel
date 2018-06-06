<!-- edit.blade.php -->
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Laravel CRUD - EDIT </title>
   <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
   <div class="container">
      <h2>Update Employee</h2><br  />
      <form method="post" action="{{action('EmployeeController@update', $id)}}">
         @csrf
         <input name="_method" type="hidden" value="PATCH">
         <div class="row">
            <div class="col-md-12"></div>
            <div class="form-group col-md-4">
               <label for="name">Name:</label>
               <input type="text" class="form-control" name="name" value="{{$employee->name}}">
            </div>
         </div>
         <div class="row">
            <div class="col-md-12"></div>
            <div class="form-group col-md-12" style="margin-top:10px">
               <button type="submit" class="btn btn-success">Update</button>
            </div>
         </div>
      </form>
   </div>
</body>
</html>