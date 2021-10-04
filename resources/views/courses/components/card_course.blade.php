<div class="col-12 col-md-6">
    <div class="card card-all-courses">
        <div class="card-all-courses-body">
            <div class="d-flex w-100 card-all-courses-on">
                <div class="w-30 card-img">
                    <img class="rounded-circle" src="{{ $course->image }}" alt="">
                </div>
                <div class="w-70">
                    <h5 class="card-all-courses-title">{{ $course->name }}</h5>
                    <p class="card-all-courses-text">{{ $course ->desc }}</p>
                </div>
            </div>
            <div class="row d-flex justify-content-end more">
                <a href="#" class="btn">More</a>
            </div>
            <hr class="horizontal-line">
            <div class="row courses-info">
                <div class="col-4 col-md-4 d-flex flex-column align-items-center">
                    <div class="courses-info-title">Learners</div>
                    <div class="courses-info-number">{{ $course->number_user }}</div>
                </div>
                <div class="col-4 col-md-4 d-flex flex-column align-items-center">
                    <div class="courses-info-title">Lessons</div>
                    <div class="courses-info-number">{{ $course->number_lesson }}</div>
                </div>
                <div class="col-4 col-md-4 d-flex flex-column align-items-center">
                    <div class="courses-info-title">Times</div>
                    <div class="courses-info-number">{{ $course->total_time }} (h)</div>
                </div>
            </div>
        </div>
    </div>
</div>
