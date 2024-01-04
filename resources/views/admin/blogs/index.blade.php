<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.header_scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Include Quill script and styles -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        @include('admin.setting_sidebar')
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            @include('admin.navbar')
            <!-- partial -->

            <div class="page-content">

                <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                    <div>
                        <h4 class="mb-3 mb-md-0">Blog news</h4>
                    </div>
                    <div class="d-flex align-items-center flex-wrap text-nowrap">
                        <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                            <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                            <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-12 stretch-card">
                        <div class="row flex-grow-1">
                            <!-- Display the list of About Us entries -->
                            <div class="card">
                                <div class="card-body">
                                    @if (session('success') || session('delete'))
                                    <div id="alertMessage" class="alert alert-dismissible fade show 
                                  @if(session('success')) alert-success @elseif(session('delete')) alert-danger @endif" role="alert">
                                        <strong>
                                            @if(session('success')) Success! @elseif(session('delete')) Delete! @endif
                                        </strong>
                                        {{ session('success') ?? session('delete') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    <script>
                                        $(document).ready(function() {
                                            setTimeout(function() {
                                                $('#alertMessage').fadeOut('slow');
                                            }, 3000); // Disappear after 3 seconds (3000 milliseconds)
                                        });

                                    </script>
                                    @endif

                                    <form id="createBlogForm" action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="image_path">Thumbnail Image:</label>
                                            <sub class="text-danger">min size: MB 2</sub>
                                            <input type="file" class="form-control" id="image_path" name="image_path" accept=".jpeg, .png, .jpg">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content:</label>
                                            <div id="quill-editor" style="height: 200px;"></div>
                                            <textarea style="display:none;" id="content" name="content"></textarea>
                                        </div>
                                        <!-- Add any other necessary fields -->
                                        <button type="submit" id="createBlog" class="btn btn-primary">Add Blog</button>
                                    </form>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        @foreach($blogs as $blog)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <img src="{{ asset($blog->image_path) }}" class="card-img-top" alt="Blog Image" style="max-height: 200px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $blog->title }}</h5>
                                                    <p class="card-text">
                                                        {{ substr(strip_tags($blog->content), 0, 150) }}{{ strlen(strip_tags($blog->content)) > 150 ? "..." : "" }}
                                                    </p>
                                                    <button class="btn btn-primary btn-show" data-toggle="modal" data-target="#showModal{{ $blog->id }}">View blog
                                                    </button>

                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal{{ $blog->id }}">Edit
                                                    </button>
                                                    <form action="{{ route('admin.blogs.destroy', ['id' => $blog->id]) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- EditModal -->
                                        <div class="modal fade" id="editModal{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $blog->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $blog->id }}">Edit
                                                            Blog</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.blogs.update', ['id' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="editTitle{{ $blog->id }}">Title:</label>
                                                                <input type="text" class="form-control" id="editTitle{{ $blog->id }}" name="title" value="{{ $blog->title }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editImage{{ $blog->id }}">Image
                                                                    Thumbnail:</label>
                                                                    <sub class="text-danger">min size: MB 2</sub>
                                                                <input type="file" class="form-control" id="editImage{{ $blog->id }}" name="image_path" value="{{ $blog->image_path }}" accept=".jpeg, .png, .jpg">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editContent{{ $blog->id }}">Content:</label>
                                                                <div id="quill-editor-edit-{{ $blog->id }}" style="height: 500px; max-width: 100%; overflow-y: auto;">
                                                                    {!! $blog->content !!}</div>
                                                                <input type="hidden" id="editContentInput{{ $blog->id }}" name="content" value="{{ $blog->content }}">
                                                            </div>

                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- EditModal ended  -->
                                        {{-- show modal srtarts --}}
                                        <div class="modal fade" id="showModal{{ $blog->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $blog->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="showModalLabel{{ $blog->id }}">View
                                                            blog</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.blogs.update', ['id' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="editTitle{{ $blog->id }}">Title:</label>
                                                                <input type="text" class="form-control" id="editTitle{{ $blog->id }}" name="title" value="{{ $blog->title }}" readonly>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="showImage{{ $blog->id }}">Image
                                                                    Thumbnail:</label>
                                                                <img src="{{ asset($blog->image_path) }}" class="card-img-top" alt="Blog Image" style="max-height: 200px; object-fit: cover;">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editContent{{ $blog->id }}">Content:</label>
                                                                <div id="quill-editor-sho-{{ $blog->id }}" style="height: 500px; max-width: 100%; overflow-y: auto;">
                                                                    {!! $blog->content !!}</div>
                                                                <input type="hidden" id="showContentInput{{ $blog->id }}" name="content" value="{{ $blog->content }}" readonly>
                                                            </div>

                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">Close blog
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- SHOW MODAL ENDED --}}


                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- partial:partials/_footer.html -->
                @include('admin.footer')
                <!-- partial -->

            </div>
        </div>

        @include('admin.bottom_script')
        @foreach($blogs as $blog)

        <script>
        {{-- show modal starts --}}
        $(document).ready(function() {
        // Manually initialize Quill in the modal
        var quillEdit = new Quill('#quill-editor-show-{{ $blog->id }}', {
        theme: 'snow'
        , modules: {
        toolbar: [
        ['bold', 'italic', 'underline', 'strike'], // basic formatting
        ['link', 'image'], // link and image, as added in the update
        [{
        'list': 'ordered'
        }, {
        'list': 'bullet'
        }], // lists
        [{
        'indent': '-1'
        }, {
        'indent': '+1'
        }], // indentation
        [{
        'align': []
        }], // alignment
        ['clean'], // remove formatting
        ]
        , }
        , });

        // Set the content of Quill from the hidden input
        quillEdit.root.innerHTML = $('#showContentInput{{ $blog->id }}').val();

        // Update the hidden input when the form is submitted
        // $('#showModal{{ $blog->id }} form').on('submit', function() {
        // $('#showContentInput{{ $blog->id }}').val(quillEdit.root.innerHTML);
        // });
        });

        {{-- edit modal starts --}}
        $(document).ready(function() {
        // Manually initialize Quill in the modal
        var quillEdit = new Quill('#quill-editor-edit-{{ $blog->id }}', {
        theme: 'snow'
        , modules: {
        toolbar: [
        ['bold', 'italic', 'underline', 'strike'], // basic formatting
        ['link', 'image', 'video'], // link, image, and video
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }], // header styles
        ['blockquote', 'code-block'], // blockquote and code block
        [{ 'list': 'ordered' }, { 'list': 'bullet' }], // ordered and bullet lists
        [{ 'align': [] }], // alignment
        ['clean'], // remove formatting
        ]
        ,


        }
        , });

        // Set the content of Quill from the hidden input
        quillEdit.root.innerHTML = $('#editContentInput{{ $blog->id }}').val();

        // Update the hidden input when the form is submitted
        $('#editModal{{ $blog->id }} form').on('submit', function() {
        $('#editContentInput{{ $blog->id }}').val(quillEdit.root.innerHTML);
        });
        });

        </script>
        @endforeach

        <script>
            $(document).ready(function() {
                var quill = new Quill('#quill-editor', {
                    theme: 'snow'
                    , modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'strike'], // basic formatting
                            ['link', 'image'], // link and image, as added in the update
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }], // lists
                            [{
                                'indent': '-1'
                            }, {
                                'indent': '+1'
                            }], // indentation
                            [{
                                'align': []
                            }], // alignment
                            ['clean'], // remove formatting
                        ]
                    , }
                , });

                $('#createBlogForm').submit(function(event) {
                    event.preventDefault();

                    // Get the HTML content from Quill
                    var content = quill.root.innerHTML;

                    // Add the HTML content to the hidden input field
                    $('#content').val(content);

                    // Continue with the form submission or any other logic
                    this.submit();
                });
            });

        </script>
</body>

</html>
