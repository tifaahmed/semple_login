<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response ;

use Session;
use Illuminate\Database\Eloquent\Builder;
use DB;
use App;
use Auth;
// lInterfaces
use App\Repository\SiteSettingRepositoryInterface;
use App\Repository\PageDetailRepositoryInterface;
use App\Repository\ProductItemRepositoryInterface;
use App\Repository\ExtraCategoryRepositoryInterface;
use App\Repository\ProductCategoryRepositoryInterface;
use App\Repository\OptionCategoryRepositoryInterface;
use App\Repository\ProductPackageRepositoryInterface;
use App\Repository\CountryRepositoryInterface;
use App\Repository\OrderRepositoryInterface;
use App\Repository\OrderStoreRepositoryInterface;
use App\Repository\OrderItemRepositoryInterface;
use App\Repository\ExtraRepositoryInterface;
use App\Repository\OrderItemExtraRepositoryInterface;
use App\Repository\OrderInformationRepositoryInterface;
use App\Repository\TimeSlotRepositoryInterface;
use App\Repository\OrderItemDateRepositoryInterface;
use App\Repository\StoreRepositoryInterface;
class BookingController extends Controller
{
    public function __construct(
        SiteSettingRepositoryInterface $SiteSettingRepository,
        ProductItemRepositoryInterface $ProductItemRepository,
        PageDetailRepositoryInterface $PageDetailRepository,
        ExtraCategoryRepositoryInterface $ExtraCategoryRepository,
        ExtraRepositoryInterface $ExtraRepository,
        ProductCategoryRepositoryInterface $ProductCategoryRepository,
        OptionCategoryRepositoryInterface $OptionCategoryRepository,
        ProductPackageRepositoryInterface $ProductPackageRepository,
        CountryRepositoryInterface $CountryRepository,
        OrderRepositoryInterface $OrderRepository,
        OrderStoreRepositoryInterface $OrderStoreRepository,
        OrderItemRepositoryInterface $OrderItemRepository,
        OrderItemExtraRepositoryInterface $OrderItemExtraRepository,
        OrderInformationRepositoryInterface $OrderInformationRepository,
        TimeSlotRepositoryInterface $TimeSlotRepository,
        OrderItemDateRepositoryInterface $OrderItemDateRepository,
        StoreRepositoryInterface $StoreRepository,
        
    ){
        $this->PageDetailRepository = $PageDetailRepository;
        $this->SiteSettingRepository = $SiteSettingRepository;
        $this->ProductItemRepository = $ProductItemRepository;
        $this->ExtraCategoryRepository = $ExtraCategoryRepository;
        $this->ProductCategoryRepository = $ProductCategoryRepository;
        $this->OptionCategoryRepository = $OptionCategoryRepository;
        $this->ProductPackageRepository = $ProductPackageRepository;        
        $this->CountryRepository = $CountryRepository;        
        $this->OrderRepository = $OrderRepository;        
        $this->OrderStoreRepository = $OrderStoreRepository;        
        $this->OrderItemRepository = $OrderItemRepository;        
        $this->ExtraRepository = $ExtraRepository;        
        $this->OrderItemExtraRepository = $OrderItemExtraRepository;        
        $this->OrderInformationRepository = $OrderInformationRepository;        
        $this->TimeSlotRepository = $TimeSlotRepository;        
        $this->OrderItemDateRepository = $OrderItemDateRepository;        
        $this->StoreRepository = $StoreRepository;        
        
        $this->product_item_model = $this->ProductItemRepository->model();
        $this->product_package_model = $this->ProductPackageRepository->model();
        $this->extra_model = $this->ExtraRepository->model();
        $this->time_slot_model = $this->TimeSlotRepository->model();
        $this->default_per_page = 10;
    }
    public function index($lang,$url){
        $data['page_detail_booking']    = $this->PageDetailRepository->findById('2',['*'],['page_seo'])    ;

        $product_item = $this->product_item_model::whereHas('page_seo',function (Builder $query) use($url) {
            $query->where('page_url_title',$url) ;
        })->with([
            'page_seo','product_category','store',
            'store','time_slots',
            'product_extras.extra_category',
            'product_options.option_category',
            'galleries','product_packages','user_rate_products.user',
            'order_item_dates' => function ($order_item_dates_query)  {
                $order_item_dates_query->whereHas('order_item',function ($order_item_query) {
                    $order_item_query->whereHas('order_store',function ($order_store_query) {
                        $order_store_query->where('order_status','confirmed');
                    }) ;
                });
            }
            
            ])->first();
        
        // array
        $data['days_number_ber_week'] =  $this->HelperNumberOfWeekDaysBetweenTwoDates($product_item->start_date_above_today,$product_item->end_date)  ; 
        // number
        $data['weeks_number']  = max( $data['days_number_ber_week'] ); 
        $count = 0;
        foreach ($data['days_number_ber_week'] as $key => $value) {
            $count = $count + $value;
        }
        $data['days_number'] =  $count;
        
        $extra_category_ids =  $product_item['product_extras']->pluck('extra_category.id')->toArray();
        $option_category_ids =  $product_item['product_options']->pluck('option_category.id')->toArray();

        $data['extra_categories'] = $this->ExtraCategoryRepository->all()->whereIn('id',$extra_category_ids);
        $data['option_categories'] = $this->OptionCategoryRepository->all()->whereIn('id',$option_category_ids);

        $data['product_item'] = $product_item;
        $data['week'] = ['Saturday','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday'];

        $data['option_categories'] = $this->CountryRepository->all()->whereIn('id',$option_category_ids);

            
        return  view( 'pages.product.checkout',$data );
    }
    public function store($lang,Request $request){
        // requested data
            $request_payment_type = $request->payment_type;
            $request_product_item_id = $request->product_item_id;
            $request_package_id = $request->package_id;
            $request_store_id = $request->store_id;
            $request_extra_ids = $request->extra_ids ?? [];
            $request_time_slots = $request->time_slots ?? [];
        // sitting
            $site_fee_number =  $this->get_site_fee_number();
            $site_fee_percent =  $this->get_site_fee_percent();

        // get product_item_model                   
            $product_data =  $this->ProductItemRepository->findById($request_product_item_id,['*'],['address']);
            $product_package = $this->ProductPackageRepository->findById($request_package_id);
            $price = $product_package->price;
            $note = $product_package->title;
            $quantity = 0;
        // extras
            $extras = $this->extra_model::ExtraIds($request_extra_ids)->get();

        //  get  related store 
            $store_model = $this->StoreRepository->findById($request_store_id,['*'],['address']);
            $store_fee_number =     $store_model->fee_number;
            $store_fee_percent =     $store_model->fee_percent;
            $store_discount_number = 0;

        // try {    

             //////1 create order_model  //////
                // sent payment_type
                //store basec data without calculate  the prices
                $order_model = $this->OrderRepository->custome_create($request_payment_type,$site_fee_number,$site_fee_percent);
            //////1  create order_model //////

            //////3  order_store_model //////
                 $order_store_model = $this->OrderStoreRepository->custome_create(
                    $order_model->id,
                    $store_model,
                    $coupon_model ?? null
                );
            //////3  order_store_model //////


            //////4  OrderItem //////
                // sent store_id(parent),product_model(get info),quantity of every product
                //store data without calculate  the prices
                $order_item_model = $this->OrderItemRepository->custome_create(
                    $order_store_model->id,
                    $product_data,
                    $price,
                    $quantity,
                    $note
                );
            //////4  OrderItem //////

                
            //////5  OrderItemExtra //////
                foreach ($extras as  $extra) {
                    // sent order_item_id , extra_model 
                    //store data with prices
                    $this->OrderItemExtraRepository->custome_create($order_item_model->id,$extra);
                }
            //////5  OrderItemExtra //////
            //////6  OrderItemdates //////
                foreach ($request_time_slots as $date => $time_slot_ids) {
                    $time_slots = $this->time_slot_model::TimeSlotIds($time_slot_ids)->get();
                    foreach ($time_slots  as $time_slot) {
                        $quantity = $quantity + 1 ;
                        $this->OrderItemDateRepository->custome_create($order_item_model->id,$time_slot,$date);
                    }
                }
            //////6  OrderItemdates //////
            //////4  OrderItem //////
                $order_item_extra_sub_totals = $this->get_calculated_order_item_extra_sub_totals(
                        $order_item_model
                    );
                $sub_total = $this->get_calculated_order_item_sub_total (
                        $price,
                        $quantity,
                        $order_item_extra_sub_totals
                    );
                $this->OrderItemRepository->update($order_item_model->id , [
                    'product_quantity'=>$quantity, 
                    'order_item_extra_sub_totals'=>$order_item_extra_sub_totals, // collect sub_total of table order_item_extras
                    'sub_total'=> $sub_total // (product_price after offer  * quantity ) + order_item_extra_sub_totals
                ]);
            //////4  OrderItem //////

            //////3  OrderStore //////
                $order_item_sub_totals = $this->get_order_item_sub_totals(
                    $order_store_model
                );


                $store_total_fees =    $this->get_calculated_store_total_fees(
                    $store_fee_number ,
                    $store_fee_percent ,
                    $order_item_sub_totals
                );

                $this->OrderStoreRepository->update($order_store_model->id ,[
                    'order_item_sub_totals'=>$order_item_sub_totals , 
                    'store_total_fees'=>$store_total_fees ,
                    'sub_total'=>  $order_item_sub_totals + $store_total_fees
                ]);
            //////3  OrderStore //////

            //////1  order //////
                $order_store_price_sub_totals = $this->get_calculated_order_store_price_sub_totals(
                    $order_model
                ) ;
                $order_store_retrieve_sub_totals = $this->get_calculated_order_store_retrieve_sub_totals(
                    $order_model
                );

                $order_total_fees =    $this->get_calculated_order_total_fees(
                    $order_store_price_sub_totals - $order_store_retrieve_sub_totals,
                    $site_fee_number,
                    $site_fee_percent
                ) ;  
                $total = $this->get_calculated_order_total(
                    $order_store_price_sub_totals,
                    $order_store_retrieve_sub_totals,
                    $order_total_fees,
                    ) ;
                   
                        
                $this->OrderRepository->update($order_model->id,[
                    'order_store_price_sub_totals'=>  $order_store_price_sub_totals,
                    'order_store_retrieve_sub_totals'=>  $order_store_retrieve_sub_totals,
                    'order_total_fees'=>   $order_total_fees,
                    'total'=>   $total
                ]);
            //////1  order //////

            //////5  OrderInformation //////
            $store_model->address()->first() ;
            $order_information_model = $this->OrderInformationRepository->custome_create(
                    $order_model->id,
                    $order_store_model,
                    $type ='store',
                    $name= $store_model->title,
                    $email= $store_model->user->email,
                    $phone=$store_model->phone,                    
                    $store_model['address']
                );
                $order_information_model = $this->OrderInformationRepository->custome_create(
                    $order_model->id,
                    $order_item_model,
                    $type ='product',
                    $name= $product_data->title,
                    $email= null,
                    $phone= null,   
                    $product_data['address']
                );
                 
                   $order_information_model = $this->OrderInformationRepository->custome_create(
                    $order_model->id,
                    $order_model,
                    $type ='clint',
                    $name= Auth::user()->full_name,
                    $email= Auth::user()->email,
                    $phone= Auth::user()->phone,   
                    Auth::user()->address
                );
            //////5  OrderInformation //////

            return  redirect(App()->getLocale().'/profile/customer/invoice/'.$order_model->order_code);
            
            
        // } catch (\Exception $e) {
        //     // $order_model->delete();
        //      return $this -> MakeResponseErrors(  
        //          [$e->getMessage()  ] ,
        //          'Errors',
        //          Response::HTTP_BAD_REQUEST
        //      );
        // }
    }
    public function change_status(Request $request,$lang,$id){
        $this->OrderStoreRepository->update( $id,['order_status' => $request->order_status]) ;
        return redirect()->back();
    }
    
}
