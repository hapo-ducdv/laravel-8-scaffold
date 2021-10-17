<div class="tab-pane fade show active" id="pills-descriptions" role="tabpanel" aria-labelledby="pills-descriptions-tab">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 15%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
    <ul class="list-group list-group-flush lesson">
        <li class="list-group-item list-group-flush lesson-desc">
            <h5 class="lesson-desc-title">Descriptions lesson</h5>
            <p class="lesson-desc-text">{{ $lesson->desc }}</p>
        </li>
        <li class="list-group-item align-items-center lesson-desc">
            <h5 class="lesson-desc-title">Requirements</h5>
            <p class="lesson-desc-text">{{ $lesson->requirements }}</p>
        </li>
        <li class="list-group-item align-items-center tags">
            <span class="tag-title">Tags:</span>
            @foreach($course->tags as $tag)
                <div class="d-inline-flex lesson-tag">#{{ $tag->name }}</div>
            @endforeach
        </li>
    </ul>
</div>
