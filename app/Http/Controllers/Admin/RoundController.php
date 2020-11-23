<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RoundRepositoryInterface;
use Validator;



class RoundController extends Controller
{
    private $route = 'rounds';
    private $paginate = 1;
    private $search = ['title'];//list of columns from 'findWhereLike'
    private $model;
    private $titleAdd;




    public function __construct(RoundRepositoryInterface $model)
    {
      $this->model = $model;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $columnList = ['id'=>'#',
                     'title'=>trans('bolao.title'), 
                     'betting_title'=>trans('bolao.betting_title'), 
                     'date_start'=>trans('bolao.date_start'), 
                     'date_end'=>trans('bolao.date_end'),   
                     'acao'=>trans('bolao.action')];

  

      $search = "";

      if(isset($request->search))
      {
        $search = $request->search;
        $list = $this->model->findWhereLike($this->search, $search,'id','DESC');
      }else {
        $list = $this->model->paginate($this->paginate,'id', 'DESC');
      }
    


      $page = trans('bolao.Round_list');

      $routeName = $this->route;

      $breadcrumb = $this->breadcrumb('',trans('bolao.list',['page'=>$page]),'','');//breadcrumb($url1, $title1, $url2, $title2)
      

      $titleAdd = trans('bolao.addRound');

        return view('admin.'.$routeName.'.index', compact('list','search','page', 'routeName','columnList', 'breadcrumb','titleAdd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      $user = auth()->user();

      $listRel = $user->bettings;

      $page_create = trans('bolao.Round');
      $page = trans('bolao.Round_list');

      $routeName = $this->route;

      $breadcrumb = $this->breadcrumb(route($routeName.".index"),trans('bolao.list',['page'=>$page]),'',trans('bolao.create_crud',['page'=>$page_create]));//breadcrumb($url1, $title1, $url2, $title2)


      $titleAdd = trans('bolao.create_crud',['page'=>$page_create]);
      $action = route($routeName.'.store');

        return view('admin.'.$routeName.'.create', compact('page','page_create', 'routeName','action', 'breadcrumb','titleAdd','listRel'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $messages =  $this->validateMsg();

        $this->validator($data,$messages);

        $routeName = $this->route;

        if($this->model->create($data)){
         
          return $this->sessionMsg(trans('bolao.record_successfully_added'),'success', $routeName.".index");
    
        }else{

          return $this->sessionMsg(trans('bolao.error_adding_record'),'error', 'back');
      
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
      $routeName = $this->route;

      $register = $this->model->findById($id);

      if($register){

        $page_create = trans('bolao.Round');
        $page = trans('bolao.Round_list');

        $breadcrumb = $this->breadcrumb(route($routeName.".index"),trans('bolao.list',['page'=>$page]),'',trans('bolao.details_crud',['page'=>$page_create]));//breadcrumb($url1, $title1, $url2, $title2)
        
        $delete = false; //verify delete parameter

        if($request->delete ?? false)
        {
            $delete = true;
        }
      
        $action = route($routeName.".destroy",$register->id);

        return view('admin.'.$routeName.'.show', compact('register','page', 'page_create','routeName', 'breadcrumb','delete','action'));


      }

        return $this->sessionMsg(trans('Registro inexistente'),'error', $routeName.".index");
       
      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

      $routeName = $this->route;

      $user = auth()->user();

      $listRel = $user->bettings;

      $register = $this->model->findById($id);

      if($register){

        $page_create = trans('bolao.Round');
        $page = trans('bolao.Round_list');

        $breadcrumb = $this->breadcrumb(route($routeName.".index"),trans('bolao.list',['page'=>$page]),'',trans('bolao.edit_crud',['page'=>$page_create]));//breadcrumb($url1, $title1, $url2, $title2)

     
      $action = route($routeName.".update",$register->id);

      return view('admin.'.$routeName.'.edit', compact('register','page', 'page_create','routeName', 'breadcrumb', 'action', 'listRel'));


      }else{

        return $this->sessionMsg(trans('Registro inexistente'),'error', $routeName.".index");
       
      }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();


        $messages =  $this->validateMsg();

        $this->validator($data,$messages);

        $routeName = $this->route;


        if($this->model->update($data,$id)){

            return $this->sessionMsg(trans('bolao.record_successfully_updated'),'success', $routeName.".index");


        }else{

            return $this->sessionMsg(trans('bolao.error_editing_record'),'error','back');

        }
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $routeName = $this->route;

        if($this->model->delete($id)){

            return $this->sessionMsg('Registro deletado com sucesso!','success', $routeName.".index");
        

        }else{

            return $this->sessionMsg('Erro ao deletar registro','error','back');
            
        }
    }

    public function sessionMsg($msg, $status, $route)
    {
        session()->flash('msg',$msg);
        session()->flash('status', $status);

        if($route == 'back')
        {
        return redirect()->back();

        }else{

        return redirect()->route($route);  
        }
        
    }

    public function validateMsg(){

      return $messages = [
        'title.required' =>__('bolao.Required',['atributo'=>trans('bolao.title')]),
        'date_start.required' =>__('bolao.Required',['atributo'=>trans('bolao.date_start')]),
        'date_end.required' =>__('bolao.Required',['atributo'=>trans('bolao.date_end')]),
      ];

    }

    public function breadcrumb($url1, $title1, $url2, $title2)
    {

     if($url2 != '' || $title2 != ''){

        return [
          (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
          (object)['url'=>$url1, 'title'=>$title1],
          (object)['url'=>$url2, 'title'=>$title2]
        ];

     }else{
       
        return [
          (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
          (object)['url'=>$url1, 'title'=>$title1]
        ];
     }

    }

    public function validator($data,$messages)
    {
      
      return Validator::make($data, [
          'title' => ['required', 'string', 'max:255'],
          'date_start' => ['required'],
          'date_end' => ['required'],
          'betting_id' => ['required','integer'],
        
          
        ],$messages)->validate();
      
    }


}
