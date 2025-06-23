<?php

namespace App\Http\Controllers;

use App\Traits\JsonResponseTrait;

abstract class Controller
{

    use JsonResponseTrait;

    /**
     * limit for paginate
     * @var int
     *
     */
    protected $limit = 30;
}
