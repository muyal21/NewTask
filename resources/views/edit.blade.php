<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h2 class="text-uppercase text-center mb-5">Edit Products</h2>
                
                      <form action="{{url('insert/'.$data->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                       <div class="form-group">
                       <label class="form-label" for="name">Name</label>
                        <input type="text" name="name"  value="{{$data->name}}" class="form-control">
                       </div><br><br>
                       <div class="form-group">
                       <label class="form-label" for="name">Amount</label>
                        <input type="text" name="amount"   value="{{$data->amount}}" class="form-control">
                       </div><br><br>
                       <div class="form-group">
                       <label class="form-label" for="name">Description</label>
                        <input type="text" name="description"  value="{{$data->description}}" class="form-control">
                       </div><br><br>
                       
                       <div class="form-group" class="form-control">
                        <button type="submit" class="btn btn-success">Update</button>
                       </div>
                       
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>