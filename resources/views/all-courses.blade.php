@extends('layouts.app')

@section('title', 'List courses')

@section('content')
    <div class="all-courses" id="all-courses">
        <div class="container">
            <div class="search d-flex">
                <form class="form-inline" method="GET" action="{{ route('all-courses') }}">
                    <a class="btn btn-filter" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-sliders-h"></i>
                        <span>Filter</span>
                    </a>
                    <input type="text" class="form-control input-search" name="key_search" placeholder="Search..." value="{{ request('key_search') }}">
                    <label for="pwd"><i class="fas fa-search"></i></label>
                    <button type="submit" class="btn btn-search">Search</button>
                    <div class="collapse" id="collapseExample">
                        <div class="d-flex collapse-filter">
                            <div class="collapse-title">
                                <div class="title">Filter by</div>
                            </div>
                            <div class="collapse-filter-select">
                                <div class="form-check-inline">
                                    <input hidden class="form-check-input" type="radio" name="status" value="newest" id="newest" checked>
                                    <label class="form-check-label" for="newest">
                                        Newest
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <input hidden class="form-check-input" type="radio" name="status" value="oldest" id="oldest" {{ request('status') == 'oldest' ? 'checked' : ''}}>
                                    <label class="form-check-label" for="oldest">
                                        Oldest
                                    </label>
                                </div>
                                <select class="teacher" id="teacher" name="teacher">
                                    <option value="">Teacher</option>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ request('teacher') == $teacher->id ? 'selected' : ''}}>{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                                <select class="number-learners" name="number_learners">
                                    <option value="">Number learners</option>
                                    <option value="asc" {{ request('number_learners') == 'asc' ? 'selected' : ''}}>Ascending</option>
                                    <option value="desc" {{ request('number_learners') == 'desc' ? 'selected' : ''}}>Descending</option>
                                </select>
                                <select class="study-time" name="study_time">
                                    <option value="">Study time</option>
                                    <option value="asc" {{ request('study_time') == 'asc' ? 'selected' : ''}}>Ascending</option>
                                    <option value="desc" {{ request('study_time') == 'desc' ? 'selected' : ''}}>Descending</option>
                                </select>
                                <select class="number-lessons" name="number_lessons">
                                    <option value="">Number lessons</option>
                                    <option value="asc" {{ request('number_lessons') == 'asc' ? 'selected' : ''}}>Ascending</option>
                                    <option value="desc" {{ request('number_lessons') == 'desc' ? 'selected' : ''}}>Descending</option>
                                </select>
                                <select id="tags" name="tags" class="tags">
                                    <option value="">Tags</option>
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ request('tags') == $tag->id ? 'selected' : ''}}>#{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row courses">
                @foreach($courses as $course)
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
                                        <div class="courses-info-number">{{ $course->users->count() }}</div>
                                    </div>
                                    <div class="col-4 col-md-4 d-flex flex-column align-items-center">
                                        <div class="courses-info-title">Lessons</div>
                                        <div class="courses-info-number">{{ $course->lessons->count() }}</div>
                                    </div>
                                    <div class="col-4 col-md-4 d-flex flex-column align-items-center">
                                        <div class="courses-info-title">Times</div>
                                        <div class="courses-info-number">{{ $course->time }} (h)</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($courses)
                {{ $courses -> links() }}
            @endif
        </div>
    </div>
@endsection
