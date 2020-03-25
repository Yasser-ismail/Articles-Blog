<?php

namespace App\Http\Controllers\FrontEnd;


use App\Http\Requests\BackEnd\Comments\Store;
use App\Http\Requests\BackEnd\Comments\Update;
use App\Repositories\CommentRepository;
use Illuminate\Support\Facades\Auth;

class CommentsController extends FrontEndController
{
    public function __construct(CommentRepository $repository)
    {
        parent::__construct($repository);
    }

    public function store()
    {
        app(Store::class);

        $input = request()->all();
        $input['user_id'] = Auth::user()->id;
        $comment = $this->model->create($input);

        $post = $comment->post;

        return view('frontend.posts.post-card', compact('post'));

    }

    public function destroy($id){
        $comment = $this->model->getById($id);
        $post = $comment->post;
        $this->model->deleteById($id);
        return view('frontend.posts.post-card', compact('post'));

    }

    public function edit($id){
        $row = $this->model->getById($id);
        return response()->json($row);
    }

    public function update($id){
       app(Update::class);
        $input = request()->all();
        $input['user_id'] = Auth::user()->id;
        $this->model->update($id, $input);
        $comment = $this->model->getById($id);
        $post = $comment->post;

        return view('frontend.posts.post-card', compact('post'));

    }

}
