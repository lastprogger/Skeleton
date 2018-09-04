<?php
/**
 * Created by PhpStorm.
 * User: neduck
 * Date: 02/09/2018
 * Time: 16:28
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

Route::group(
    [
        'prefix'                          => 'internal_api/{version}',
        'namespace'                       => 'InternalApi',
        'middleware'                      => ['locale'],
        Controller::ACTION_GROUP_NAME_KEY => Controller::ACTION_GROUP_NAME_INTERNAL_API,
    ],
    function () {
    }
);
