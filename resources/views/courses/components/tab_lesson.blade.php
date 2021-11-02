<div class="tab-pane fade show active" id="pillsLesson" role="tabpanel" aria-labelledby="pillsLessonTab">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <ul class="list-group list-group-flush list-lesson">
        <li class="list-group-item list-group-flush">
            <div class="row">
                <form class="col-8 form-inline" action="{{ route('courses.show', $course) }}">
                    <input value="{{ request('keyword') }}" type="text" class="form-control input-search" name="keyword" placeholder="Search...">
                    <label for="keyword"><i class="fas fa-search"></i></label>
                    <button type="submit" class="btn btn-search">Search</button>
                </form>
                <div class="col-4 d-flex justify-content-end">
                    <form method="post" action="{{ route('course-users.store') }}">
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        @if($course->joined)
                            <button type="submit" class="w-30 btn btn-join-course">Joined</button>
                        @else
                            <button type="submit" class="w-30 btn btn-join-course">Join in the course</button>
                        @endif
                    </form>
                </div>
            </div>
        </li>

        @foreach($lessons as $key => $lesson)
            <li class="list-group-item align-items-center">
                <div class="row">
                    <div class="col-1">
                        <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="number-lesson">
                            @if (empty(request('page')))
                                {{ $key + 1 }}.
                            @else
                                {{ $key + 1 + (request('page')-1)*config('app.paginate_courses_tab_lessons') }}
                            @endif
                        </a>
                    </div>
                    <div class="col-9 p-0">
                        <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="name-lesson">{{ $lesson->name }}</a>
                    </div>
                    <div class="col-2">
                        @if($course->joined)
                            @if($lesson->joined)
                                <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="float-right btn btn-learn">{{ ($lesson->progress == config('app.process_max')) ? 'Learned': 'Learning...'}}</a>
                            @else
                                <a href="{{ route('courses.lessons.show', [$course, $lesson]) }}" class="float-right btn btn-learn">Learn</a>
                            @endif
                        @endif
                    </div>
                </div>
            </li>
        @endforeach

        @if($lessons)
            {{ $lessons->appends(request()->all())->onEachSide(1)->links() }}
        @endif
    </ul>
</div>
