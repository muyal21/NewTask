<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
</head>
<body>
    <section class="vh-100 bg-image"

  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Add Products</h2>
             
              <form action="/save_product" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-outline mb-4">
                  <input type="text" name="name" id="name" class="form-control form-control-lg" value="{{ old('name') }}" />
                  <label class="form-label" for="name">Name</label>
                  <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                </div>

                <div class="form-outline mb-4">
                  <input type="number" name="amount" id="amount" class="form-control form-control-lg" value="{{ old('amount') }}" />
                  <label class="form-label" for="amount">Amount</label>
                  <span class="text-danger"> @error('amount'){{ $message }}@enderror </span>
                </div>
                <div class="form-outline mb-4">
                  <input type="text" name="description" id="description" class="form-control form-control-lg" value="{{ old('description') }}" />
                  <label class="form-label" for="description">Description</label>
                  <span class="text-danger"> @error('description'){{ $message }}@enderror </span>
                </div>
             
                <div class="form-outline mb-4">
                  <input type="file" name="image" id="image" class="form-control form-control-lg" value="" />
                  <label class="form-label" for="image">Image</label>
                  <span class="text-danger"> @error('image'){{ $message }}@enderror </span>
                </div>  

                  <div class="d-flex justify-content-center">
                    <button type="submit" 
                      class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Add Product</button>
                  </div>
              </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>






                         
               