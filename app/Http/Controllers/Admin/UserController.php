<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;




class UserController extends Controller
{
    private $route = 'users';
    private $paginate = 5;
    private $search = ['name','email'];//list of columns from 'findWhereLike'
    private $model;
    private $modelRole;
    private $titleAdd;




    public function __construct(UserRepositoryInterface $model, RoleRepositoryInterface $modelRole)
    {
      $this->model = $model;
      $this->modelRole = $modelRole;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      if (Gate::denies('users-list')) {
   
        return $this->sessionMsg(trans('bolao.access_denied'),'error','home');
      }

      $columnList = ['id'=>'#','name'=>trans('bolao.name'), 'email'=>'E-mail', 'acao'=>trans('bolao.action')];

      $search = "";

      if(isset($request->search))
      {
        $search = $request->search;
        $list = $this->model->findWhereLike($this->search, $search,'id','DESC');
      }else {
        $list = $this->model->paginate($this->paginate,'id', 'DESC');
      }

      $page = trans('bolao.user_list');

      $routeName = $this->route;

      $breadcrumb = $this->breadcrumb('',trans('bolao.list',['page'=>$page]),'','');//breadcrumb($url1, $title1, $url2, $title2)
      

      $titleAdd = trans('bolao.addUser');

        return view('admin.'.$routeName.'.index', compact('list','search','page', 'routeName','columnList', 'breadcrumb','titleAdd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

      if (Gate::denies('create-users')) {
   
        return $this->sessionMsg(trans('bolao.access_denied'),'error','home');
      }

      $page_create = trans('bolao.user');
      $page = trans('bolao.user_list');

      $roles = $this->modelRole->all('name');

      $routeName = $this->route;

      $breadcrumb = $this->breadcrumb(route($routeName.".index"),trans('bolao.list',['page'=>$page]),'',trans('bolao.create_crud',['page'=>$page_create]));//breadcrumb($url1, $title1, $url2, $title2)


      $titleAdd = trans('bolao.edit_crud',['page'=>$page_create]);
      $action = route($routeName.'.store');

        return view('admin.'.$routeName.'.create', compact('page','page_create', 'routeName','action', 'breadcrumb','titleAdd','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      if (Gate::denies('create-users')) {
   
        return $this->sessionMsg(trans('bolao.access_denied'),'error','home');
      }

      $data = $request->all();

      $messages =  $this->validateMsg();

      $this->validator('unique:users','',$data,$messages);


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
      if (Gate::denies('show-users')) {
   
        return $this->sessionMsg(trans('bolao.access_denied'),'error','home');
      }

      $routeName = $this->route;

      $register = $this->model->findById($id);

      if($register){

        $page_create = trans('bolao.user');
        $page = trans('bolao.user_list');

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

      
      if (Gate::denies('edit-users')) {
   
        return $this->sessionMsg(trans('bolao.access_denied'),'error','home');
      }

      

      $routeName = $this->route;

      // não deixa possivel editar um SuperAdmin
      $register = $this->model->findById($id);
  //     if($register->name == 'SuperAdmin'){
  //     if($this->model->hasRoles('SuperAdmin') == false){
  //       dd("não é adm");
  //       return $this->sessionMsg(trans('bolao.access_denied'),'error',$routeName.".index");
  //     }

      if($register){

        $page_create = trans('bolao.user');
        $page = trans('bolao.user_list');

        $roles = $this->modelRole->all('name');

        $breadcrumb = $this->breadcrumb(route($routeName.".index"),trans('bolao.list',['page'=>$page]),'',trans('bolao.edit_crud',['page'=>$page_create]));//breadcrumb($url1, $title1, $url2, $title2)

     
      $action = route($routeName.".update",$register->id);

      return view('admin.'.$routeName.'.edit', compact('register','page', 'page_create','routeName', 'breadcrumb', 'action','roles'));


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

      if (Gate::denies('edit-users')) {
   
        return $this->sessionMsg(trans('bolao.access_denied'),'error','home');
      }

      $data = $request->all();

      if(!$data['password'])//se o campo não tiver preenchido, retira ele do array
      {
        unset($data['password']);
      }

       $messages =  $this->validateMsg();

       $this->validator(Rule::unique('users')->ignore($id),'sometimes',$data,$messages);

      $routeName = $this->route;


      if($this->model->update($data,$id)){

        return $this->sessionMsg(trans('bolao.record_successfully_updated'),'success', $routeName.".index");
       
        

      }else{

        return $this->sessionMsg(trans('bolao.error_editing_record'),'error','back');
       
    
      }
  }

  public function destroy($id)
  {
    if (Gate::denies('delete-users')) {
   
      return $this->sessionMsg(trans('bolao.access_denied'),'error','home');
    }

    $routeName = $this->route;

    // não deixa possivel deletar um SuperAdmin
    // $register = $this->model->findById($id);
    // if($register->name == 'SuperAdmin'){
    //   return $this->sessionMsg(trans('bolao.access_denied'),'error',$routeName.".index");
    // }

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

  public function validateMsg()
  {

    return $messages = [
      'name.required' =>__('bolao.Required',['atributo'=>trans('bolao.name')]),
      'password.required' =>__('bolao.Required',['atributo'=>trans('bolao.password')]),
      'email.required' =>__('bolao.Required',['atributo'=>'E-mail']),
      'min' =>__('bolao.min8'),
      'confirmed'=>__('bolao.confirm')
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

  public function validator($unique,$sometimes,$data,$messages)
  {
    
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', $unique],
        'password' => [$sometimes,'required', 'string', 'min:8', 'confirmed'],
      ],$messages)->validate();


    
  }
  
}
