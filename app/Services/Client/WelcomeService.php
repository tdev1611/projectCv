<?php

namespace App\Services\Client;

use App\Models\Banner;
use App\Models\Notify;
use App\Models\CodeDiscount;


class WelcomeService
{
    protected $banner;
    protected $notify;
    protected $codeDiscount;
    function __construct(Banner $banner, Notify $notify, CodeDiscount $codeDiscount)
    {
        $this->banner = $banner;
        $this->notify = $notify;
        $this->codeDiscount = $codeDiscount;
    }


    function getCodeDiscount()
    {
        return $this->codeDiscount->where('status', 1)->oldest('code')->get();
    }
    function getNotify()
    {
        return $this->notify->where('status', 1)->first();
    }
    function getBanner()
    {
        return  $banners = $this->banner->where('status', 1)->oldest('prioty')->get();
    }
}
