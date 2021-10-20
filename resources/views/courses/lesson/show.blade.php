@extends('layouts.app')

@section('title', 'Lesson detail')

@section('content')
    <nav class="breadcrumb-main" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('courses') }}">All courses</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('course_detail', $course->id) }}">Course detail</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="">Lesson detail</a></li>
        </ol>
    </nav>

    <div class="lesson-detail">
        <div class="row">
            <div class="col-8">
                <div class="d-flex align-items-center justify-content-center image-top">
                    <img class="rounded-circle" src='{{ asset("/storage/courses/$course->image") }}' alt="Course image">
                </div>
                <div class="row progress-lesson">
                    <div class="col-2 p-0 text-center progress-title">Progress:</div>
                    <div class="col-9 progress p-0">
                        <div class="progress-bar" role="progressbar" style="width: {{ $process }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="col-1 p-0 text-center progress-number">{{ $process }}%</div>
                </div>
                <div class="lesson-detail-left">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pills-descriptions-tab" data-toggle="pill" href="#pills-descriptions" role="tab" aria-controls="pills-descriptions" aria-selected="true">Descriptions</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-tearcher-tab" data-toggle="pill" href="#pills-tearcher" role="tab" aria-controls="pills-tearcher" aria-selected="false">Tearcher</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-program-tab" data-toggle="pill" href="#pills-program" role="tab" aria-controls="pills-program" aria-selected="false">Program</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content lesson-detail-desc" id="pills-tabContent">
                        @include('courses.lesson.components.tab_descriptions')

                        @include('courses.lesson.components.tab_teacher')

                        @include('courses.lesson.components.tab_program')

                        @include('courses.lesson.components.tab_review')
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="detail-course">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="row detail-course-content">
                                <div class="col-5 pr-0">
                                    <i class="fas fa-desktop detail-course-icon"></i>
                                    <span class="detail-course-title">Course</span>
                                </div>
                                <div class="col-1 p-0">
                                    <div class="detail-course-char">:</div>
                                </div>
                                <div class="col-6 pl-0">
                                    <div class="detail-course-number">{{ $course->name }}</div>
                                </div>
                            </div>
                        </li>
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
                        <li class="list-group-item d-flex justify-content-center">
                            <form action="{{ route('leave_course', $course->id) }}">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}"/>
                                <button type="submit" class="w-30 btn btn-leave-course">Leave this course</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="detail-other-course">
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
