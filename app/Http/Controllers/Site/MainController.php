<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BettingRepositoryInterface;

class MainController extends Controller
{
    public function index(BettingRepositoryInterface $bettingRepository)
    {
        $list = $bettingRepository->list();

        return view('site.index', compact('list'));
    }
}
