<div class="tab-pane fade" id="pills-program" role="tabpanel" aria-labelledby="pills-program-tab">
    <div class="progress">
        <div class="" role="progressbar" style="width: 48%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
        <div class="progress-bar" role="progressbar" style="width: 11%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <ul class="list-group list-group-flush program">
        <li class="list-group-item">
            <h5 class="program-title">Program</h5>
        </li>
        @foreach($lesson->programs as $program)
            <li class="list-group-item">
                <div class="row">
                    <div class="col-2">
                        @if($program->type == config('app.type_lesson'))
                            <i class="far fa-file-word program-icon"></i>
                            <span class="program-name-file">Lesson</span>
                        @elseif($program->type == config('app.type_pdf'))
                            <i class="far fa-file-pdf program-icon"></i>
                            <span class="program-name-file">PDF</span>
                        @else
                            <i class="far fa-file-video program-icon"></i>
                            <span class="program-name-file">Video</span>
                        @endif
                    </div>
                    <div class="col-8">
                        <p class="program-name">{{ $program->name }}</p>
                    </div>
                    <div class="col-2">
                        @if($program->join)
                            <a href="{{ route('program', ['lesson' => $lesson->id, 'program' => $program->id]) }}" id="btn-preview" class="btn btn-preview" target="_blank">Previewed</a>
                        @else
                            <a href="{{ route('program', ['lesson' => $lesson->id, 'program' => $program->id]) }}" id="btn-preview" class="btn btn-preview" target="_blank">Preview</a>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
