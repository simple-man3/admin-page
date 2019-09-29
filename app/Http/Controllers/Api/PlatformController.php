<?php

namespace App\Http\Controllers\Api;

use App\Library\PluginSystem\PlatformManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

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

    public function pluginFind(Request $request)
    {
        $vendor = $request->input('vendor');
        $package = $request->input('package');
        $version = $request->input('version'); // optional

        return collect([
            'plugin' => \App\Library\PluginSystem\PluginSystemManager::FindPlugin($vendor, $package, $version)
        ])->toJson();
    }

    public function pluginInstall(Request $request)
    {
        $vendor = $request->input('vendor');
        $package = $request->input('package');
        $version = $request->input('version');

        $installResult = false;
        try {
            PlatformManager::installPlugin($vendor, $package, $version);
            $installResult = true;
        } catch (\Exception $e) {
            Log::error('Plugin has not been installed)', [
                'message' => $e->getMessage(),
                'vendor' => $vendor,
                'package' => $package,
                'version' => $version,
            ]);
        }

        return collect([
            'result' => $installResult,
        ])->toJson();
    }

    public function pluginUpdate(Request $request)
    {
        $vendor = $request->input('vendor');
        $package = $request->input('package');
        $version = $request->input('version');

        PlatformManager::updatePlugin($vendor, $package, $version);

        return collect([
            'result' => true, // TODO check result of updating
        ])->toJson();
    }

    public function pluginDelete(Request $request)
    {
        $vendor = $request->input('vendor');
        $package = $request->input('package');
        $version = $request->input('version'); // optional

        $deleteResult = PlatformManager::deletePlugin($vendor, $package, $version);

        return collect([
            'result' => $deleteResult
        ])->toJson();
    }
}
