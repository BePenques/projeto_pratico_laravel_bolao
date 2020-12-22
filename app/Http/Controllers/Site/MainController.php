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

    public function signNoLogin(){
        return redirect(route('main').'#portfolio');
    }

    public function sign($id, BettingRepositoryInterface $bettingRepository){

        $bettingRepository->BettingUser($id);
        return redirect(route('main').'#portfolio');

    }

    public function rounds($betting_id, BettingRepositoryInterface $bettingRepository){  

      $columnList = ['id'=>'#',
                     'title'=>trans('bolao.title'), 
                     'betting_title'=>trans('bolao.betting_title'), 
                     'date_start'=>trans('bolao.date_start'), 
                     'date_end'=>trans('bolao.date_end'),   
                     'acao'=>trans('bolao.action')];


      $list = $bettingRepository->rounds($betting_id);

      if(!$list){

        return redirect(route('main').'#portfolio');
      }

      $betting = $bettingRepository->findById($betting_id);

      $page = trans('bolao.Round_list').' - '.$betting->title;

      $breadcrumb =    
      [
        (object)['url'=>route('main').'#portfolio', 'title'=>trans('bolao.betting_list')],
        (object)['url'=>'', 'title'=>trans('bolao.list',['page'=>$page])]
      ];

      $titleAdd = trans('bolao.addRound');

        return view('site.rounds', compact('list','page','columnList', 'breadcrumb','titleAdd'));

    }


    public function matches($round_id, BettingRepositoryInterface $bettingRepository){  

      $list = $bettingRepository->matches($round_id);

      dd($list->toArray());

    }
}
