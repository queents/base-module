<?php

namespace Modules\Base\Services\Core\Concerns\Getters;

use App\Models\User;
use Illuminate\Support\Facades\File;
use Nwidart\Modules\Facades\Module;

trait Core
{
    public static function get(): array
    {
        $message = session()->get('message');
        session('message', "");
        if (\Module::collections()->has('Menu')) {
            if (File::exists(base_path('menu.json'))) {
                $menu = json_decode(File::get(base_path('menu.json')));
            } else {
                $menu = self::loadMenu();
            }
        } else {
            $menu = self::loadMenu();
        }
        $data = [
            "menus" => $menu,
            "trans" => self::loadLanguage(),
            "appName" => config('app.name'),
            "appUrl" => url('/'),
            "message" => $message,
        ];

        $share = self::loadShareData();

        if(auth('web')->user()){
            if(\Module::collections()->has('Notifications')){
                $share['notifications'] = get_notifications(10, User::class, auth('web')->user()->id);

                $share['token'] = auth('web')->user()->userTokensFcm ? auth('web')->user()->userTokensFcm->provider_token : false;
            }
        }

        return array_merge($data, $share);
    }
}
