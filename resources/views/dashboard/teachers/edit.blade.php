@extends('dashboard.layouts.master')

@section('title', 'Edit Teacher')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Teacher</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.teachers.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                           name="name" value="{{ old('name', $teacher->name) }}" required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                           name="slug" value="{{ old('slug', $teacher->slug) }}" placeholder="Auto-generated from name if left empty">
                    <small class="text-muted">Leave empty to auto-generate from name, or enter custom slug</small>
                    @error('slug')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    @if($teacher->image)
                        <div class="mb-2">
                            <img src="{{ asset('uploads/teachers/' . $teacher->image) }}" alt="{{ $teacher->name }}"
                                style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                        </div>
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image"
                           name="image" accept="image/*">
                    <small class="text-muted">Leave empty to keep current image</small>
                    @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">Short Description</label>
                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                              name="short_description" rows="3">{{ old('short_description', $teacher->short_description) }}</textarea>
                    <small class="text-muted">Brief description about the teacher (max 500 characters)</small>
                    @error('short_description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control summernote @error('description') is-invalid @enderror" id="description"
                              name="description">{{ old('description', $teacher->description) }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="text-muted">Full description about the teacher. You can format text, add links, images, and more using the editor toolbar.</small>
                </div>

                <div class="mb-3">
                    <label for="video_url" class="form-label">Video URL (YouTube Embed)</label>
                    <input type="text" class="form-control @error('video_url') is-invalid @enderror" id="video_url"
                           name="video_url" value="{{ old('video_url', $teacher->video_url) }}"
                           placeholder="e.g. https://www.youtube.com/embed/VIDEO_ID">
                    <small class="text-muted">Use YouTube embed URL format: https://www.youtube.com/embed/VIDEO_ID</small>
                    @error('video_url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="active" {{ old('status', $teacher->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $teacher->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="sort_order" class="form-label">Sort Order</label>
                        <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                               id="sort_order" name="sort_order" value="{{ old('sort_order', $teacher->sort_order) }}" min="0">
                        @error('sort_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- SEO Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="ti ti-seo me-2"></i>
                            SEO Settings
                        </h5>
                        <p class="text-muted small mb-0">Configure SEO meta tags and schema markup for this teacher</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="meta_title" class="form-label">Meta Title</label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                       id="meta_title" name="meta_title" value="{{ old('meta_title', $teacher->meta_title) }}"
                                       maxlength="255" placeholder="SEO title for this teacher">
                                <small class="text-muted">Recommended: 50-60 characters. Leave empty to use teacher name.</small>
                                @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                       id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $teacher->meta_keywords) }}"
                                       placeholder="keyword1, keyword2, keyword3">
                                <small class="text-muted">Separate keywords with commas</small>
                                @error('meta_keywords')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror"
                                      id="meta_description" name="meta_description" rows="3"
                                      maxlength="500" placeholder="Brief description for search engines">{{ old('meta_description', $teacher->meta_description) }}</textarea>
                            <small class="text-muted">Recommended: 150-160 characters. Leave empty to use short description.</small>
                            @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="canonical_url" class="form-label">Canonical URL</label>
                            <input type="url" class="form-control @error('canonical_url') is-invalid @enderror"
                                   id="canonical_url" name="canonical_url" value="{{ old('canonical_url', $teacher->canonical_url) }}"
                                   placeholder="https://example.com/teacher-name">
                            <small class="text-muted">Leave empty to auto-generate from teacher page URL. Use for duplicate content prevention.</small>
                            @error('canonical_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="schema_block" class="form-label">Schema Markup (JSON-LD)</label>
                            <textarea class="form-control @error('schema_block') is-invalid @enderror"
                                      id="schema_block" name="schema_block" rows="8"
                                      placeholder='{"@@context": "https://schema.org", "@type": "Person", "name": "Teacher Name"}'>{{ old('schema_block', $teacher->schema_block) }}</textarea>
                            <small class="text-muted">Optional: Add structured data markup for better SEO. Must be valid JSON-LD format.</small>
                            @error('schema_block')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Certificates Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="ti ti-certificate me-2"></i>
                            Teacher Certificates
                        </h5>
                        <p class="text-muted small mb-0">Manage certificates and qualifications for this teacher</p>
                    </div>
                    <div class="card-body">
                        <!-- Existing Certificates -->
                        <div id="existing-certificates">
                            @foreach($teacher->certificates as $index => $certificate)
                                <div class="existing-certificate-item border rounded p-3 mb-3" data-id="{{ $certificate->id }}">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <h6 class="mb-0">{{ $certificate->title ?: 'Certificate ' . ($index + 1) }}</h6>
                                        <button type="button" class="btn btn-sm btn-outline-danger delete-existing-certificate" data-id="{{ $certificate->id }}">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>

                                    <input type="hidden" name="existing_certificate_ids[]" value="{{ $certificate->id }}">

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Certificate Title</label>
                                            <input type="text" name="existing_certificate_titles[]" class="form-control" value="{{ $certificate->title }}" placeholder="e.g., Bachelor of Education">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Issuer</label>
                                            <input type="text" name="existing_certificate_issuers[]" class="form-control" value="{{ $certificate->issuer }}" placeholder="e.g., University Name">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Current Image</label>
                                            <div class="current-image mb-2">
                                                <img src="{{ $certificate->image_url }}" alt="{{ $certificate->image_alt }}" class="img-fluid rounded" style="max-height: 150px;">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Image Alt Text</label>
                                            <input type="text" name="existing_certificate_alts[]" class="form-control" value="{{ $certificate->image_alt }}" placeholder="Describe the certificate image">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Description (Optional)</label>
                                        <textarea name="existing_certificate_descriptions[]" class="form-control" rows="2" placeholder="Additional details about this certificate">{{ $certificate->description }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- New Certificates -->
                        <div id="certificates-container">
                            <!-- New certificate items will be added here -->
                        </div>

                        <button type="button" class="btn btn-outline-primary" id="add-certificate">
                            <i class="ti ti-plus me-2"></i>
                            Add New Certificate
                        </button>

                        <!-- Hidden inputs for deletions -->
                        <div id="delete-certificates-container"></div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.teachers.index') }}" class="btn btn-label-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        console.log('=== TEACHERS EDIT PAGE ===');
        console.log('jQuery available:', typeof $ !== 'undefined');
        console.log('Summernote available:', typeof $.fn.summernote !== 'undefined');

        $(document).ready(function() {
            if (typeof $.fn.summernote !== 'undefined') {
                console.log('Initializing Summernote...');

                // Initialize Summernote for description
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

                console.log('Summernote initialized successfully!');
            } else {
                console.error('Summernote is not available!');
            }

            // Auto-generate slug from name
            $('#name').on('input', function () {
                const $slugInput = $('#slug');
                if (!$slugInput.val() || $slugInput.val() === '{{ $teacher->slug }}') {
                    $slugInput.val(
                        $(this).val().toLowerCase()
                            .replace(/[^a-z0-9]+/g, '-')
                            .replace(/^-+|-+$/g, '')
                    );
                }
            });

            // Certificate management
            let certificateIndex = 0;

            function addCertificateItem() {
                const certificateHtml = `
                    <div class="certificate-item border rounded p-3 mb-3" data-index="${certificateIndex}">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <h6 class="mb-0">New Certificate ${certificateIndex + 1}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-certificate">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Certificate Title</label>
                                <input type="text" name="certificate_titles[${certificateIndex}]" class="form-control" placeholder="e.g., Bachelor of Education">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Issuer</label>
                                <input type="text" name="certificate_issuers[${certificateIndex}]" class="form-control" placeholder="e.g., University Name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Certificate Image</label>
                                <input type="file" name="certificate_images[${certificateIndex}]" class="form-control certificate-image" accept="image/*" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Image Alt Text</label>
                                <input type="text" name="certificate_alts[${certificateIndex}]" class="form-control" placeholder="Describe the certificate image">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (Optional)</label>
                            <textarea name="certificate_descriptions[${certificateIndex}]" class="form-control" rows="2" placeholder="Additional details about this certificate"></textarea>
                        </div>

                        <div class="certificate-preview" style="display: none;">
                            <label class="form-label">Preview:</label>
                            <div class="preview-container"></div>
                        </div>
                    </div>
                `;

                $('#certificates-container').append(certificateHtml);
                certificateIndex++;
            }

            // Add certificate button
            $('#add-certificate').on('click', function() {
                addCertificateItem();
            });

            // Remove new certificate
            $(document).on('click', '.remove-certificate', function() {
                $(this).closest('.certificate-item').remove();
            });

            // Delete existing certificate
            $(document).on('click', '.delete-existing-certificate', function() {
                const certificateId = $(this).data('id');
                const certificateItem = $(this).closest('.existing-certificate-item');

                // Add hidden input for deletion
                $('#delete-certificates-container').append(`<input type="hidden" name="delete_certificate_ids[]" value="${certificateId}">`);

                // Hide the certificate item
                certificateItem.hide();
            });

            // Certificate image preview
            $(document).on('change', '.certificate-image', function() {
                const file = this.files[0];
                const previewContainer = $(this).closest('.certificate-item').find('.preview-container');
                const previewDiv = $(this).closest('.certificate-item').find('.certificate-preview');

                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.html('<img src="' + e.target.result + '" class="img-fluid rounded" style="max-height: 150px;">');
                        previewDiv.show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    previewDiv.hide();
                }
            });
        });
    </script>
@endpush
