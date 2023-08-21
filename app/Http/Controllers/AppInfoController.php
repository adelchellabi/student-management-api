<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppInfoController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'remote_ip' => $this->getRemoteIp($request),
            'host_ip' => $this->getHostIp(),
            'hostname' => $this->getHostname(),
            'versions' => $this->getVersions(),

        ]);
    }

    private function getRemoteIp(Request $request)
    {
        return $request->hasHeader('X-Forwarded-For')
            ? explode(',', $request->header('X-Forwarded-For'))[0]
            : $request->ip();
    }

    private function getHostIp()
    {
        return request()->server('SERVER_ADDR');
    }

    private function getHostname()
    {
        return request()->getHttpHost();
    }

    private function getVersions()
    {
        return [
            $this->getOSInformation(),
            $this->getPhpVersion(),
            $this->getMySQLVersion(),
        ];
    }

    private function getOSInformation()
    {
        if (! function_exists('shell_exec') || ! is_readable('/etc/os-release')) {
            return null;
        }

        $osRelease = file_get_contents('/etc/os-release');
        $osInfo = [];

        preg_match_all('/^([^=]+)=(.*)$/m', $osRelease, $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $osInfo[strtolower(trim($match[1]))] = trim($match[2], '"');
        }

        return [
            'type' => 'os',
            'name' => $osInfo['name'] ?? '',
            'version' => $osInfo['version_id'] ?? '',
        ];
    }

    private function getPhpVersion()
    {
        return
            [
                'type' => 'software',
                'name' => 'php',
                'version' => phpversion(),
            ];
    }

    private function getMySQLVersion()
    {
        try {
            $version = DB::select('select version() as version')[0]->version;

            return [
                'type' => 'service',
                'name' => 'mysql',
                'version' => $version,
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
