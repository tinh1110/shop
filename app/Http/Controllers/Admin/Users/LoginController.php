<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\ProductAdminService;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $productService;

    public function __construct(ProductAdminService $productService)
    {
        $this->productService = $productService;
    }
    public function index(){
        return view('admin.users.login',[
            'title' => 'Đăng nhập'
        ]);

    }
    public function store(Request $request){
//        dd($request);
//        $remember = isset($request->input('remember')) ? true   : false;
        $this->validate($request,[
            'email' => 'required|email:filter',
            'password' => 'required',
            ]);

        if(Auth::attempt(['email' => $request->input('email'),
            'password' => $request->input('password'),
        ],$request->input('remember'))){
        return redirect()->route('admin');
        }
        Session::flash('error','email hoặc password không đúng');
        return redirect()->back();
    }
    public function abc(Product $product){
        return $this->productService->get();
    }
}
