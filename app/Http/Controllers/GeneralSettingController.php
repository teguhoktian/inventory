<?php

namespace App\Http\Controllers;

use App\APIResponseBuilder;
use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    //
    public function index(GeneralSettings $settings) : View {
        return view('settings.general-settings',[
            'settings' => $settings
        ]);
    }

    public function store(Request $request, GeneralSettings $settings) : JsonResponse {
        $settings->site_name = $request->site_name ?: $settings->site_name;
        $settings->site_url = $request->site_url ?: $settings->site_url;
        $settings->locale = $request->locale ?: $settings->locale;
        $settings->timezone = $request->timezone ?: $settings->timezone;
        $settings->per_page = $request->per_page ?: $settings->per_page;
        $settings->save();
        return APIResponseBuilder::success($settings, __('Pengaturan Berhasil Disimpan'), 200, ['redirectTo' => route('settings.general-settings')]);
    }

}
