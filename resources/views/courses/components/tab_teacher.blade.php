<div class="tab-pane fade" id="pillsTeacher" role="tabpanel" aria-labelledby="pillsTeacherTab">
    <div class="progress">
        <div class="" role="progressbar" style="width: 21%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar" role="progressbar" style="width: 11%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <h5 class="main-teacher">Main Teachers</h5>
    <div class="teacher">
        <div class="media">
            <img src="{{ asset('/storage/teachers/' . $course->teachers->image . '') }}" class="mr-3 rounded-circle teacher-image" alt="Image of teacher">
            <div class="media-body teacher-intro">
                <h5 class="mt-0 teacher-name">{{ $course->teachers->name }}</h5>
                <p class="teacher-time">Starting from {{ $course->teachers->created_at->format('d/m/Y') }}</p>
                <div class="teacher-contact">
                    <a class="teacher-link" href="{{ $course->teachers->google_link }}"><i class="fab fa-google-plus-g"></i></a>
                    <a class="teacher-link" href="{{ $course->teachers->facebook_link }}"><i class="fab fa-facebook-f"></i></a>
                    <a class="teacher-link" href="{{ $course->teachers->teacher_link }}"><i class="fab fa-slack"></i></a>
                </div>
                <p class="teacher-desc">{{ $course->teachers->intro }}</p>
            </div>
        </div>
    </div>
</div>
