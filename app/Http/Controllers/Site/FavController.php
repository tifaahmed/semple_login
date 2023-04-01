<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Illuminate\Database\Eloquent\Builder;
use Auth;
// lInterfaces
use App\Repository\UserFavProductRepositoryInterface;
// Requests
use App\Http\Requests\Mvc\Site\UserFavProduct\UserFaveProductStoreRequest;

class FavController extends Controller
{
    public function __construct(UserFavProductRepositoryInterface $UserFavProductRepository){
        $this->UserFavProductRepository = $UserFavProductRepository;
    }
    public function store(UserFaveProductStoreRequest $request){
        if (Auth::user()->fav_products()->where('product_id',$request->product_id)->first()) {
            $this->UserFavProductRepository->all()
            ->where('product_id',$request->product_id)
            ->where('user_id',Auth::user()->id)
            ->first()->delete();
            return redirect()->back()->with('success', 'success');        
        }else{
            $this->UserFavProductRepository->create($request->all());
            return redirect()->back()->with('success', 'success');
        }

    }
}