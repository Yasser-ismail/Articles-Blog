<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackEnd\Users\Update;
use App\RepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackEndController extends Controller
{
    protected $model;

    protected $with;

    protected $storeRequestFile;

    protected $updateRequestFile;

    protected function append()
    {
        return [];
    }


    public function getModelName()
    {
        return str_replace('Repository', '', class_basename($this->model));
    }

    public function getModelPluralName()
    {
        return str_plural($this->getModelName());
    }

    public function getViewsDirectory()
    {
        return str_plural(strtolower($this->getModelName()));
    }

    public function getRoute_name()
    {
        return str_plural(strtolower($this->getModelName()));
    }

    public function __construct(RepositoryContract $repository)
    {
        $this->model = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->getModelPluralName();
        $nav_title = $this->getModelPluralName();
        $table_title = 'Control ' . $this->getModelPluralName();
        $table_des = 'Here you can add / edit / delete ' . $this->getModelPluralName();
        $model_name = $this->getModelName();
        $route_name = $this->getRoute_name();
        $append = $this->append();



        if (\request()->ajax()) {

            return $this->model->getWithDatatable($this->with);

        }


        return view('backend.' . $route_name . '.index', compact('title', 'nav_title', 'table_title',
            'table_des', 'model_name', 'route_name'))->with($append);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        app($this->storeRequestFile);

        $input = request()->except('image', 'password');

        if (\request()->has('password')) {
            $input['password'] = bcrypt(\request('password'));
        }

        if (\request()->has('image') && !empty(\request('image'))) {
            $file = \request()->file('image');
            $name = '/images/' . time() . $file->getClientOriginalName();

            $file->move('images', $name);
            $input['image'] = $name;
        }

        if (\request()->has(['title', 'body']) || \request()->has(['comment', 'post_id'])) {
            $input['user_id'] = Auth::user()->id;
        }


        $this->model->create($input);

        return response()->json(['success' => $this->getModelName() . ' saved successfully.']);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = $this->model->getById($id);
        return response()->json($row);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        app($this->updateRequestFile);
        $row = $this->model->getById($id);

        $input = \request()->except('password', 'image');

        if (\request()->has('password') && !empty(\request('password'))) {

            $input['password'] = bcrypt(\request('password'));
        }

        if (\request()->has('image') && !empty(\request('image'))) {

            if (!empty($row->image)) {
                unlink(public_path() . $row->image);
            }

            $file = \request()->file('image');
            $name = '/images/' . time() . $file->getClientOriginalName();

            $file->move('images', $name);
            $input['image'] = $name;
        }

        if (\request()->has(['title', 'body']) || \request()->has(['comment', 'post_id'])) {
            $input['user_id'] = Auth::user()->id;
        }


        $this->model->update($id, $input);

        return response()->json(['success' => $this->getModelName() . ' updated successfully.']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->deleteById($id);

        return response()->json(['success' => $this->getModelName() . ' Deleted successfully.']);

    }

}
