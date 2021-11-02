@extends('layouts.app')

@section('title', 'Lesson detail')

@section('content')
    <nav class="breadcrumb-main" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('courses.index') }}">All courses</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="{{ route('courses.show', $course) }}">Course detail</a></li>
            <li class="breadcrumb-item"><a class="breadcrumb-link" href="">Lesson detail</a></li>
        </ol>
    </nav>

    <div class="lesson-detail">
        <div class="row">
            <div class="col-8">
                <div class="d-flex align-items-center justify-content-center image-top">
                    <img class="rounded-circle" src='{{ asset("$course->image") }}' alt="Course image">
                </div>
                <div class="row progress-lesson">
                    <div class="col-2 p-0 text-center progress-title">Progress:</div>
                    <div class="col-9 progress p-0">
                        <div id="progressBar" class="progress-bar" role="progressbar" style="width: {{ $lesson->progress }}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div id="progressNumber" class="col-1 p-0 text-center progress-number">{{ $lesson->progress }}%</div>
                </div>
                <div class="lesson-detail-left">
                    <ul class="nav nav-pills" id="pillsTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="pillsDescriptionsTab" data-toggle="pill" href="#pillsDescriptions" role="tab" aria-controls="pillsDescriptions" aria-selected="true">Descriptions</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pillsTeacherTab" data-toggle="pill" href="#pillsTeacher" role="tab" aria-controls="pillsTeacher" aria-selected="false">Tearcher</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pillsProgramTab" data-toggle="pill" href="#pillsProgram" role="tab" aria-controls="pillsProgram" aria-selected="false">Program</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="pillsReviewTab" data-toggle="pill" href="#pillsReview" role="tab" aria-controls="pillsReview" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content lesson-detail-desc" id="pills-tabContent">
                        @include('lessons.components.tab_descriptions')

                        @include('lessons.components.tab_teacher')

                        @include('lessons.components.tab_program')

                        @include('lessons.components.tab_review')
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
                            <form method="post" action="{{ route('courses.users.destroy', [$course, Auth::user()]) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="w-30 btn btn-leave-course">Leave this course</button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="detail-other-course">
                    <h5 class="text-center title">Other Courses</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($randomCourses as $key => $course)
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-1 pr-0">
                                        <a class="detail-course-number" href="{{ route('courses.show', $course) }}">{{ $key + 1 }}.</a>
                                    </div>
                                    <div class="col-11 pl-0">
                                        <a class="detail-course-text" href="{{ route('courses.show', $course) }}">{{ $course->name }}</a>
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
