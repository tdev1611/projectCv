<?php

namespace App\View\Components\Client;

use Illuminate\View\Component;
use App\Models\SettingWeb;

class HeadSeo extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    private $settingWeb;
    public function __construct(SettingWeb $settingWeb)
    {
        $this->settingWeb = $settingWeb;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $setting = $this->settingWeb->where('status',1)->first();

        return view('components.client.head-seo',compact('setting'));
    }
}
