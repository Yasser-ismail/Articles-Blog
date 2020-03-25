<?php

namespace App;

interface RepositoryContract
{

    public function all();

    public function count();

    public function deleteById($id);

    public function first();

    public function get();

    public function getById($id);

    public function orderBy($column, $value);

    public function where($column, $value, $operator = '=', $with);

    public function getWith($with);

    public function paginateWith($no, $with);

    public function paginate($no);

    public function create($input);

    public function update($id, $input);

    public function getByIdWith($id, $with);

    public function getWithDatatable($with);

    public function getLatest($with);

    public function getBySearch($table, $column, $search, $with);
}
