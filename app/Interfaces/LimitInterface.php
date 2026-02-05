<?php

namespace App\Interfaces;

use App\Http\Requests\LimitRequest;

interface LimitInterface
{
    public function getAllData();
    public function createData(LimitRequest $request);
}
