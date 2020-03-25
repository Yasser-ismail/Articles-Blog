<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Requests\BackEnd\Posts\Store;
use App\Http\Requests\BackEnd\Posts\Updtae;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Yajra\DataTables\DataTables;

class PostsController extends BackEndController
{
    protected $CommentModel ;
    public function __construct(PostRepository $repository, CommentRepository $commentModel)
    {
        parent::__construct($repository);

        $this->CommentModel = $commentModel;
    }


    protected $with = ['user'];


    protected $storeRequestFile = Store::class;

    protected $updateRequestFile = Updtae::class;

    public function show($id)
    {
        $post = $this->model->getByIdWith($id, 'comments');

        $title = 'post'. $post->id;

        $nav_title = 'post';

        if (request()->ajax()){

            $data = $post->comments()->with('user')->get();

            return  DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->editColumn('updated_at', function ($row) {
                    return $row->updated_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm ">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="delete btn btn-danger btn-sm ">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $route_name = 'comments';


        return view('backend.posts.show', compact('post', 'title', 'nav_title', 'route_name'));

    }



}
