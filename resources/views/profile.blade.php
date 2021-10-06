@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container-fluid profile">
        <div class="row">
            <div class="col-12 col-md-3">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center">
                        <form method="post" action="{{ route('update_profile') }}" enctype="multipart/form-data">
                            @csrf
                            <img src='{{ $user->avatar ? asset("/assets/images/users/$user->avatar") : asset("/assets/images/users/user_person.jpg") }}' id="profile-avatar" class="rounded-circle profile-avatar" alt="Avatar">
                            <i class="fas fa-camera text-center icon-upload-avatar" id="icon-upload-avatar"></i>
                            <input onchange="form.submit()" type="file" name="avatar" class="input-upload-avatar" id="input-upload-avatar">
                        </form>
                        <p class="profile-name">{{ $user->fullname ? $user->fullname : 'Name not updated' }}</p>
                        <p class="profile-email">{{ $user->email ? $user->email : 'Email not updated' }}</p>
                    </li>
                    <li class="list-group-item birthday">
                        <i class="fas fa-birthday-cake profile-icon-birthday"></i>
                        <span class="profile-birthday">{{ $user->birthday ? $user->birthday : 'Birthday not updated'}}</span>
                    </li>
                    <li class="list-group-item phone">
                        <i class="fas fa-phone-alt profile-icon-phone"></i>
                        <span class="profile-phone">{{ $user->phone ? $user->phone : 'Phone not updated' }}</span>
                    </li>
                    <li class="list-group-item address">
                        <i class="fas fa-home profile-icon-address"></i>
                        <span class="profile-address">{{ $user->address ? $user->address : 'Address not updated' }}</span>
                    </li>
                    <li class="list-group-item">
                        <p class="profile-desc">{{ $user->intro ? $user->intro : 'Introduction not updated' }}</p>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-md-9">
                <div class="my-course">
                    <h5 class="title">My courses</h5>
                    <hr class="horizontal-line">
                    <hr class="horizontal-line">
                    <div class="d-flex justify-content-center courses">
                        @foreach($user->courses as $course)
                            <a href="{{ route('course_detail', $course->id) }}" class="mt-0 text-center course">
                                <img class="rounded-circle course-image" src='{{ asset("/assets/images/courses/$course->image") }}' alt="">
                                <p class="course-name">{{ $course->name }}</p>
                            </a>
                        @endforeach
                        <a href="{{ route('courses') }}" class="mt-0 text-center add-course">
                            <i class="fas fa-plus add-course-icon"></i>
                            <p class="add-course-text">Add course</p>
                        </a>
                    </div>
                </div>
                <div class="edit-profile">
                    <h5 class="title">Edit profile</h5>
                    <hr class="horizontal-line">
                    <hr class="horizontal-line">
                    <form method="post" class="update-profile" action="{{ route('update_profile') }}">
                        @csrf
                        <div class="form-row update-profile-line">
                            <div class="form-group col-12 col-md-6 line-right">
                                <label class="update-profile-label">Name:</label>
                                <input value="{{ $user->fullname }}" name="update_fullname" type="text" class="form-control" placeholder="Your name...">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label class="update-profile-label">Email:</label>
                                <input value="{{ $user->email }}" name="update_email" type="email" class="form-control" placeholder="Your email..." required>
                            </div>
                        </div>
                        <div class="form-row update-profile-line">
                            <div class="form-group col-12 col-md-6 line-right">
                                <label class="update-profile-label">Date of birthday:</label>
                                <input value="{{ $user->birthday }}" name="update_birthday" type="date" class="form-control" placeholder="Your address...">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label class="update-profile-label">Phone:</label>
                                <input value="{{ $user->phone }}" name="update_phone" type="number" class="form-control" placeholder="Your address...">
                            </div>
                        </div>
                        <div class="form-row update-profile-line">
                            <div class="form-group col-12 col-md-6 line-right">
                                <label class="update-profile-label">Address:</label>
                                <input value="{{ $user->address }}" name="update_address" type="text" class="form-control" placeholder="Your address...">
                            </div>
                            <div class="form-group col-12 col-md-6">
                                <label class="update-profile-label">About me:</label>
                                <textarea name="update_intro" class="form-control" rows="4" placeholder="About you...">{{ $user->intro }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn float-right btn-update">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
