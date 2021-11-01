<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(ReviewRequest $request)
    {
        if (Review::checkExistence($request['target_id'], $request['type']) == config('app.check_review')) {
            Review::create([
                'user_id' => Auth::id(),
                'target_id' => $request['target_id'],
                'type' => $request['type'],
                'content' => $request['content'],
                'rate' => $request['rate'],
            ]);

            return back()->with('success', 'Create a successful review')->withFragment('#pills-review');
        } else {
            return back()->with('error', 'You can only add 1 comment')->withFragment('#pills-review');
        }
    }
}
