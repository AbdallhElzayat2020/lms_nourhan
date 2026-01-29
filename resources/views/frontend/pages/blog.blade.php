@extends('frontend.layouts.master')
@section('title', 'Blogs')
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
                <h1 class="title">Blog</h1>
                <a class="home" href="{{ route('frontend.home') }}">Home </a><span class="icon">/</span>
                <a class="inner-page" href="{{ route('frontend.blog') }}"> Blog</a>
            </div>
        </div>
    </section>
    <!-- ./ page-header -->

    <section class="blog-details pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if ($blogs->count() > 0)
                        <div class="row">
                            @foreach ($blogs as $index => $blog)
                                <div class="col-lg-6 col-md-6 {{ $index > 1 ? 'mt-4' : '' }}">
                                    <div class="post-card-2 post-card-3 inner-post-2 wow fade-in-bottom"
                                        data-wow-delay="{{ 300 + ($index % 2) * 100 }}ms">
                                        <a href="{{ route('frontend.blog.details', ['slug' => $blog->slug]) }}">
                                            <div class="post-thumb">
                                                @php
                                                    $blogCover = $blog->cover_image
                                                        ? public_path('uploads/blogs/' . $blog->cover_image)
                                                        : null;
                                                    $hasCover = $blog->cover_image && $blogCover && file_exists($blogCover);
                                                @endphp

                                                @if ($hasCover)
                                                    <img src="{{ asset('uploads/blogs/' . $blog->cover_image) }}"
                                                        alt="{{ $blog->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                                                @else
                                                    <img src="{{ asset('assets/frontend/img/blog/inner-post-1.png') }}"
                                                        alt="{{ $blog->title }}" style="width: 100%; height: 250px; object-fit: cover;">
                                                @endif
                                            </div>
                                        </a>
                                        <div class="post-content-wrap">
                                            <div class="post-content">
                                                <ul class="post-meta">
                                                    @if ($blog->published_at)
                                                        <li><i
                                                                class="fa-sharp fa-regular fa-clock"></i>{{ $blog->published_at->format('M d, Y') }}
                                                        </li>
                                                    @endif
                                                    @if ($blog->category)
                                                        <li><i class="fa-sharp fa-regular fa-folder"></i>{{ $blog->category->name }}
                                                        </li>
                                                    @endif
                                                    @if ($blog->author)
                                                        <li><i class="fa-sharp fa-regular fa-user"></i>{{ $blog->author }}
                                                        </li>
                                                    @endif
                                                </ul>
                                                <h3 class="title">
                                                    <a
                                                        href="{{ route('frontend.blog.details', ['slug' => $blog->slug]) }}">{{ $blog->title }}</a>
                                                </h3>
                                                @if ($blog->short_description)
                                                    <p>{{ Str::limit($blog->short_description, 120) }}</p>
                                                @endif
                                                <a href="{{ route('frontend.blog.details', ['slug' => $blog->slug]) }}"
                                                    class="ed-primary-btn">Read More <i
                                                        class="fa-regular fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="row mt-5">
                            <div class="col-12">
                                <nav aria-label="Blog pagination">
                                    {{ $blogs->links('pagination::bootstrap-4') }}
                                </nav>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="mb-0">No blog posts available at the moment.</p>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Search</h3>
                        <div class="search-box">
                            <form action="{{ route('frontend.blog') }}" method="GET" class="search-form">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                <input type="text" name="search" class="form-control" placeholder="Search"
                                    value="{{ request('search') }}">
                                <button class="search-btn" type="submit">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Category</h3>
                        <ul class="category-list">
                            <li>
                                <a href="{{ route('frontend.blog') }}" class="{{ !request('category') ? 'active' : '' }}">
                                    <i class="fa-sharp fa-solid fa-circle-check"></i>All Categories
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('frontend.blog', ['category' => $category->slug]) }}"
                                       class="{{ request('category') == $category->slug ? 'active' : '' }}">
                                        <i class="fa-sharp fa-solid fa-circle-check"></i>{{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
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
