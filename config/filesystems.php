<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application for file storage.
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Below you may configure as many filesystem disks as necessary, and you
    | may even configure multiple disks for the same driver. Examples for
    | most supported storage drivers are configured here for reference.
    |
    | Supported drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app/private'),
            'serve' => true,
            'throw' => false,
            'report' => false,
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL') . '/storage',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'categories' => [
            'driver' => 'local',
            'root' => public_path('uploads/categories'),
            'url' => env('APP_URL') . '/uploads/categories',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'blog-categories' => [
            'driver' => 'local',
            'root' => public_path('uploads/blog-categories'),
            'url' => env('APP_URL') . '/uploads/blog-categories',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'sub_categories' => [
            'driver' => 'local',
            'root' => public_path('uploads/sub-categories'),
            'url' => env('APP_URL') . '/uploads/sub-categories',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'sliders' => [
            'driver' => 'local',
            'root' => public_path('uploads/sliders'),
            'url' => env('APP_URL') . '/uploads/sliders',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'testimonials' => [
            'driver' => 'local',
            'root' => public_path('uploads/testimonials'),
            'url' => env('APP_URL') . '/uploads/testimonials',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'countries' => [
            'driver' => 'local',
            'root' => public_path('uploads/countries'),
            'url' => env('APP_URL') . '/uploads/countries',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'blogs' => [
            'driver' => 'local',
            'root' => public_path('uploads/blogs'),
            'url' => env('APP_URL') . '/uploads/blogs',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'teachers' => [
            'driver' => 'local',
            'root' => public_path('uploads/teachers'),
            'url' => env('APP_URL') . '/uploads/teachers',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'partners' => [
            'driver' => 'local',
            'root' => public_path('uploads/partners'),
            'url' => env('APP_URL') . '/uploads/partners',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'events' => [
            'driver' => 'local',
            'root' => public_path('uploads/events'),
            'url' => env('APP_URL') . '/uploads/events',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'course_feedbacks' => [
            'driver' => 'local',
            'root' => public_path('uploads/course-feedbacks'),
            'url' => env('APP_URL') . '/uploads/course-feedbacks',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'courses' => [
            'driver' => 'local',
            'root' => public_path('uploads/courses'),
            'url' => env('APP_URL') . '/uploads/courses',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'settings' => [
            'driver' => 'local',
            'root' => public_path('uploads/settings'),
            'url' => env('APP_URL') . '/uploads/settings',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'teacher_certificates' => [
            'driver' => 'local',
            'root' => storage_path('app/public/teacher_certificates'),
            'url' => env('APP_URL') . '/storage/teacher_certificates',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        'tour_variants' => [
            'driver' => 'local',
            'root' => public_path('uploads/tour-variants'),
            'url' => env('APP_URL') . '/uploads/tour-variants',
            'visibility' => 'public',
            'throw' => false,
            'report' => false,
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
            'use_path_style_endpoint' => env('AWS_USE_PATH_STYLE_ENDPOINT', false),
            'throw' => false,
            'report' => false,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],

];
