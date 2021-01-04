<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\BettingRepositoryInterface;
use App\Repositories\Contracts\MatchRepositoryInterface;

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

      $routeName = "rounds.matches";

      $betting = $bettingRepository->findById($betting_id);

      $page = trans('bolao.Round_list').' - '.$betting->title;

      $breadcrumb =    
      [
        (object)['url'=>route('main').'#portfolio', 'title'=>trans('bolao.betting_list')],
        (object)['url'=>'', 'title'=>trans('bolao.list',['page'=>$page])]
      ];

      $titleAdd = trans('bolao.addRound');

        return view('site.rounds', compact('list','page','columnList', 'breadcrumb','titleAdd','routeName'));

    }


    public function matches($round_id, BettingRepositoryInterface $bettingRepository){  

      $list = $bettingRepository->matches($round_id);

      if(!$list){
        return redirect()->route('main');
      }

      $columnList = ['id'=>'#',
      'title'=>trans('bolao.title'), 
      'round_title'=>trans('bolao.Round'), 
      'stadium'=>trans('bolao.stadium'), 
      'date_site'=>trans('bolao.date'),   
      'acao'=>trans('bolao.action')];

      $page = trans('bolao.Match_list');

      $routeName = "match.result";

      $betting = $bettingRepository->findBetting($round_id);

      $breadcrumb =    
      [
        (object)['url'=>route('main').'#portfolio', 'title'=>trans('bolao.betting_list')],
        (object)['url'=>route('rounds', $betting->id), 'title'=>trans('bolao.Round_list').' - '.$betting->title],
        (object)['url'=>'', 'title'=>trans('bolao.list',['page'=>$page])]
      ];
      
      return view('site.matches', compact('list','page','columnList', 'breadcrumb','routeName'));

     // dd($list->toArray());

    }


    public function result($match_id, MatchRepositoryInterface $matchRepository, BettingRepositoryInterface $bettingRepository){  

      $register = $matchRepository->match($match_id);

      if(!$register){
        return redirect()->route('main');
      }

      $routeName = "match.result";
      $betting = $bettingRepository->findBetting($register->round->id);

      $page = trans('bolao.bet');
      $action = route($routeName.".update",$register->id);
      

      $breadcrumb =    
      [
        (object)['url'=>route('main').'#portfolio', 'title'=>trans('bolao.betting_list')],
        (object)['url'=>route('rounds', $betting->id), 'title'=>trans('bolao.Round_list').' - '.$betting->title],
        (object)['url'=>route('rounds.matches', $register->round->id), 'title'=>trans('bolao.list',['page'=>trans('bolao.match')])],
        (object)['url'=>'', 'title'=>trans('bolao.bet')]
      ];

      return view('site.betting', compact('register','page', 'breadcrumb','routeName','action'));

    }


    public function update($match_id, Request $request, MatchRepositoryInterface $matchRepository){  

      $data = $request->all();

      if($match = $matchRepository->MatchUserSave($match_id,$data)){
        session()->flash('msg',trans('bolao.record_successfully_updated'));
        session()->flash('status','success');
        return redirect()->route('rounds.matches',$match->round->id);

      }else{

        session()->flash('msg',trans('bolao.error_editing_record'));
        session()->flash('status','error');
        return redirect()->back();

      }

    }

    public function classification($betting_id, BettingRepositoryInterface $bettingRepository)
    {
      $columnList = ['OrderAsc'=>'#',
      'name'=>trans('bolao.name'), 
      'pontos'=>trans('bolao.points')];

      $betting = $bettingRepository->findById($betting_id);
      $page = trans('bolao.classification');

     $list = $bettingRepository->classification($betting_id);//retorna a lista ordenada com a classificação 
      $routeName = "";

      if(!$list){
        return redirect(route('main').'#portfolio');
      }

      $breadcrumb =    
      [
        (object)['url'=>route('main').'#portfolio', 'title'=>trans('bolao.betting_list')],
        (object)['url'=>'', 'title'=>trans('bolao.list',['page'=>$page])],
     
      ];

      return view('site.rounds', compact('list','page', 'columnList','breadcrumb','routeName'));


    }

   
}
