<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Illuminate\Database\Eloquent\Builder;

// lInterfaces
use App\Repository\UserRateProductRepositoryInterface;
// Requests
use App\Http\Requests\Mvc\Site\UserRateProduct\UserRateProductStoreApiRequest;

class RateController extends Controller
{
    public function __construct(UserRateProductRepositoryInterface $UserRateProductRepository){
        $this->UserRateProductRepository = $UserRateProductRepository;
    }
    public function store(UserRateProductStoreApiRequest $request){
        $this->UserRateProductRepository->create($request->all());
        return redirect()->back()->with('success', 'success');
    }
}