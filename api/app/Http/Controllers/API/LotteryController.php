<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LotteryController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $lotteries = Lottery::query()->get()->first();

        return $this->sendResponse($lotteries, 'OK');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $id = $request->input('id', 0);

        $response = Lottery::query()->updateOrCreate(compact('id'), $request->all());

        return $this->sendResponse($response, 'OK');
    }
}
