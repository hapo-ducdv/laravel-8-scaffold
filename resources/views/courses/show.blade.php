@extends('layouts.app')

@section('title', 'Course detail')

@section('content')
    <nav class="breadcrumb-main" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('courses') }}">All courses</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="">Course detail</a></li>
        </ol>
    </nav>

    <div class="detail">
        <div class="row">
            <div class="col-8">
                <div class="d-flex align-items-center justify-content-center image-top">
                    <img class="rounded-circle" src='{{ asset("/assets/images/courses/$course->image") }}' alt="">
                </div>
                <div class="detail-course-right">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-lesson-tab" data-toggle="pill" href="#pills-lesson" role="tab" aria-controls="pills-lesson" aria-selected="true">Lessons</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-teacher-tab" data-toggle="pill" href="#pills-teacher" role="tab" aria-controls="pills-teacher" aria-selected="false">Tearcher</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-selected="false">Reviews</a>
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
                                    <div class="detail-course-number">{{ $course->number_user }}</div>
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
                                    <div class="detail-course-number">{{ $course->number_lesson }} lesson</div>
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
                                            #{{ $tag->name }}
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

                        @if($course->join > config('app.join'))
                            <li class="list-group-item d-flex justify-content-center">
                                <form action="{{ route('leave_course', $course->id) }}">
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
                        @foreach($courses as $key => $course)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-1 pr-0">
                                        <a class="detail-course-number" href="{{ route('course_detail', $course->id) }}">{{ $key + 1 }}.</a>
                                    </div>
                                    <div class="col-11 pl-0">
                                        <a class="detail-course-text" href="{{ route('course_detail', $course->id) }}">{{ $course->name }}</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach

                        <li class="list-group-item text-center">
                            <a href="{{ route('courses') }}" class="btn btn-view-all">View all ours courses</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
