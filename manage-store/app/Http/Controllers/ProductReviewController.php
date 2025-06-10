<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductReviewController extends Controller
{
    public function index(){
        $productReview=DB::table('reviewproduct')
                        ->join('users', 'users.IdUser', '=', 'reviewproduct.IdUser')
                        ->join('products', 'products.IdProduct', '=', 'reviewproduct.IdProduct')
                        ->select('products.*', 'users.*', 'reviewproduct.*')
                        ->get();
        return view('productReview.indexProductReview', compact('productReview'));
    }

    public function edit($IdReview){
        $detailProductReview = DB::table('reviewproduct')
                                ->join('users', 'users.IdUser', '=', 'reviewproduct.IdUser')
                                ->join('products', 'products.IdProduct', '=', 'reviewproduct.IdProduct')
                                ->where('reviewproduct.IdReview', $IdReview)
                                ->select('products.*', 'users.*', 'reviewproduct.*')
                                ->get();
        return view('productReview.detailProductReview', compact('detailProductReview'));
    }
}