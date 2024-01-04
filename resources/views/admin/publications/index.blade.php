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
                        <h4 class="mb-3 mb-md-0">Publications</h4>
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

                                    <form id="createDocumentationForm" action="{{ route('admin.publications.store') }}" method="POST">
                                        @csrf
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
                                        </div> <br>
                                        </div>
                                        <button type="submit" id="createDocumentation" class="btn btn-primary">Submit</button>
                                    </form>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Content</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($documentations as $documentation)
                                            <tr>
                                                <td>
                                                    <div class="content-text">{!! $documentation->content !!}</div>
                                                    <textarea class="form-control edit-content" style="display:none;">{{ $documentation->content }}</textarea>
                                                </td>
                                                <td>
                                                    <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal{{ $documentation->id }}">Edit</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editModal{{ $documentation->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $documentation->id }}" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel{{ $documentation->id }}">Edit Content</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('admin.publications.update', ['id' => $documentation->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-group">
                                                                            <label for="updateContent{{ $documentation->id }}">Content:</label>
                                                                            <!-- Render CKEditor instance -->
                                                                            <textarea class="form-control" id="updateContent{{ $documentation->id }}" name="content">{!! $documentation->content !!}</textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-success">Update</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('admin.publications.delete', ['id' => $documentation->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>




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
