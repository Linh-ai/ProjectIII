<?php
namespace App\Repositories;

interface BaseRepositoryInterface {
    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * @param $id
     * @param $attribites
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

}
