<?php

use App\Models\Dashboard\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

    class TE {

        /**
         * Sweet Alert
         * @param string Title
         * @param string Icon [ info, success, warning, danger ]
         * @param string Message
         * @param string Redirect: (optional) url
         */
        public static function alert($title, $icon, $message, $redirect = null)
        {
            $res = [
                "alert" => [
                    'title' => $title,
                    'icon' => $icon,
                    'message' => $message,
                    'redirect' => $redirect,
                ]
            ];

            return response()->json($res);
        }

        /**
         * Sweet Toast
         * @param string Icon [ info, success, warning, danger ]
         * @param string Message
         * @param string Redirect: (optional) url
         */
        public static function toast($icon, $message, $redirect = null)
        {
            $res = [
                "toast" => [
                    'icon' => $icon,
                    'message' => $message,
                    'redirect' => $redirect,
                ]
            ];

            return response()->json($res);
        }

        public static function breadcrumb() {
            $getRName = request()->route()->getName();
            $getParm = (request()->route()->hasParameter('id')) ? request()->route('id'): null;
            $getUrl = ($getParm) ? route($getRName, $getParm): route($getRName);
            $getUrlMod = str_replace(['http://', 'https://'], '', $getUrl);
            $sepUrl = explode('/', $getUrlMod);
            unset($sepUrl[0]);
            $li = '';
            foreach ($sepUrl as $key => $value) {
                if (Route::has($value)) {
                    $active = ($value == $getRName) ? 'active':null;
                    $aTag = ($active) ? $value:'<a href="'.route($value).'">'.$value.'</a>';
                    $li .= '<li class="breadcrumb-item '.$active.'">'.$aTag.'</li>'."\n";
                } else {
                    $active = ($value == $getRName) ? 'active':null;
                    $li .= '<li class="breadcrumb-item '.$active.'">'.$value.'</li>'."\n";
                }
            }
            $lo = '<ol class="breadcrumb m-0 text-capitalize">'.$li.'</ol>';
            return $lo;
        }

        public static function system($name, $default = false) {
            if (Schema::hasTable('settings')) {
                $getSettings = Setting::all();
                $systemSettings = [];
                foreach ($getSettings as $key => $value) {
                    $systemSettings[$value->name] = $value->value;
                }
            } else {
                $systemSettings = false;
            }
            return (isset($systemSettings[$name])) ? $systemSettings[$name] : $default;
        }

    }