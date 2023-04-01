<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;

    protected $table = 'site_settings';
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $fillable = [
        'item_key', // string , unique [note: "logo , name"]
        'item', // string  [note: "http , atafal "] 
    ];

    public function getSiteFeeNumberAttribute(){ // site_fee_number
        return $this->where('item_key','site_fee_number')->first()->item;
    }
    public function getSiteFeePercentAttribute(){ // site_fee_percent
        return $this->where('item_key','site_fee_percent')->first()->item;
    }
    
}
