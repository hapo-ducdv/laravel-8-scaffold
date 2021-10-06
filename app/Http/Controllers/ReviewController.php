<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create($data)
    {
        return Review::create([
            'user_id' => Auth::id(),
            'target_id' => $data['target_id'],
            'type' => $data['type'],
            'content' => $data['content'],
            'rate' => $data['rate'],
        ]);
    }

    public function store(ReviewRequest $request)
    {
        if (isset(Auth::user()->id)) {
            if (Review::check($request['target_id'], $request['type']) == config('app.check_review')) {
                if ($this->create($request)) {
                    return back()->with('success', 'Create a successful review');
                } else {
                    return back()->with('error', 'Create review fail');
                }
            } else {
                return back()->with('error', 'You can only add 1 comment');
            }
        } else {
            return back()->with('error', 'You must be logged in to do this');
        }
    }
}
