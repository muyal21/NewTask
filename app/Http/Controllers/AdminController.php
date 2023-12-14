<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Product;
use App\Models\Prod;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use Cookie;

class AdminController extends Controller
{
    public function login()
    {
        return view("adminlogin");
    }
    function admin_login(Request $req)
    {
        $validator = Validator::make($req->all(), [
          'email' =>    'required|min:5|max:100|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/ix',
          'password' => 'required|min:5|max:100',
        ]);
        
        if(!$validator->passes()){
            return response()->json(['error'=>$validator->errors()->toArray()]);
        }
    
        $user = Admin::where(['email'=>$req->email])->first();
        if (!$user || !Hash::check($req->password,$user->password))
        {
          return response()->json(['notexists' => 'Username or Password is not matched']);
        }
        else{
            Session::put('admin',$user);
            return response()->json(['success' => 'Sucessfully Logged In']);
        }
    }

    public function register()
    {
        return view("adminregister");
    }
    function admin_register(Request $req)
    {
        $validator = Validator::make($req->all(), [
          'name' => 'required|max:100',
          'email' => 'required|min:5|max:100|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,8}$/ix',
          'password' => 'required|min:5|max:100|regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9]).*$/',
          'confirmpassword' =>  'required|same:password',
        ]);
        
         if(!$validator->passes()){
            return response()->json([
               'error'=>$validator->errors()->toArray()
            ]);
          }

      $user = Admin::where('email',$req['email'])->first();

      if($user){
          return response()->json(['exists' => "Email already exists"]);
      }
      else{
          $user = new Admin;
          $user -> name = $req -> name;
          $user -> email = $req -> email;
          $user -> password = Hash::make($req -> password);
          $user->addresses = $req->addresses;
          $user -> save();
      }
      return response()->json(['success'=> 'Admin Registered sucessfully']);
    }

    public function dashboard()
    {
        return view('admindashboard');
    }

    public function logout()
    {
        Session::flush();
        return redirect('/');
    }

    public function create()
    {
        return view("create");
    }
    public function save_product(Request $req)
    {
        // return $req->all();

        $validator = Validator::make($req->all(), [
            'name' => 'required|max:100',
            'amount' => 'required',
            'description' => 'required|min:5|max:200',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
          ]);

        if(!$validator->passes()){
            return response()->json(['error'=>$validator->errors()->toArray()]);
        }
        $name = null;
        if($req->file('image')){
            $image = $req->file('image');
            $name = time().'.'.$image->extension();
            $path = public_path('Images');
            $image->move($path,$name);
        }

        $product = new Product;
        $product->name = $req->name;
        $product->amount = $req->amount;
        $product->description = $req->description;
        $product->image =  $name;
        $product->save();

        return response()->json(['success' => "Successfully product created"]);
    }

    public function products()
    {
        $products = Product::get();
        // dd("$products");
        return view('products',['products'=>$products]);
    }

    public function edit($id)
    {
        $data = Product::where('id', $id)->first();
        return view("edit", compact('data'));
    }

    public function insert(Request $req, $id)
    {
        $product = Product::find($id);
        $product->name = $req->input('name');
        $product->amount = $req->input('amount');
        $product->description = $req->input('description');
        $product->update();
        return redirect()->back()->with('update', 'Product Information is updated successfully');
    }

    public function delete($id)
    {
      $delete = Product::where('id', $id)->firstorfail()->delete();
      return redirect()->back()->with('productDeleted', 'The  Requested Product  is Deleted Successfully');   
    }

    public function order (Request $req)
    {
        $adminID =1;
        $validator = Validator::make($req->all(), [
            'amount' => 'required'
          ]);
          
           if(!$validator->passes()){
              return response()->json([
                 'error'=>$validator->errors()->toArray()
              ]);
            }

            $order = new Prod ([
                'amount' => $req->input('amount'),
                'admin_id' => $adminID
            ]);

            $order->save();

            return response()->json(['message' => 'Successfully']);
    }
}
