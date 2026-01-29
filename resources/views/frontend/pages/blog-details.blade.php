@extends('frontend.layouts.master')
@section('content')
    <section class="page-header">
        <div class="bg-item">
            <div class="bg-img" data-background="{{ asset('assets/frontend/img/banner_top.jpeg') }}"></div>
            <div class="overlay"></div>
            <div class="shapes">
                {{-- <div class="shape shape-1"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-1.png') }}"
                        alt="shape"></div> --}}
                {{-- <div class="shape shape-2"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-2.png') }}"
                        alt="shape"></div> --}}
                {{-- <div class="shape shape-3"><img src="{{ asset('assets/frontend/img/shapes/page-header-shape-3.png') }}"
                        alt="shape"></div> --}}
            </div>
        </div>
        <div class="container">
            <div class="page-header-content">
                <h1 class="title">{{ $blog->title }}</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.blog') }}"> Blog</a><span class="icon">/</span>
                <span class="current">{{ Str::limit($blog->title, 30) }}</span>
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
                                    <img src="{{ asset('uploads/settings/' . $authorImage) }}" alt="{{ $authorName }}">
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
                    <div class="sidebar-widget recent-posts-widget">
                        <h3 class="widget-title">
                            <i class="fa-light fa-clock-rotate-left me-2"></i>
                            Recent Posts
                        </h3>
                        @if ($recentBlogs->count() > 0)
                            <div class="recent-posts-list">
                                @foreach ($recentBlogs as $recentBlog)
                                    <a href="{{ route('frontend.blog.details', ['slug' => $recentBlog->slug]) }}"
                                       class="recent-post-card">
                                        <div class="recent-post-image-wrapper">
                                            @if ($recentBlog->cover_image)
                                                <img src="{{ asset('uploads/blogs/' . $recentBlog->cover_image) }}"
                                                    alt="{{ $recentBlog->title }}" class="recent-post-image">
                                            @else
                                                <img src="{{ asset('assets/frontend/img/blog/sidebar-thumb-1.png') }}"
                                                    alt="{{ $recentBlog->title }}" class="recent-post-image">
                                            @endif
                                            <div class="recent-post-overlay">
                                                <i class="fa-light fa-arrow-right"></i>
                                            </div>
                                        </div>
                                        <div class="recent-post-content">
                                            <h4 class="recent-post-title">
                                                {{ Str::limit($recentBlog->title, 60) }}
                                            </h4>
                                            <div class="recent-post-meta">
                                                @if ($recentBlog->author)
                                                    <span class="recent-post-author">
                                                        <i class="fa-light fa-user"></i>
                                                        {{ $recentBlog->author }}
                                                    </span>
                                                @endif
                                                @if ($recentBlog->published_at)
                                                    <span class="recent-post-date">
                                                        <i class="fa-light fa-calendar"></i>
                                                        {{ $recentBlog->published_at->format('M d, Y') }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="no-posts-message">
                                <i class="fa-light fa-inbox"></i>
                                <p>No recent posts available.</p>
                            </div>
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

    /* Reset li styles to match dashboard editor - remove any overrides */
    .blog-content ul,
    .blog-content ol {
        list-style-position: outside;
        padding-left: 2em;
        margin: 1em 0;
    }

    .blog-content ul {
        list-style-type: disc;
    }

    .blog-content ol {
        list-style-type: decimal;
    }

    .blog-content li {
        display: list-item;
        margin-bottom: 0.5em;
        margin-top: 0;
        padding-left: 0;
        font-size: inherit;
        font-weight: inherit;
        color: inherit;
        line-height: inherit;
        text-transform: none;
        white-space: normal;
    }

    .blog-content li::before {
        display: none !important;
        content: none !important;
    }

    .blog-content ul li::marker {
        color: inherit;
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

    /* Recent Posts Widget - New Beautiful Design */
    .recent-posts-widget {
        background: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin-bottom: 30px;
    }

    .recent-posts-widget .widget-title {
        font-size: 22px;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #DF8A39;
        display: flex;
        align-items: center;
    }

    .recent-posts-widget .widget-title i {
        color: #DF8A39;
        font-size: 20px;
    }

    .recent-posts-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .recent-post-card {
        display: flex;
        gap: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        position: relative;
        overflow: hidden;
    }

    .recent-post-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 4px;
        height: 100%;
        background: linear-gradient(180deg, #DF8A39 0%, #e67e22 100%);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }

    .recent-post-card:hover {
        background: #fff;
        border-color: #DF8A39;
        box-shadow: 0 8px 25px rgba(223, 138, 57, 0.15);
        transform: translateY(-3px);
    }

    .recent-post-card:hover::before {
        transform: scaleY(1);
    }

    .recent-post-image-wrapper {
        position: relative;
        flex-shrink: 0;
        width: 100px;
        height: 100px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .recent-post-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .recent-post-card:hover .recent-post-image {
        transform: scale(1.1);
    }

    .recent-post-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(223, 138, 57, 0.9);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .recent-post-overlay i {
        color: #fff;
        font-size: 24px;
        transform: translateX(-10px);
        transition: transform 0.3s ease;
    }

    .recent-post-card:hover .recent-post-overlay {
        opacity: 1;
    }

    .recent-post-card:hover .recent-post-overlay i {
        transform: translateX(0);
    }

    .recent-post-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .recent-post-title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
        margin: 0 0 10px 0;
        line-height: 1.4;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .recent-post-card:hover .recent-post-title {
        color: #DF8A39;
    }

    .recent-post-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
    }

    .recent-post-author,
    .recent-post-date {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        color: #666;
        font-weight: 500;
    }

    .recent-post-author i,
    .recent-post-date i {
        color: #DF8A39;
        font-size: 12px;
    }

    .no-posts-message {
        text-align: center;
        padding: 40px 20px;
        color: #999;
    }

    .no-posts-message i {
        font-size: 48px;
        color: #ddd;
        margin-bottom: 15px;
        display: block;
    }

    .no-posts-message p {
        margin: 0;
        font-size: 14px;
    }

    /* Responsive spacing */
    @media (max-width: 768px) {
        /* Reduce large padding on mobile */
        .blog-details {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }

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

        .recent-post-image-wrapper {
            width: 90px;
            height: 90px;
        }

        .recent-post-title {
            font-size: 15px;
        }

        .recent-posts-widget {
            padding: 20px;
        }

        /* Reduce spacing in blog content on mobile */
        .blog-content {
            margin-bottom: 0;
        }

        .blog-content p {
            margin-bottom: 15px;
        }
    }

    @media only screen and (max-width: 767px) {
        .blog-details-top .blog-details-thumb {
            height: 120px !important;
        }
    }
</style>
@endpush
