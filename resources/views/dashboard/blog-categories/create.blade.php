@extends('dashboard.layouts.master')

@section('title', 'Create Blog Category')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create New Blog Category</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.blog-categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                            value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"
                        value="{{ old('slug') }}" placeholder="Auto-generated from name if left empty">
                    <small class="text-muted">Leave empty to auto-generate from name, or enter custom slug</small>
                    @error('slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control summernote @error('description') is-invalid @enderror" id="description"
                        name="description">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">You can format text, add links, images, and more using the editor toolbar.</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image"
                            accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="image_alt" class="form-label">Image Alt Text</label>
                        <input type="text" class="form-control @error('image_alt') is-invalid @enderror" id="image_alt" name="image_alt"
                            value="{{ old('image_alt') }}" placeholder="Alternative text for the image">
                        <small class="text-muted">Important for SEO and accessibility</small>
                        @error('image_alt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                            required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order"
                            name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                        @error('sort_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">
                <h5 class="mb-3">SEO Settings</h5>

                <div class="mb-3">
                    <label for="meta_title" class="form-label">Meta Title</label>
                    <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title"
                        value="{{ old('meta_title') }}" placeholder="SEO title for search engines" maxlength="255">
                    <small class="text-muted">Recommended: 50-60 characters</small>
                    @error('meta_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_description" class="form-label">Meta Description</label>
                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description"
                        rows="3" placeholder="SEO description for search engines">{{ old('meta_description') }}</textarea>
                    <small class="text-muted">Recommended: 150-160 characters</small>
                    @error('meta_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="meta_keywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords"
                        value="{{ old('meta_keywords') }}" placeholder="Comma-separated keywords">
                    <small class="text-muted">Example: keyword1, keyword2, keyword3</small>
                    @error('meta_keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="schema_block" class="form-label">Schema Block (JSON-LD)</label>
                    <textarea class="form-control @error('schema_block') is-invalid @enderror" id="schema_block" name="schema_block"
                        rows="5" placeholder='{"@@context": "https://schema.org", ...}'>{{ old('schema_block') }}</textarea>
                    <small class="text-muted">Structured data in JSON-LD format for rich snippets</small>
                    @error('schema_block')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.blog-categories.index', request()->query()) }}" class="btn btn-label-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<style>
    .image-preview img {
        border-radius: 8px;
        border: 2px solid #e3e6f0;
    }

    /* Additional Summernote fixes for this page */
    .note-editor {
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
    }

    .note-toolbar {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }

    .note-editing-area {
        background-color: #fff;
    }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote
        if (typeof $.fn.summernote !== 'undefined') {
            $('#description').summernote({
                height: 300,
                tooltip: false,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ],
                placeholder: 'Write your content here...',
                tabsize: 2,
                focus: false,
                dialogsInBody: true,
                popover: {
                    image: [
                        ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                        ['float', ['floatLeft', 'floatRight', 'floatNone']],
                        ['remove', ['removeMedia']]
                    ],
                    link: [
                        ['link', ['linkDialogShow', 'unlink']]
                    ],
                    table: [
                        ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                        ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                    ],
                    air: [
                        ['color', ['color']],
                        ['font', ['bold', 'underline', 'clear']]
                    ]
                },
                callbacks: {
                    onInit: function() {
                        $('.note-editor').css('background-color', '#252836');
                        $('.note-editing-area').css('background-color', '#252836');
                        $('.note-editing-area').css('color', '#e4e6eb');
                    }
                }
            });

            // Fix Summernote dropdowns
            $(document).on('click', '.note-btn-group .dropdown-toggle', function(e) {
                e.preventDefault();
                e.stopPropagation();
                var $this = $(this);
                var $group = $this.closest('.note-btn-group');
                var $menu = $group.find('.note-dropdown-menu');
                // Close other dropdowns
                $('.note-btn-group').not($group).removeClass('open');
                $('.note-dropdown-menu').not($menu).removeClass('open').hide();
                // Toggle current dropdown
                $group.toggleClass('open');
                $menu.toggleClass('open').toggle();
            });

            // Close dropdowns when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.note-btn-group').length) {
                    $('.note-btn-group').removeClass('open');
                    $('.note-dropdown-menu').removeClass('open').hide();
                }
            });
        }

        // Auto-generate slug from name
        $('#name').on('input', function() {
            const slugInput = $('#slug');
            if (!slugInput.val()) {
                slugInput.val(
                    $(this).val().toLowerCase()
                        .replace(/[^a-z0-9]+/g, '-')
                        .replace(/^-+|-+$/g, '')
                );
            }
        });

        // Image preview
        $('#image').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Remove existing preview
                    $('.image-preview').remove();

                    // Add new preview
                    const preview = $('<div class="image-preview mt-2"><img src="' + e.target.result + '" class="img-thumbnail" style="max-width: 200px; max-height: 200px;"></div>');
                    $('#image').parent().append(preview);
                };
                reader.readAsDataURL(file);
            }
        });

        // Initialize Bootstrap dropdowns
        if (typeof bootstrap !== 'undefined') {
            const dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
            const dropdownList = dropdownElementList.map(function(dropdownToggleEl) {
                return new bootstrap.Dropdown(dropdownToggleEl);
            });
        }

        // Initialize select2 if available
        if (typeof $.fn.select2 !== 'undefined') {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });
        }
    });
</script>
@endpush
