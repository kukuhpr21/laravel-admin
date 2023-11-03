<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function createSessionFlash($request, $action_message, $status)
    {
        $section = ($status) ? 'success' : 'failed';
        $startMessage = ucwords($section);
        $request->session()->flash($section, $startMessage . ' ' . $action_message);
    }
}
