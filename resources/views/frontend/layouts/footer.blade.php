<footer class="footer-section pt-120" id="footer-section" data-background="{{asset('assets/frontend/img/bg-img/footer-bg.png')}}">
    <div class="footer-top-wrap">
        <div class="container">
            <div class="footer-top text-center" id="subscribe-form-section">
                <h2 class="title">Subscribe Our Newsletter For <br>Latest Updates</h2>
                <div class="footer-form-wrap">
                    @if(session('success_subscribe'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                            {{ session('success_subscribe') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if($errors->has('email'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                            {{ $errors->first('email') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('frontend.subscribe') }}" method="POST" class="footer-form" id="subscribe-form">
                        @csrf
                        <div class="form-item">
                            <input type="email" id="email-2" name="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Enter Your E-mail" value="{{ old('email') }}" required>
                            <div class="icon"><i class="fa-light fa-envelope"></i></div>
                        </div>
                        <button type="submit" class="ed-primary-btn">Subscribe Now</button>
                    </form>
                </div>
            </div>
            <div class="row footer-wrap">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3 class="widget-header">Get in touch!</h3>
                        <p class="mb-30">Fusce varius, dolor tempor interdum tristiquei bibendum.</p>
                        <div class="footer-contact">
                                <span class="number"><i class="fa-regular fa-phone"></i><a href="tel:0000000">
                                        000000000
                                    </a></span>
                            <a href="mailto:info@company.com" class="mail">info@company.com</a>
                        </div>
                        <ul class="footer-social">
                            <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget-2">
                        <h3 class="widget-header">Company Info</h3>
                        <ul class="footer-list">
                            <li><a href="about.html">About Us</a></li>
                            <li><a href="#">Resource Center</a></li>
                            <li><a href="team.html">Team</a></li>
                            <li><a href="teachers.html">Instructor</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget widget-2">
                        <h3 class="widget-header">Useful Links</h3>
                        <ul class="footer-list">
                            <li><a href="#">All Courses</a></li>
                            <li><a href="#">Digital Marketing</a></li>
                            <li><a href="#">Design & Branding</a></li>
                            <li><a href="#">Storytelling & Voice Over</a></li>
                            <li><a href="#">News & Blogs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h3 class="widget-header">Recent Post</h3>
                        <div class="sidebar-post mb-20">
                            <img src="{{asset('assets/frontend/img/images/footer-post-1.png')}}" alt="post">
                            <div class="post-content">
                                <h3 class="title"><a href="#">Where Dreams Find a Home</a></h3>
                                <ul class="post-meta">
                                    <li><i class="fa-light fa-calendar"></i>20 April, 2025</li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-post">
                            <img src="{{asset('assets/frontend/img/images/footer-post-2.png')}}" alt="post">
                            <div class="post-content">
                                <h3 class="title"><a href="#">Where Dreams Find a Home</a></h3>
                                <ul class="post-meta">
                                    <li><i class="fa-light fa-calendar"></i>20 April, 2025</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-content">
                <p>Copyright © 2026 <a href="#">Abdullah Elzayat</a>. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer>

@if(session('success_subscribe') || session('scroll_to_footer') || $errors->has('email'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Scroll to footer section smoothly
        const footerSection = document.getElementById('footer-section');
        if (footerSection) {
            setTimeout(function() {
                footerSection.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }, 100);
        }
    });
</script>
@endif
