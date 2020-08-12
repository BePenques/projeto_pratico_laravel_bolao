<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;
use Validator;


class UserController extends Controller
{
    private $route = 'users';
    private $paginate = 1;
    private $search = ['name','email'];//list of columns from 'findWhereLike'
    private $model;
    private $titleAdd;




    public function __construct(UserRepositoryInterface $model)
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

      $columnList = ['id'=>'#','name'=>trans('bolao.name'), 'email'=>trans('bolao.email')];

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

      $breadcrumb = [
          (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
          (object)['url'=>'', 'title'=>trans('bolao.list',['page'=>$page])]
      ];

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

      $page_create = trans('bolao.user');
      $page = trans('bolao.user_list');

      $routeName = $this->route;

      $breadcrumb = [
          (object)['url'=>route('home'), 'title'=>trans('bolao.home')],
          (object)['url'=>route($routeName.".index"), 'title'=>trans('bolao.list',['page'=>$page])],
          (object)['url'=>'', 'title'=>trans('bolao.create_crud',['page'=>$page_create])]
      ];

      $titleAdd = trans('bolao.addUser');
      $action = route('users.store');

        return view('admin.'.$routeName.'.create', compact('page','page_create', 'routeName','action', 'breadcrumb','titleAdd'));
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

        $messages = [
          'name.required' =>__('bolao.Required',['atributo'=>trans('bolao.name')]),
          'password.required' =>__('bolao.Required',['atributo'=>trans('bolao.password')]),
          'email.required' =>__('bolao.Required',['atributo'=>trans('bolao.email')]),
          'min' =>__('bolao.min8'),
          'confirmed'=>__('bolao.confirm')
        ];  

        Validator::make($data, [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],$messages)->validate();

        $routeName = $this->route;

        if($this->model->create($data)){

          session()->flash('msg',trans('bolao.record_successfully_added'));
          session()->flash('status', 'success');

          return redirect(route('users.index')); 
         

        }else{
          session()->flash('msg', trans('bolao.record_successfully_added'));
          session()->flash('status', 'bolao.error_adding_record');
  
          return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
