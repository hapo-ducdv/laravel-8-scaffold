<div class="cih">
    <div class="d-flex align-items-center banner-first ">
        <div class="banner-first-content">
            <dic class="banner-first-content-heading d-block">Learn Anytime, Anywhere</dic>
            <div class="banner-first-content-bold d-block">at HapoLearn
                <img src="{{ asset('/assets/images/icon-hapo.png') }}" alt="Icon hapo">!
            </div>
            <div class="banner-first-content-desc-up d-block">Interface lessons, "on-the-go" practice,</div>
            <div class="banner-first-content-desc-bot d-block">peer support</div>
            <a class="btn d-flex align-items-center justify-content-center" href="{{ route('courses') }}">Start Learning Now !</a>
        </div>
    </div>
    <div class="linear-gradient cih">
        <div class="transition-block"></div>
    </div>
</div>

<div class="container courses cih">
    <div class="row">
        @foreach($courses as $course)
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-img-top d-flex align-items-center justify-content-center html-css-js">
                        <img class="rounded-circle" src='{{ asset("/storage/courses/$course->image") }}' alt="{{ $course->name }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text">{{ $course->desc }}</p>
                        <a href="{{ route('course_detail', $course->id) }}" class="btn">Take This Course</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <span class="other_courses">Other courses</span>
    </div>
    <div class="row">
        @foreach($otherCourses as $course)
            <div class="col-12 col-md-4">
                <div class="card">
                    <div class="card-img-top d-flex align-items-center justify-content-center rails">
                        <img class="rounded-circle" src='{{ asset("/storage/courses/$course->image") }}' alt="{{ $course->name }}">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $course->name }}</h5>
                        <p class="card-text">{{ $course->desc }}</p>
                        <a href="{{ route('course_detail', $course->id) }}" class="btn">Take This Course</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row justify-content-center">
        <a class="row view-all" href="{{ route('courses') }}">View All Our Courses
            <i class="fas fa-long-arrow-alt-right d-flex arrow-right"></i>
        </a>
    </div>
</div>

<div class="container-fluid align-items-center why-hapolearn cih">
    <div class="row align-items-center">
        <div class="why-hapolearn-text col-md-6 d-flex flex-column">
            <div class="why-hapolearn-title">Why HapoLearn?</div>
            <div class="text-content">
                <i class="fas fa-check-circle"></i><span>Interactive lessons, "on-the-go" practice, peer support.</span>
            </div>
            <div class="text-content">
                <i class="fas fa-check-circle"></i><span>Interactive lessons, "on-the-go" practice, peer support.</span>
            </div>
            <div class="text-content">
                <i class="fas fa-check-circle"></i><span>Interactive lessons, "on-the-go" practice, peer support.</span>
            </div>
            <div class="text-content">
                <i class="fas fa-check-circle"></i><span>Interactive lessons, "on-the-go" practice, peer support.</span>
            </div>
            <div class="text-content">
                <i class="fas fa-check-circle"></i><span>Interactive lessons, "on-the-go" practice, peer support.</span>
            </div>
        </div>
        <div class="multi-device-img col-md-6 d-flex align-items-center">
            <img src="{{ asset('/assets/images/multi-device-img.png') }}" alt="Multi device img">
        </div>
    </div>
    <div class="mb-img">
        <img src="{{ asset('/assets/images/mb.png') }}" alt="mb">
    </div>
</div>

<div class="container feedback cih">
    <div class="feedback-title text-center">
        <span class="feedback-title-text">Feedback</span>
    </div>
    <div class="feedback-intro">
        <p>What other students turned professionals have to say about us after learning with us and reaching their goals</p>
    </div>
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div id="feedback-slide" class="carousel-inner feedback-slide">
            @foreach($reviews as $review)
                <div class="carousel-item">
                    <div class="feedback-border">
                        <div class="feedback-border-text">“ {{$review->content}} ”</div>
                    </div>
                    <div class="feedback-abc-border">
                        <img src='{{ asset("/assets/images/polygon.png") }}' alt="">
                    </div>
                    <div class="feedback-info d-flex">
                        <img src="{{ asset('/storage/users/'. $review->users->avatar. '') }}" class="rounded-circle feedback-info-img" alt="Avatar">
                        <div class="card-body">
                            <div class="feedback-info-title">{{ $review->users->fullname }}</div>
                            <div class="feedback-info-subtitle">{{ $review->courses->name }}</div>
                            <div class="feedback-info-icon">
                                @for ($i = config('app.i'); $i < $review->courses->total_rate; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = config('app.i'); $i < config('app.max_stars') - $review->courses->total_rate; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<div class="cih">
    <div class="d-flex flex-column align-items-center justify-content-center banner-end">
        <div class="text-center banner-end-text">Become a member of our growing community!</div>
        <a class="btn" href="{{ route('courses') }}">Start Learning Now!</a>
    </div>
</div>

<div class="container statistic cih">
    <div class="row statistic-title justify-content-center">
        <span class="statistic-title-underline">Statistic</span>
    </div>
    <div class="row statistic-content">
        <div class="col-12 col-md-4 d-flex flex-column align-items-center">
            <div class="statistic-content-title">Courses</div>
            <div class="statistic-content-number">{{ number_format($numberCourse, 0, ',', '.') }}</div>
        </div>
        <div class="col-12 col-md-4 d-flex flex-column align-items-center">
            <div class="statistic-content-title">Lessons</div>
            <div class="statistic-content-number">{{ number_format($numberLesson, 0, ',', '.') }}</div>
        </div>
        <div class="col-12 col-md-4 d-flex flex-column align-items-center">
            <div class="statistic-content-title">Learns</div>
            <div class="statistic-content-number">{{ number_format($numberUser, 0, ',', '.') }}</div>
        </div>
    </div>
</div>
