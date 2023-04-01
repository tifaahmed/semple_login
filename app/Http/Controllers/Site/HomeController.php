<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Models\Slider;
use App\Models\About;

// lInterfaces
use App\Repository\PageDetailRepositoryInterface;
use App\Repository\SliderRepositoryInterface;
use App\Repository\AboutRepositoryInterface;
use App\Repository\ProductCategoryRepositoryInterface;
use App\Repository\CountryRepositoryInterface;

class HomeController extends Controller
{
    private $SiteSettingRepository;
    private $SliderRepository;
    private $AboutRepository;
    private $ProductCategoryRepository;
    private $CountryRepository;

    public function __construct(
        PageDetailRepositoryInterface $PageDetailRepository,
        SliderRepositoryInterface $SliderRepository,
        AboutRepositoryInterface $AboutRepository,
        ProductCategoryRepositoryInterface $ProductCategoryRepository,
        CountryRepositoryInterface $CountryRepository
        )
    {
        $this->PageDetailRepository = $PageDetailRepository;
        $this->SliderRepository = $SliderRepository;
        $this->AboutRepository = $AboutRepository;
        $this->ProductCategoryRepository = $ProductCategoryRepository;
        $this->CountryRepository = $CountryRepository;
    }

    public function index()
    {
        $data['sliders']    =    $this->SliderRepository->all()    ;
        $data['about_us']   =    $this->AboutRepository->all()    ;
        $data['countries']  =    $this->CountryRepository->all(6,['*'],['governments'])    ;
        $data['product_categories']  =    $this->ProductCategoryRepository->all(6,['*'],
            [
                'product_items' => function ($query) {
                    $query->where('status','store_or_admin_active');
                    $query->whereHas('product_packages') ;
                    $query->whereHas('page_seo');
                    $query->limit(3);
                },
                'product_items.page_seo'
            ]
        ) ;
        $data['page_detail_home']    =    $this->PageDetailRepository->findById('1',['*'],['page_seo'])    ;

        return  view( 'pages.index',$data );
    }
}
