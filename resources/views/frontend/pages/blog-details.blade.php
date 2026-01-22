@extends('frontend.layouts.master')
@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}"
                        alt="shape"></div>
                <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-2.png') }}"
                        alt="shape"></div>
                <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-3.png') }}"
                        alt="shape"></div>
            </div>
        </div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="title">{{ $blog->title }}</h1>
                <h4 class="sub-title"><a class="home" href="{{ route('frontend.home') }}">Home </a><span
                        class="icon">/</span><a class="inner-page" href="{{ route('frontend.blog') }}"> Blog</a><span
                        class="icon">/</span><span class="current">{{ Str::limit($blog->title, 30) }}</span></h4>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="blog-details pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-top-wrap">
                        <div class="blog-details-top">
                            @php
                                $blogCover = $blog->cover_image
                                    ? public_path('uploads/blogs/' . $blog->cover_image)
                                    : null;
                                $hasCover = $blog->cover_image && $blogCover && file_exists($blogCover);
                            @endphp

                            @if ($hasCover)
                                <div class="blog-details-thumb">
                                    <img src="{{ asset('uploads/blogs/' . $blog->cover_image) }}" alt="{{ $blog->title }}"
                                        style="width: 100%; height: auto; border-radius: 10px;">
                                </div>
                            @else
                                <div class="blog-details-thumb">
                                    <img src="{{ asset('assets/frontend/img/blog/inner-post-1.png') }}" alt="{{ $blog->title }}"
                                        style="width: 100%; height: auto; border-radius: 10px;">
                                </div>
                            @endif
                            <ul class="post-meta" style="margin-top: 60px !important;">
                                @if ($blog->published_at)
                                    <li><i class="fa-sharp fa-regular fa-clock"></i>{{ $blog->published_at->format('F d, Y') }}
                                    </li>
                                @endif
                                @if ($blog->category)
                                    <li><i class="fa-sharp fa-regular fa-folder"></i>{{ $blog->category->name }}</li>
                                @endif
                                @if ($blog->author)
                                    <li><i class="fa-sharp fa-regular fa-user"></i>{{ $blog->author }}</li>
                                @endif
                            </ul>
                        </div>
                        <div class="blog-details-content" style="margin-top: 20px !important;">
                            @if ($blog->description)
                                <div class="blog-content">
                                    {!! $blog->description !!}
                                </div>
                            @else
                                <p class="mb-30">No content available for this blog post.</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Author Info Widget -->
                    <div class="sidebar-widget author-widget mb-4">
                        <div class="author-card">
                            <div class="author-image">
                                @php
                                    $authorImage = \App\Models\Setting::get('author_image');
                                    $authorName = \App\Models\Setting::get('author_name', 'Sister Nourhan');
                                    $authorTitle = \App\Models\Setting::get('author_title', 'EDUCATION EXPERT & CONTENT CREATOR');
                                    $authorBio = \App\Models\Setting::get('author_bio', 'Passionate educator with years of experience in teaching and content creation. Dedicated to providing quality education and inspiring students to achieve their goals.');
                                @endphp

                                @if($authorImage)
                                    <img src="{{ asset('storage/settings/' . $authorImage) }}" alt="{{ $authorName }}">
                                @else
                                    <div class="author-placeholder">
                                        <span>{{ substr($authorName, 0, 2) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="author-info">
                                <h4 class="author-name">{{ $authorName }}</h4>
                                <p class="author-title">{{ $authorTitle }}</p>
                                <p class="author-bio">{{ $authorBio }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Recent Posts</h3>
                        @if ($recentBlogs->count() > 0)
                            @foreach ($recentBlogs as $recentBlog)
                                <div class="sidebar-post {{ !$loop->last ? 'mb-3' : '' }}">
                                    @if ($recentBlog->cover_image)
                                        <img src="{{ asset('uploads/blogs/' . $recentBlog->cover_image) }}"
                                            alt="{{ $recentBlog->title }}" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/frontend/img/blog/sidebar-thumb-1.png') }}"
                                            alt="{{ $recentBlog->title }}" style="width: 80px; height: 80px; object-fit: cover;">
                                    @endif
                                    <div class="post-content">
                                        <h3 class="title">
                                            <a
                                                href="{{ route('frontend.blog.details', ['slug' => $recentBlog->slug]) }}">{{ Str::limit($recentBlog->title, 50) }}</a>
                                        </h3>
                                        <ul class="post-meta">
                                            @if ($recentBlog->author)
                                                <li><i class="fa-light fa-user"></i>{{ $recentBlog->author }}</li>
                                            @endif
                                            @if ($recentBlog->published_at)
                                                <li><i
                                                        class="fa-sharp fa-regular fa-folder-open"></i>{{ $recentBlog->published_at->format('M d, Y') }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-muted">No recent posts available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./ blog-details -->
@endsection

@push('css')
<style>
    /* Author Widget Styles */
    .author-widget {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .author-card {
        padding: 30px;
        text-align: center;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }

    .author-image {
        margin-bottom: 20px;
    }

    .author-image img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #DF8A39;
        box-shadow: 0 5px 15px rgba(223, 138, 57, 0.3);
    }

    .author-placeholder {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: linear-gradient(135deg, #DF8A39, #e67e22);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(223, 138, 57, 0.3);
    }

    .author-placeholder span {
        font-size: 36px;
        font-weight: bold;
        color: #fff;
        text-transform: uppercase;
    }

    .author-name {
        font-size: 24px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .author-title {
        font-size: 14px;
        font-weight: 600;
        color: #DF8A39;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }

    .author-bio {
        font-size: 14px;
        line-height: 1.6;
        color: #666;
        margin-bottom: 0;
    }

    /* Blog Details Spacing Improvements */
    .blog-details-top {
        margin-bottom: 30px;
    }

    .blog-details-top .blog-details-thumb {
        margin-bottom: 25px;
    }

    .blog-details-content {
        margin-top: 40px !important;
        padding-top: 30px;
        border-top: 1px solid #f0f0f0;
    }

    .blog-details-content .details-title {
        margin-bottom: 25px;
        padding-bottom: 15px;
    }

    .blog-details-content .lead {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f5f5f5;
    }

    .blog-content {
        line-height: 1.8;
    }

    .blog-content p {
        margin-bottom: 20px;
    }

    .blog-content h1, .blog-content h2, .blog-content h3,
    .blog-content h4, .blog-content h5, .blog-content h6 {
        margin-top: 30px;
        margin-bottom: 20px;
    }

    .blog-content img {
        margin: 25px 0;
        border-radius: 8px;
    }

    .blog-content blockquote {
        margin: 30px 0;
        padding: 20px 30px;
        background: #f8f9fa;
        border-left: 4px solid #DF8A39;
        border-radius: 8px;
    }

    .post-meta {
        margin: 25px 0 !important;
        padding: 15px 0;
    }

    .post-meta li {
        margin-right: 25px;
        color: #666;
        font-size: 14px;
    }

    .post-meta li i {
        margin-right: 8px;
        color: #DF8A39;
    }

    /* Responsive spacing */
    @media (max-width: 768px) {
        .blog-details-content {
            margin-top: 25px !important;
            padding-top: 20px;
        }

        .blog-details-top .blog-details-thumb {
            margin-bottom: 20px;
        }

        .post-meta {
            margin: 20px 0 !important;
        }
    }
</style>
@endpush
