<?php

namespace App;

use Yajra\DataTables\DataTables;


class BaseRepository implements RepositoryContract
{
    protected $model;
    protected $with = [];

    public function get()
    {
        return $this->model->get();
    }

    public function getByIdWith($id, $with)
    {
        $this->with = $with;
        return $this->model->where('id', $id)->with($with)->first();
    }

    public function getWith($with)
    {
        $this->with = $with;
        return $this->model->with($with)->get();
    }

    public function paginateWith($no, $with)
    {
        $this->with = $with;
        return $this->model->with($with)->orderby('id', 'desc')->paginate($no);
    }

    public function all()
    {
        return $this->model->get();
    }

    public function count()
    {
        return $this->get()->count();
    }

    public function deleteById($id)
    {
        return $this->getById($id)->delete();
    }

    public function first()
    {
        return $this->model->first();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }


    public function orderBy($column, $value)
    {
        return $this->model->orderBy($column, $value)->get();
    }

    public function where($column, $value, $operator = '=', $with)
    {
        $this->with = $with;
        return $this->model->where($column, $operator, $value)->with($this->with)->first();
    }

    public function paginate($no)
    {

        return $this->model->paginate($no);
    }

    public function create($input)
    {

        return $this->model->create($input);
    }

    public function update($id, $input)
    {
        return $this->model->findOrFail($id)->update($input);
    }

    public function getWithDatatable($with)
    {
        return DataTables::of($this->model->query()->orderBy('id', 'desc')->with($with))
            ->addIndexColumn()
            ->editColumn('created_at', function ($row) {
                return $row->created_at->diffForHumans();
            })
            ->editColumn('updated_at', function ($row) {
                return $row->updated_at->diffForHumans();
            })
            ->editColumn('body', function ($row) {
                return str_limit($row->body, 30);
            })
            ->addColumn('action', function ($row) {

                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                return $btn;
            })
//            ->addColumn('viewPost', function ($row) {
//                $btn = '<a href="'. route('posts.show', $row->id).'" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="viewPost" class="btn btn-primary btn-sm viewPost">View Post</a>';
//
//                return $btn;
//            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getLatest($with)
    {
        return $this->model->latest()->with($with)->get();
    }
    public function getBySearch($table, $column, $search, $with){
        return $this->model->where('title','LIKE',$search."%")->with($with)->paginate(18);
    }

}
