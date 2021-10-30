@extends('layouts.app')

@section('title', 'List courses')

@section('content')
    <div class="all-courses">
        <div class="container">
            <div class="search d-flex">
                <form class="form-inline" method="GET" action="{{ route('courses.index') }}">
                    <a class="btn btn-filter" data-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseFilter">
                        <i class="fas fa-sliders-h"></i>
                        <span>Filter</span>
                    </a>
                    <input type="text" class="form-control input-search" name="keyword" placeholder="Search..." value="{{ request('keyword') }}">
                    <label for="keyword"><i class="fas fa-search"></i></label>
                    <button type="submit" class="btn btn-search">Search</button>
                    <div class="collapse" id="collapseFilter">
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
                                    <input hidden class="form-check-input" type="radio" name="status" value="oldest" id="oldest" {{ request('status') == config('app.oldest') ? 'checked' : ''}}>
                                    <label class="form-check-label" for="oldest">
                                        Oldest
                                    </label>
                                </div>
                                <select name="teacher[]" multiple="multiple" class="select-teachers">
                                    @foreach($teachers as $teacher)
                                        @if(is_array(request('teacher')))
                                            @foreach(request('teacher') as $choose)
                                                <option value="{{ $teacher->id }}" {{ $choose == $teacher->id ? 'selected' : ''}}>{{ $teacher->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="{{ $teacher->id }}" {{ request('teacher') == $teacher->id ? 'selected' : ''}}>{{ $teacher->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <select class="number-learners" name="number_learners">
                                    <option value="">Number learners</option>
                                    <option value="asc" {{ request('number_learners') == config('app.ascending') ? 'selected' : ''}}>Ascending</option>
                                    <option value="desc" {{ request('number_learners') == config('app.descending') ? 'selected' : ''}}>Descending</option>
                                </select>
                                <select class="study-time" name="study_time">
                                    <option value="">Study time</option>
                                    <option value="asc" {{ request('study_time') == config('app.ascending') ? 'selected' : ''}}>Ascending</option>
                                    <option value="desc" {{ request('study_time') == config('app.descending') ? 'selected' : ''}}>Descending</option>
                                </select>
                                <select class="number-lessons" name="number_lessons">
                                    <option value="">Number lessons</option>
                                    <option value="asc" {{ request('number_lessons') == config('app.ascending') ? 'selected' : ''}}>Ascending</option>
                                    <option value="desc" {{ request('number_lessons') == config('app.descending') ? 'selected' : ''}}>Descending</option>
                                </select>
                                <select name="tags[]" multiple="multiple" class="select-tags">
                                    @foreach($tags as $tag)
                                        @if(is_array(request('tags')))
                                            @foreach(request('tags') as $choose)
                                                <option value="{{ $tag->id }}" {{ $choose == $tag->id ? 'selected' : ''}}>{{ $tag->name }}</option>
                                            @endforeach
                                        @else
                                            <option value="{{ $tag->id }}" {{ request('tags') == $tag->id ? 'selected' : ''}}>#{{ $tag->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row courses">
                @foreach($courses as $course)
                    @include('courses.components.card_course')
                @endforeach
            </div>

            @if($courses)
                {{ $courses->appends(request()->all())->onEachSide(1)->links() }}
            @endif
        </div>
    </div>
@endsection
