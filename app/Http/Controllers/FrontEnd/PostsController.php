<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Requests\BackEnd\Posts\Store;
use App\Notifications\NewPostNotification;
use App\Repositories\PostRepository;
use App\Repositories\RateRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class PostsController extends FrontEndController
{
    protected $rateModel;
    protected $userModel;

    public function __construct(PostRepository $repository, RateRepository $rateModel, UserRepository $userModel)
    {
        parent::__construct($repository);

        $this->rateModel = $rateModel;
        $this->userModel = $userModel;
    }

    public function home()
    {
        $posts = $this->model->paginateWith(18, 'user');

        if (\request()->ajax()) {

            if (\request()->has('search')) {
                $posts = $this->model->getBySearch('posts', 'title', \request('search'), 'user');
                return view('frontend.posts.homeIndex', compact('posts'));

            }
            return view('frontend.posts.homeIndex', compact('posts'));
        }

        return view('frontend.home', compact('posts'));
    }

    public function store()
    {
       // $this->authorize('admin');
        app(Store::class);
        $input = request()->all();
        $input['user_id'] = Auth::user()->id;
        $post = $this->model->create($input);

        //notify admins
        $users = $this->userModel->get()->where('role_id', '=', 1);
        Notification::send($users, new NewPostNotification($post));

        $posts = $this->model->paginateWith(18, 'user');

        return view('frontend.posts.homeIndex', compact('posts'));
    }

    public function show($id)
    {
        $post = $this->model->getByIdWith($id, ['user', 'comments']);
        $rate = Auth::user()->rates()->where('post_id', '=', $id)->first();
        if ($rate) {
            $value = $rate->value;

            if (\request()->ajax()) {
                return view('frontend.posts.post-card', compact('post', 'value'));
            }
            return view('frontend.posts.show', compact('post', 'value'));
        }
        return view('frontend.posts.show', compact('post'));
    }


    public function edit($id)
    {
        return response()->json($this->model->getById($id));
    }

    public function update($id)
    {
        app(Store::class);

        $input = \request()->all();
        $input['user_id'] = Auth::user()->id;
        $this->model->update($id, $input);

        $post = $this->model->getByIdWith($id, ['user', 'comments']);
        return view('frontend.posts.post-card', compact('post'));


    }

    public function destroy($id)
    {

        $this->model->deleteById($id);
        return redirect()->route('home');

    }

    public function storeRate()
    {
        app(\App\Http\Requests\FrontEnd\Rates\Store::class);

        $rate = request()->all();
        $rate['user_id'] = Auth::user()->id;
        $rate = $this->rateModel->create($rate);
        $post = $this->model->getByIdWith(request('post_id'), ['rates']);
        if ($rate) {
            $value = $rate->value;
        }

        $rates = $post->rates;

        if ($rates) {
            $sum = 0;
            $count_rating = count($rates);

            foreach ($rates as $rate) {
                $sum += $rate->value;
            }
        }

        $average_rating = round(($sum / $count_rating));

        $post['average_rating'] = $average_rating;
        $post['count_rating'] = $count_rating;
        $input = $post->toarray();

        $this->model->update($post->id, $input);

        return view('frontend.posts.post-card', compact('post', 'value'));
    }

    public function editRate($id)
    {
        app(\App\Http\Requests\FrontEnd\Rates\Store::class);

        $rate = Auth::user()->rates()->where('post_id', $id)->first();
        $input = request()->all();
        $input['user_id'] = Auth::user()->id;
        $this->rateModel->update($rate->id, $input);
        $post = $this->model->getByIdWith($id, 'rates');
        $value = request('value');
        $rates = $post->rates;
        if ($rates) {
            $sum = 0;
            $count_rating = count($rates);

            foreach ($rates as $rate) {
                $sum += $rate->value;
            }

        }

        $average_rating = round(($sum / $count_rating));

        $post['average_rating'] = $average_rating;
        $post['count_rating'] = $count_rating;
        $input = $post->toarray();

        $this->model->update($post->id, $input);

        return view('frontend.posts.post-card', compact('post', 'value'));
    }

}
