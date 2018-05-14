<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //

    public function __construct()
    {
        //$this->middleware('ownsproduct');
        $this->middleware('auth');
    }
    public function index( $id )
    {
        $this->middleware('ownsproduct');
        $message=null;
        $product = Product::find($id);
        //echo $product->share_id;
        //$a =  User::find($product->share_id);
        //var_dump($a);
        //$a = User::find($product->share_id)->count();


        if($product == null){
            $message = 'Product is niet gevonden';
            return redirect()->route('home', ['message' => 'Product is niet gevonden']);

        }
        //var_dump(Product::find($id));

        return view('Product',[
            'user'=>Auth::User(),
            'gebruikers'=>User::all(),
            'message' => $message,
            'product' => $product,
        ]);

    }

    public function removeProduct( $id ){
        $this->middleware('ownsproduct');
        if(Product::find($id)->user_id == Auth::id()){
            Product::find($id)->delete();
            return redirect()->route('home', ['message' => 'Product is verwijderd']);
        }
        return redirect()->route('home', ['message' => 'Product is niet verwijderd']);
    }

    public function deelUit(Request $request){
        print_r($request->all());
        $id = $request->id;
        $product= Product::find($id);
        $product->update(['share_status' => 'pending_uitgeleend' , 'share_id' => $request->leen_id]);


        //return '';
        return $this->index($id);
    }


}
