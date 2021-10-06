<div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
    <div class="progress">
        <div class="" role="progressbar" style="width: 70%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar" role="progressbar" style="width: 10%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <ul class="list-group list-group-flush review">
        <li class="list-group-item">
            <h5 class="review-count-review">Reviews</h5>
        </li>
        <li class="list-group-item">
            <div class="row">
                <div class="col-4">
                    <div class="d-flex flex-column align-items-center justify-content-center aggregate-rating">
                        <p class="aggregate-rating-average">{{ $lesson->total_rate }}</p>
                        <div class="aggregate-rating-icon">
                            @for ($i = config('app.i'); $i < $lesson->total_rate; $i++)
                                <i class="fas fa-star"></i>
                            @endfor
                            @for ($i = config('app.i'); $i < config('app.max_stars') - $lesson->total_rate; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </div>
                        <p class="aggregate-rating-count">{{ $lesson->number_review }} Rating</p>
                    </div>
                </div>
                <div class="col-8">
                    <div class="detail-rating">
                        <div class="row detail-rating-align">
                            <span class="col-2 p-0 text-center detail-rating-star">5 stars</span>
                            <div class="col-9 p-0 progress detail-rating-progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $lesson->number_review > 0 ? $lesson->five_star_rating / $lesson->number_review * 100 : 0 }}%"></div>
                            </div>
                            <span class="col-1 p-0 text-center detail-rating-number">{{ $lesson->five_star_rating }}</span>
                        </div>
                        <div class="row detail-rating-align">
                            <span class="col-2 p-0 text-center detail-rating-star">4 stars</span>
                            <div class="col-9 p-0 progress detail-rating-progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $lesson->number_review > 0 ? $lesson->four_star_rating / $lesson->number_review * 100 : 0 }}%"></div>
                            </div>
                            <span class="col-1 p-0 text-center detail-rating-number">{{ $lesson->four_star_rating }}</span>
                        </div>
                        <div class="row detail-rating-align">
                            <span class="col-2 p-0 text-center detail-rating-star">3 stars</span>
                            <div class="col-9 p-0 progress detail-rating-progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $lesson->number_review > 0 ? $lesson->three_star_rating / $lesson->number_review * 100 : 0 }}%"></div>
                            </div>
                            <span class="col-1 p-0 text-center detail-rating-number">{{ $lesson->three_star_rating }}</span>
                        </div>
                        <div class="row detail-rating-align">
                            <span class="col-2 p-0 text-center detail-rating-star">2 stars</span>
                            <div class="col-9 p-0 progress detail-rating-progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $lesson->number_review > 0 ? $lesson->two_star_rating / $lesson->number_review * 100 : 0 }}%"></div>
                            </div>
                            <span class="col-1 p-0 text-center detail-rating-number">{{ $lesson->two_star_rating }}</span>
                        </div>
                        <div class="row">
                            <span class="col-2 p-0 text-center detail-rating-star">1 stars</span>
                            <div class="col-9 p-0 progress detail-rating-progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: {{ $lesson->number_review > 0 ? $lesson->one_star_rating / $lesson->number_review * 100 : 0 }}%"></div>
                            </div>
                            <span class="col-1 p-0 text-center detail-rating-number">{{ $lesson->one_star_rating }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        @foreach($reviews as $review)
            <li class="list-group-item">
                <div class="media reviews-first">
                    <img src="{{ asset('/assets/images/users/' . $review->users->avatar . '') }}" class="rounded-circle review-image" alt="">
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

        <li class="list-group-item leave-review-align">
            <form method="POST" class="leave-review" action="{{ route('review_course') }}">
                @csrf
                <h5 class="leave-review-title">Leave a Review</h5>
                <div class="form-group">
                    <label class="leave-review-message">Message</label>
                    <textarea class="form-control" name="content" rows="3" required></textarea>
                </div>
                <input hidden type="text" name="target_id" value="{{ $lesson->id }}">
                <input hidden type="text" name="type" value="lesson">
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
    </ul>
</div>
