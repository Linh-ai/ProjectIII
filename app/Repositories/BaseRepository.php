<?php
namespace App\Repositories;

use App\Repositories\BaseRepositoryInterface;

abstract class BaseRepository implements BaseRepositoryInterface {

    //model muon tuong tac
    protected $model;
    abstract public function getModel();
    public function setModel() {
        $this->model = app()->make($this->getModel());
    }
    public function __construct(){
        $this->setModel();
    }

    //khai bao ham inteface
    public function getAll()
    {
        // TODO: Implement getAll() method.
        return $this->model->all();
    }
    public function find($id)
    {
        // TODO: Implement find() method.
        return $this->model->find($id);
    }
    public function create($attributes = [])
    {
        // TODO: Implement create() method.
        return $this->model->create($attributes);
    }
    public function update($id, $attributes = [])
    {
        // TODO: Implement update() method.
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }
    public function delete($id)
    {
        // TODO: Implement delete() method.
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            return true;
        }
        return false;
    }
}
