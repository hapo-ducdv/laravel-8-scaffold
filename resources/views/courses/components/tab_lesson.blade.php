<div class="tab-pane fade show active" id="pills-lesson" role="tabpanel" aria-labelledby="pills-lesson-tab">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 10%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <ul class="list-group list-group-flush list-lesson">
        <li class="list-group-item list-group-flush">
            <div class="row">
                <form class="col-8 form-inline" action="{{ route('course_detail', $course->id) }}">
                    <input value="{{ request('keyword') }}" type="text" class="form-control input-search" name="keyword" placeholder="Search...">
                    <label for="keyword"><i class="fas fa-search"></i></label>
                    <button type="submit" class="btn btn-search">Search</button>
                </form>
                <div class="col-4 d-flex justify-content-end">
                    <form action="{{ route('join_course', $course->id) }}">
                        @if($course->join)
                            <div class="w-30 text-right btn btn-join-course">Joined</div>
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
                        <a href="{{ route('lesson_detail', ['id' => $course->id, 'lesson' => $lesson->id]) }}" class="number-lesson">
                            @if (empty(request('page')))
                                {{ $key + 1 }}.
                            @else
                                {{ $key + 1 + (request('page')-1)*config('app.paginate_courses_tab_lessons') }}
                            @endif
                        </a>
                    </div>
                    <div class="col-9 p-0">
                        <a href="{{ route('lesson_detail', ['id' => $course->id, 'lesson' => $lesson->id]) }}" class="name-lesson">{{ $lesson->name }}</a>
                    </div>
                    <div class="col-2">
                        @if($course->join)
                            @if($lesson->join)
                                <a href="{{ route('lesson_detail', ['id' => $course->id, 'lesson' => $lesson->id]) }}" class="float-right btn btn-learn">Learned</a>
                            @else
                                <a href="{{ route('lesson_detail', ['id' => $course->id, 'lesson' => $lesson->id]) }}" class="float-right btn btn-learn">Learn</a>
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
