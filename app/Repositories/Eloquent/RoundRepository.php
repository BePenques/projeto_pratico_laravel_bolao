<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RoundRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use App\Round;

class RoundRepository extends AbstractRepository implements RoundRepositoryInterface
{
    protected $model = Round::class;

    public function paginate(int $paginate = 10, string $column = 'id', string $order = 'ASC'):LengthAwarePaginator
    {
      $user = auth()->user();

      if(Gate::denies('manage-bets')){
        return $this->model->whereIn('betting_id',[$user->bettings()->value('id')] ?? [])->orderBy($column, $order)->paginate($paginate);
      }

      return $this->model->orderBy($column, $order)->paginate($paginate);
      
    }

    public function findWhereLike(array $columns, string $search, string $column = 'id', string $order = 'ASC'):Collection
    {

      $user = auth()->user();

      $query = $this->model;

      if(Gate::denies('manage-bets')){      
        foreach ($columns as $key => $value) {

          $query = $query->orWhere($value,'like','%'.$search.'%');

        }
        return $query->whereIn('betting_id',[$user->bettings()->value('id')] ?? [])->orderBy($column, $order)->get();
      }

      foreach ($columns as $key => $value) {

        $query = $query->orWhere($value,'like','%'.$search.'%');

      }

      return $query->orderBy($column, $order)->get();

    }

    public function create(array $data):Bool
    {

        $user = auth()->user();
        $listRel = $user->bettings;
        $betting_id = $data['betting_id'];
        $exist = false;

        foreach ($listRel as $key => $value) {
           if($betting_id == $value->id){
                $exist = true;
           }
        }

        if($exist){
            return (bool) $this->model->create($data);
        }else{
            return false;
        }

    }

    public function update(array $data, int $id):Bool
    {
      if (Gate::denies('manage-bets')) {
        $register = $this->find($id);
        if($register){
            $user = auth()->user();
            $listRel = $user->bettings;
            $betting_id = $data['betting_id'];
            $exist = false;

            foreach ($listRel as $key => $value) {
                if($betting_id == $value->id){
                    $exist = true;
                }
            }
            if($exist){
                return (bool) $register->update($data);
            }else{
                return false;
            }

        }else{
            return false;
        }
      }

      $register = $this->findById($id);
      if($register){
          return (bool) $register->update($data);
      }else{
        return false;
      }
    
    }


}