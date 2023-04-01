<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            SiteSetting::all()->delete();
        } catch (\Exception $e) {
            SiteSetting::query()->forceDelete();
        }

        $data = [
            [
                'id' => '1',
                'item_key' => 'site_logo',
                'item' => 'site-setting/2023-03-04-02-46-28/zpOzHoiNGzkj7E8iasENAaet1DyvJwT3nI9S2puq.png',
                'item_type' => 'image',
            ],
            [
                'id' => '2',
                'item_key' => 'site_fav_icon',
                'item' => 'site-setting/2023-03-04-02-47-23/sfdknT5x5fN4RzXaC0hwOHYPuYHetcV97zeQgVV9.png',
                'item_type' => 'image',
            ],
            [
                'id' => '3',
                'item_key' => 'site_name_en',
                'item' => 'weactivety',
                'item_type' => 'string',
            ],
            [
                'id' => '4',
                'item_key' => 'site_name_ar',
                'item' => 'وى جرافيتى',
                'item_type' => 'string',
            ],
            [
                'id' => '5',
                'item_key' => 'site_email',
                'item' => 'weactivety@gmail.com',
                'item_type' => 'email',
            ],
            [
                'id' => '6',
                'item_key' => 'site_phone',
                'item' => '966562515451',
                'item_type' => 'integer',
            ],

        ];
        foreach ($data as $val) {
            SiteSetting::create($val);
        }
    }
}
