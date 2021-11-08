@extends('layouts.app')

@section('title', 'Course detail')

@section('content')
    <nav class="breadcrumb-main" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('courses.index') }}">All courses</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('courses.show', $course) }}">Course detail</a></li>
        </ol>
    </nav>

    <div class="detail">
        <div class="row">
            <div class="col-8">
                <div class="d-flex align-items-center justify-content-center image-top">
                    <img class="rounded-circle" src='{{ asset("$course->image") }}' alt="">
                </div>

                @auth
                    @if($course->is_joined)
                        <div class="row progress-course">
                            <div class="col-2 p-0 text-center progress-title">Progress:</div>
                            <div class="col-9 progress p-0">
                                <div class="progress-bar" role="progressbar"
                                     style="width: {{ $course->progress }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="col-1 p-0 text-center progress-number">{{ $course->progress }}%</div>
                        </div>
                    @endif
                @endauth

                <div class="detail-course-right">
                    <ul class="nav nav-pills" id="pillsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pillsLessonTab" data-toggle="pill" href="#pillsLesson" role="tab" aria-controls="pillsLesson" aria-selected="true">Lessons</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pillsTeacherTab" data-toggle="pill" href="#pillsTeacher" role="tab" aria-controls="pillsTeacher" aria-selected="false">Teacher</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pillsReviewTab" data-toggle="pill" href="#pillsReview" role="tab" aria-controls="pillsReview" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content lessons" id="pills-tabContent">
                        @include('courses.components.tab_lesson')

                        @include('courses.components.tab_teacher')

                        @include('courses.components.tab_review')
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="desc-course">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" aria-current="true">
                            <h5 class="desc-title">Descriptions course</h5>
                        </li>
                        <li class="list-group-item desc-text">{{ $course->desc }}</li>
                    </ul>
                </div>
                <div class="course-info">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row detail-course-content">
                                <div class="col-5 pr-0">
                                    <i class="fas fa-users detail-course-icon"></i>
                                    <span class="detail-course-title">Learners</span>
                                </div>
                                <div class="col-1 p-0">
                                    <div class="detail-course-char">:</div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="detail-course-number">{{ $course->total_user }}</div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row detail-course-content">
                                <div class="col-5 pr-0">
                                    <i class="far fa-list-alt detail-course-icon"></i>
                                    <span class="detail-course-title">Lessons</span>
                                </div>
                                <div class="col-1 p-0">
                                    <div class="detail-course-char">:</div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="detail-course-number">{{ $course->total_lesson }} lesson</div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row detail-course-content">
                                <div class="col-5 pr-0">
                                    <i class="far fa-clock detail-course-icon"></i>
                                    <span class="detail-course-title">Times</span>
                                </div>
                                <div class="col-1 p-0">
                                    <div class="detail-course-char">:</div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="detail-course-number">{{ $course->total_time }} hours</div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row detail-course-content">
                                <div class="col-5 pr-0">
                                    <i class="fas fa-tags detail-course-icon"></i>
                                    <span class="detail-course-title">Tags</span>
                                </div>
                                <div class="col-1 p-0">
                                    <div class="detail-course-char">:</div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="detail-course-number detail-tags">
                                        @foreach($course->tags as $tag)
                                            <a href="/courses?tags[]={{ $tag->id }}">#{{ $tag->name }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row detail-course-content">
                                <div class="col-5 pr-0">
                                    <i class="far fa-money-bill-alt detail-course-icon"></i>
                                    <span class="detail-course-title">Price</span>
                                </div>
                                <div class="col-1 p-0">
                                    <div class="detail-course-char">:</div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="detail-course-number">{{ number_format($course->price, 0, ',', '.') }}đ</div>
                                </div>
                            </div>
                        </li>

                        @if($course->is_joined)
                            <li class="list-group-item d-flex justify-content-center">
                                <form method="post" action="{{ route('courses.users.destroy', [$course, Auth::user()]) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="w-30 btn btn-leave-course">Leave this course</button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="other-course">
                    <h5 class="text-center title">Other Courses</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($randomCourses as $key => $course)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-1 pr-0">
                                        <a class="detail-course-number" href="{{ route('courses.show', $course->id) }}">{{ $key + 1 }}.</a>
                                    </div>
                                    <div class="col-11 pl-0">
                                        <a class="detail-course-text" href="{{ route('courses.show', $course->id) }}">{{ $course->name }}</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        <li class="list-group-item text-center">
                            <a href="{{ route('courses.index') }}" class="btn btn-view-all">View all ours courses</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
