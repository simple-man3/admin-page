<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlatformController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
    }

    public function connect(Request $request)
    {
        $key = $request->input('key');
        if (!$key) {
            return collect([
                'result' => false,
                'message' => 'key doesn\'t exist'
            ])->toJson();
        }
        if ($key == env('PLATFORM_APP_KEY')) {
            return collect([
                'result' => true
            ])->toJson();
        }
        return collect([
            'result' => false,
            'message' => 'wrong key'
        ])->toJson();
    }

    public function pluginsList()
    {
        return collect(\App\Library\PluginSystem\PluginSystemManager::GetPlugins())->toJson();
    }
}
