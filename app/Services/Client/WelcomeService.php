<?php

namespace App\Services\Client;

use App\Models\Banner;
use App\Models\Notify;


class WelcomeService
{
    protected $banner;
    protected $notify;
    function __construct(Banner $banner, Notify $notify)
    {
        $this->banner = $banner;
        $this->notify = $notify;
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
