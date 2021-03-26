<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Kodewbit\YouTube\Contracts\YouTube;

abstract class ApiController extends BaseController
{
    /**
     * Current API version.
     *
     * @type string
     */
    const VERSION = '1.0.0';

    /**
     * Google Service YouTube Instance.
     *
     * @var YouTube
     */
    public $youtube;

    /**
     * ApiController constructor.
     *
     * @param YouTube $youtube
     */
    public function __construct(YouTube $youtube)
    {
        $this->youtube = $youtube;
    }

    /**
     * Determine if the request wants extended information.
     *
     * @param Request $request
     * @return bool
     */
    public function wantsExtendedInformation(Request $request)
    {
        return $request->filled('extended') && $request->boolean('extended');
    }
}
