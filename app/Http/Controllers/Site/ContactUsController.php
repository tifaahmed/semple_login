<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Models\Slider;
use App\Models\About;

// lInterfaces
use App\Repository\SiteSettingRepositoryInterface;
use App\Repository\SliderRepositoryInterface;
use App\Repository\AboutRepositoryInterface;
use App\Repository\ProductCategoryRepositoryInterface;

class ContactUsController extends Controller
{
    // private $SiteSettingRepository;
    // private $SliderRepository;
    // private $AboutRepository;
    // private $ProductCategoryRepository;
    public function __construct(
        // SiteSettingRepositoryInterface $SiteSettingRepository,
        // SliderRepositoryInterface $SliderRepository,
        // AboutRepositoryInterface $AboutRepository,
        // ProductCategoryRepositoryInterface $ProductCategoryRepository
        )
    {
        // $this->SiteSettingRepository = $SiteSettingRepository;
        // $this->SliderRepository = $SliderRepository;
        // $this->AboutRepository = $AboutRepository;
        // $this->ProductCategoryRepository = $ProductCategoryRepository;
    }

    public function index()
    {
        return  view( 'pages.contact-us');

    }
}
