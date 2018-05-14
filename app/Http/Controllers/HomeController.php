<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($message=null)
    {
        $user_producten = Auth::user()->Producten;
        $geleend_aan_mij = Product::where('share_id',Auth::id())->get();
        $teruggeven_accepteren = Product::where('user_id','=',Auth::id())
            ->where('share_status','=','pending_terug')
            ->get();



        return view('home',[
            'user_producten'=>$user_producten,
            'message' => $message,
            'geleend_aan_mij'=>$geleend_aan_mij,
            'teruggeven_accepteren'=>$teruggeven_accepteren
        ]);

    }

    public function AddProduct(Request $request){

        if(!empty($request->productnaam)) {
            $new_prod = new Product();
            $new_prod->naam = $request->productnaam;
            $new_prod->user_id = Auth::id();
            $new_prod->save();
            $message = 'nieuw product toegevoegd';
        } else { $message = 'voer aub een naam in.'; }

        return $this->index($message);
    }

    public function accepteerLening(Request $request){

        Product::find($request->item_id)
            ->update(['share_status' => 'uitgeleend' , 'updated_at' => Carbon::now()]);
        return $this->index();
    }
    public function stopLening(Request $request){
        Product::find($request->item_id)
            ->update(['share_status' => 'owner' , 'share_id' => null]);
        return $this->index();
    }
    public function geefTerug(Request $request){
        Product::find($request->item_id)
            ->update(['share_status' => 'pending_terug'] );
        return $this->index();
    }
    public function accepteerRetour(Request $request){
        Product::find($request->item_id)
            ->update(['share_status' => 'owner' , 'share_id' => null]);

        return $this->index();
    }
}
