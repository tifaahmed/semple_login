<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Illuminate\Database\Eloquent\Builder;

// lInterfaces
use App\Repository\SiteSettingRepositoryInterface;
use App\Repository\PageDetailRepositoryInterface;
use App\Repository\ProductItemRepositoryInterface;
use App\Repository\ExtraCategoryRepositoryInterface;
use App\Repository\ProductCategoryRepositoryInterface;
use App\Repository\OptionCategoryRepositoryInterface;
use App\Repository\ProductPackageRepositoryInterface;
use DB;
class ProductController extends Controller
{
    // private $SiteSettingRepository;

    public function __construct(
        SiteSettingRepositoryInterface $SiteSettingRepository,
        PageDetailRepositoryInterface $PageDetailRepository,
        ProductItemRepositoryInterface $ProductItemRepository,
        ExtraCategoryRepositoryInterface $ExtraCategoryRepository,
        ProductCategoryRepositoryInterface $ProductCategoryRepository,
        OptionCategoryRepositoryInterface $OptionCategoryRepository,
        ProductPackageRepositoryInterface $ProductPackageRepository,
    )
    {
        $this->SiteSettingRepository = $SiteSettingRepository;
        $this->PageDetailRepository = $PageDetailRepository;
        $this->ProductItemRepository = $ProductItemRepository;
        $this->ExtraCategoryRepository = $ExtraCategoryRepository;
        $this->ProductCategoryRepository = $ProductCategoryRepository;
        $this->OptionCategoryRepository = $OptionCategoryRepository;
        $this->ProductPackageRepository = $ProductPackageRepository;
        
        $this->product_item_model = $this->ProductItemRepository->model();
        $this->product_package_model = $this->ProductPackageRepository->model();
        $this->default_per_page = 10;

    }

    public function index(Request $request){
        // return $request->all();

        $data['product_items'] = $this->ProductItemRepository->repo_filter([
            'page_seo','product_options','address',
            'product_packages' => function ($query) {
                $query->limit(3);
            },
        ])
        ->where('status','store_or_admin_active')
        ->whereHas('product_packages') 
        ->latest()->paginate($this->default_per_page)->appends(request()->query());

        $data['product_package_range'] = DB::table((new  $this->product_package_model)->getTable())
        ->selectRaw('MIN(price) AS price_start, MAX(price) AS price_end')->first();


        $data['product_categories'] = $this->ProductCategoryRepository->all(999,['*'],[])    ;
        $data['option_categories'] = $this->OptionCategoryRepository->all(999,['*'],['options'])    ;

        
        $data['page_detail_category']    = $this->PageDetailRepository->findById('2',['*'],['page_seo'])    ;
        return  view( 'pages.product.products',$data );
    }
    public function show($lang,$url)
    {
        $product_item = $this->product_item_model::
        whereHas('page_seo',function (Builder $query) use($url) {
            $query->where('page_url_title',$url) ;
        })
        ->whereHas('product_packages') 
        ->with([
            'page_seo','product_category',
            'store',
            'product_extras.extra_category',
            'product_options.option_category',
            'galleries','product_packages','user_rate_products.user'])->first();
            $extra_category_ids  = $product_item && count($product_item['product_extras'])  ? $product_item['product_extras']->pluck('extra_category.id')->toArray()   : [];
            $option_category_ids = $product_item && count($product_item['product_options']) ? $product_item['product_options']->pluck('option_category.id')->toArray() : [];

        $data['extra_categories'] = $this->ExtraCategoryRepository->all()->whereIn('id',$extra_category_ids);
        $data['option_categories'] = $this->OptionCategoryRepository->all()->whereIn('id',$option_category_ids);

        $data['product_item'] = $product_item;

        return  $product_item ? view( 'pages.product.product-details',$data ) : redirect()->back();
    }
}
