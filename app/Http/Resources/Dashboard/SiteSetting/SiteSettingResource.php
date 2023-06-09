<?php

namespace App\Http\Resources\Dashboard\SiteSetting;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class SiteSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        $model = $this;
        $lang_array = config('app.lang_array') ;

        
        
        if ($this->item_type == 'image') {
            $string_fields = ['item_key','item_type'];
            $image_fields  = ['item'];
        }else{
            $string_fields = ['item_key' , 'item','item_type'];
        }

        // $translated_image_fields  = [];
        // $translated_string_fields = [];

        // $date_fields   = [];


        $all=[];

        $all += [ 'id' =>   $this->id ]  ;
        // $all += [ 'product_sub_categories' =>   ProductSubCategoryResource::collection($this->product_sub_categories) ]  ;

        // $all += resource_translated_string($model,$lang_array,$translated_string_fields);
        // $all += resource_translated_image($model,$lang_array,$translated_image_fields);

        $all += resource_image($model  ?? [],$image_fields ?? []);
        $all += resource_string($model  ?? [],$string_fields  ?? []);

        $all += resource_date($model = [],$date_fields = []);
        
        return $all;
    }
}
