<!-- create.blade.php -->
<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8">
   <title>Tutorial CRUD Sederhana Laravel 5.6  </title>
   <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
   <div class="container">
      <h2>Employee List</h2><br/>
      <form method="post" action="{{url('employees')}}" enctype="multipart/form-data">
         @csrf
         <div class="row">
            <div class="col-md-12"></div>
            <div class="form-group col-md-4">
               <label for="Name">Name:</label>
               <input type="text" class="form-control" name="name">
            </div>
         </div>
         <div class="row">
            <div class="col-md-12"></div>
            <div class="form-group col-md-4" style="margin-top:10px">
               <button type="submit" class="btn btn-success">Submit</button>
            </div>
         </div>
      </form>
   </div>
</body>
</html>