<div class="footer cih">
    <div class="container-fluid">
        <div class="row footer-on">
            <div class="col-md-4 col-4 d-flex flex-column align-items-center justify-content-center footer-logo">
                <a href="{{ route('home') }}" class="footer-logo-img">
                    <img src="{{ asset('/assets/images/hapo_learn_white1.png') }}" alt="hapo learn">
                </a>
                <p class="footer-logo-text">Interactive lessons, "on-the-go" practice, peer support.</p>
            </div>
            <div class="col-md-4 col-12 d-flex footer-nav">
                <nav class="nav flex-column footer-nav-left">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                    <a class="nav-link" href="https://www.facebook.com/haposoft">Features</a>
                    <a class="nav-link" href="{{ route('courses.index') }}">Courses</a>
                    <a class="nav-link" href="https://blog.haposoft.com/">Blog</a>
                </nav>
                <nav class="nav flex-column footer-nav-right">
                    <a class="nav-link" href="https://www.facebook.com/haposoft">Contact</a>
                    <a class="nav-link" href="https://www.facebook.com/haposoft">Terms of Use</a>
                    <a class="nav-link" href="https://www.facebook.com/haposoft">FAQ</a>
                </nav>
            </div>
            <div class="col-md-4 col-4 d-flex align-items-center justify-content-center footer-contact">
                <div class="d-inline-flex footer-icon">
                    <a href="https://www.facebook.com/haposoft" data-toggle="tooltip" data-placement="bottom" title="fb/tuyen.dung.haposoft" class="footer-icon-fb a-link">
                        <img src="{{ asset('/assets/images/fb.png') }}" alt="icon-fb">
                        <div class="txt-hidden-fb">fb/tuyen.dung.haposoft</div>
                    </a>
                    <a href="https://www.facebook.com/haposoft.story" class="footer-icon-phone a-link">
                        <img src="{{ asset('/assets/images/call.png') }}" alt="icon-phone">
                        <div class="txt-hidden-phone">+84-85-645-9898</div>
                    </a>
                    <a href="https://www.facebook.com/haposoft.story" class="footer-icon-mail a-link">
                        <img src="{{ asset('/assets/images/mail.png') }}" alt="icon-mail">
                        <div class="txt-hidden-mail">info@haposoft.com</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center align-items-center copyright">
        <div class="copyright-text">
            <i class="far fa-copyright"></i> 2020 HapoLearn, Inc. All rights reserved.
        </div>
    </div>
</div>
