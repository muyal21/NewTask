<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userdata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/admindashboard.css">
</head>
<body>
<section id="sidebar">
    <div class="sidebar-brand">
        <h2><i class="fa-solid fa-desktop"></i><span>&nbsp;ADMIN DASHBOARD</span></h2>
    </div>
    <div class="sidebar-menu">
        <ul>
            <li><a id="product" href="/products"><i class="fa fa-user"></i><span>Products</span></a></li>
            <li><a id="create" href="/createproduct"><i class="fa fa-user"></i><span>Create Product</span></a></li>
            <li><a id="logout_id" href="/logout"><i class="fa-solid fa-right-from-bracket"></i><span>LOGOUT</span></a></li>
        </ul>
    </div>
</section>
<section id="main-content">
    <div class="container">
        <div class="">
            <a href="admin/dashbord"><button class="btn btn-secondary binbutton"><<- Go back</button></a>
        </div>
        <div class="divhead">
            <h1><span class ="text-center heading">Users Data<span></h1>
        </div>
        <div class="divtable" >
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" class="spaces">Product ID</th>
                        <th scope="col" class="spaces">Product Name</th>
                        <th scope="col" class="spaces">Product Amount</th>
                        <th scope="col" class="spaces">Product Description</th>
                        <th scope="col" colspan="2" class="spaces">Actions</th>
                    </tr>
                </thead>
                @foreach($products as $items)
                <tbody>
                <tr>
                    <td class="space">{{$items->id}}</td>
                    <td class="space">{{$items->name}}</td>
                    <td class="space">{{$items->amount}}</td>
                    <td class="space">{{$items->description}}</td>
                    
                    <td style="width:0px;">
                    <a href="{{url('edit/'.$items->id)}}" class="btn btn-primary">EDIT</a>
                    
                    </td>
                    <td>
                    <a href="{{url('delete/'.$items->id)}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
    </div>
</section>
</body>
</html>