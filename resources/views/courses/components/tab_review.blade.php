<div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
    <div class="progress">
        <div class="" role="progressbar" style="width: 43%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar" role="progressbar" style="width: 11%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <ul class="list-group list-group-flush review">
        <li class="list-group-item">
            <h5 class="review-count-review">Reviews</h5>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-4">
                    <div class="d-flex flex-column align-items-center justify-content-center aggregate-rating">
                        <p class="aggregate-rating-average">{{ $course->total_rate }}</p>
                        <div class="aggregate-rating-icon">
                            @for ($i = config('app.i'); $i < $course->total_rate; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @for ($i = config('app.i'); $i < config('app.max_stars') - $course->total_rate; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </div>
                        <p class="aggregate-rating-count">{{ $course->number_review }} Rating</p>
                    </div>
                </div>
                <div class="col-8">
                    <div class="detail-rating">
                        @foreach($course->starRating as $key => $rating)
                            <div class="row detail-rating-align">
                                <span class="col-2 p-0 text-center detail-rating-star">{{ config('app.max_stars') - $key }} stars</span>
                                <div class="col-9 p-0 progress detail-rating-progress">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $course->number_review > config('app.process_min') ? $rating / $course->number_review * config('app.process_max') : config('app.process_min') }}%"></div>
                                </div>
                                <span class="col-1 p-0 text-center detail-rating-number">{{ $rating }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </li>

        @foreach($reviews as $review)
            <li class="list-group-item">
                <div class="media reviews-first">
                    <img src="{{ asset('/storage/users/' . $review->users->avatar . '') }}" class="rounded-circle review-image" alt="">
                    <div class="media-body review-body">
                        <div class="d-flex align-item-center">
                            <h5 class="review-first-name">{{ $review->users->fullname }}</h5>
                            <div class="review-first-icon">
                                @for ($i = config('app.i'); $i < $review->rate; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = config('app.i'); $i < config('app.max_stars') - $review->rate; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                            <div class="review-first-time">{{ $review->created_at->format('H:i:s d/m/Y') }}</div>
                        </div>
                        <p class="review-first-desc">{{ $review->content }}</p>
                    </div>
                </div>
            </li>
        @endforeach

        @if($reviews)
            {{ $reviews->links() }}
        @endif

        @auth
            @if($course->join)
                <li class="list-group-item leave-review-align">
                    <form method="POST" class="leave-review" action="{{ route('review_course') }}">
                        @csrf
                        <h5 class="leave-review-title">Leave a Review</h5>
                        <div class="form-group">
                            <label class="leave-review-message">Message</label>
                            <textarea class="form-control" name="content" rows="3" required></textarea>
                        </div>
                        <input hidden type="text" name="target_id" value="{{ $course->id }}">
                        <input hidden type="text" name="type" value="course">
                        <div class="form-group">
                            <label class="leave-review-vote">Vote</label>
                            <div class="rating">
                                <input id="fiveStars" class="rating-input" type="radio" name="rate" value="5" required/>
                                <label for="fiveStars" class="rating-icon"><i class="fas fa-star"></i></label>
                                <input id="fourStars" class="rating-input" type="radio" name="rate" value="4"/>
                                <label for="fourStars" class="rating-icon"><i class="fas fa-star"></i></label>
                                <input id="ThreeStars" class="rating-input" type="radio" name="rate" value="3"/>
                                <label for="ThreeStars" class="rating-icon"><i class="fas fa-star"></i></label>
                                <input id="twoStars" class="rating-input" type="radio" name="rate" value="2"/>
                                <label for="twoStars" class="rating-icon"><i class="fas fa-star"></i></label>
                                <input id="oneStars" class="rating-input" type="radio" name="rate" value="1"/>
                                <label for="oneStars" class="rating-icon"><i class="fas fa-star"></i></label>
                            </div>
                            <label class="leave-review-stars">(stars)</label>
                        </div>
                        <button type="submit" class="btn float-right btn-review-send">Send</button>
                    </form>
                </li>
            @endif
        @endauth
    </ul>
</div>
