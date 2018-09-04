<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public const ACTION_GROUP_NAME_KEY          = 'group_name';
    public const ACTION_GROUP_NAME_INTERNAL_API = 'internal_api';
    public const ACTION_GROUP_NAME_PUBLIC_API   = 'api';
}
