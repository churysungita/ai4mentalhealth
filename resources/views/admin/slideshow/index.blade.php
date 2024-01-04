<!DOCTYPE html>

<html lang="en">
<head>
    @include('admin.header_scripts')


    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include CKEditor script -->



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
                        <h4 class="mb-3 mb-md-0">Slideshow</h4>
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

                                    <form id="createSlideshowForm" action="{{ route('admin.slideshow.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="heading">Heading:</label>
                                            <input type="text" class="form-control" id="heading" name="heading">
                                        </div>
                                        <div class="form-group">
                                            <label for="content">Content:</label>
                                            <textarea class="form-control" id="content" name="content" rows="4"></textarea>
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    ClassicEditor
                                                        .create(document.querySelector('#content'))
                                                        .catch(error => {
                                                            console.error(error);
                                                        });
                                                });

                                            </script>
                                        </div>
                                        <div class="form-group">
                                            <label for="image_path">Image File:</label>
                                            <input type="file" class="form-control" id="image_path" name="image_path">
                                        </div>
                                        <div class="form-group">
                                            <label for="action_link">Action Link:</label>
                                            <input type="text" class="form-control" id="action_link" name="action_link">
                                        </div>
                                        <button type="submit" id="createSlideshow" class="btn btn-primary">Submit</button>
                                    </form>

                                </div>
<br><br>

                                <div class="row">
                                    @foreach($slideshows as $slideshow)
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <img src="{{ asset($slideshow->image_path) }}" class="card-img-top" alt="Slideshow Image" style="max-width: 100%; height: auto;">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $slideshow->heading }}</h5>
                                                <p class="card-text">{{ $slideshow->content }}</p>
                                                <p class="card-text"><small class="text-muted">{{ $slideshow->action_link }}</small></p>
                                                <div class="d-flex justify-content-between">
                                                    <!-- Edit Button -->
                                                    <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal{{ $slideshow->id }}">Edit</button>

                                                    <!-- Delete Form -->
                                                    <form action="{{ route('admin.slideshow.delete', ['id' => $slideshow->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal{{ $slideshow->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $slideshow->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{!! $slideshow->id !!}">Edit Content</h5>

                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.slideshow.update', ['id' => $slideshow->id]) }}" method="POST" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="updateHeading{{ $slideshow->id }}">Heading:</label>
                                                                <input type="text" class="form-control" id="updateHeading{{ $slideshow->id }}" name="heading" value="{{ $slideshow->heading }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updateContent{!! $slideshow->id !!}">Content:</label>
                                                                <!-- Render CKEditor instance -->
                                                                <textarea class="form-control" id="updateContent{!! $slideshow->id !!}" name="content">{!! $slideshow->content !!}</textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updateImagePath{{ $slideshow->id }}">Image Path:</label>
                                                                <input type="file" class="form-control" id="updateImagePath{{ $slideshow->id }}" name="image_path" value="{{ $slideshow->image_path }}">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updateActionLink{{ $slideshow->id }}">Action Link:</label>
                                                                <input type="text" class="form-control" id="updateActionLink{{ $slideshow->id }}" name="action_link" value="{{ $slideshow->action_link }}">
                                                            </div>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                    </div>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/37.0.0/classic/ckeditor.js"></script>

    @include('admin.bottom_script')



</body>
</html>
