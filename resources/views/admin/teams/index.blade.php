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
    <!-- Font Awesome 4 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



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
                        <h4 class="mb-3 mb-md-0">Team members</h4>
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

                                    <form id="createTeamForm" action="{{ route('admin.teams.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="member_name">Member Name:</label>
                                            <input type="text" class="form-control" id="member_name" name="member_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="image_path">Image File:</label>
                                            <input type="file" class="form-control" id="image_path" name="image_path">
                                        </div>

                                        <div class="form-group">
                                            <label for="member_position">Member Position:</label>
                                            <input type="text" class="form-control" id="member_position" name="member_position">
                                        </div>
                                        <div class="form-group">
                                            <label for="facebook">Facebook:</label>
                                            <input type="text" class="form-control" id="facebook" name="facebook">
                                        </div>
                                        <div class="form-group">
                                            <label for="twitter">Twitter:</label>
                                            <input type="text" class="form-control" id="twitter" name="twitter">
                                        </div>
                                        <div class="form-group">
                                            <label for="instagram">Instagram:</label>
                                            <input type="text" class="form-control" id="instagram" name="instagram">
                                        </div>
                                        <div class="form-group">
                                            <label for="linkedin">LinkedIn:</label>
                                            <input type="text" class="form-control" id="linkedin" name="linkedin">
                                        </div>
                                        <button type="submit" id="createTeam" class="btn btn-primary">Add Team Member</button>
                                    </form>
                                </div>
                                <div class="container mt-4">
                                    <div class="row">
                                        @foreach($teams as $team)
                                        <div class="col-md-4 mb-4">
                                            <div class="card">
                                                <img src="{{ asset($team->image_path) }}" class="card-img-top" alt="Team Member" style="max-height: 200px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $team->member_name }}</h5>
                                                    <p class="card-text">{{ $team->member_position }}</p>
                                                    <div class="social-links">
                                                        <a href="{{ $team->facebook }}" class="btn btn-primary"><i class="fa fa-facebook-f"></i></a>
                                                        <a href="{{ $team->twitter }}" class="btn btn-primary"><i class="fa fa-twitter"></i></a>
                                                        <a href="{{ $team->instagram }}" class="btn btn-primary"><i class="fa fa-instagram"></i></a>
                                                        <a href="{{ $team->linkedin }}" class="btn btn-primary"><i class="fa fa-linkedin"></i></a>
                                                    </div>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal{{ $team->id }}">Edit</button>
                                                    <form action="{{ route('admin.teams.destroy', ['id' => $team->id]) }}" method="POST" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal{{ $team->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $team->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $team->id }}">Edit Team Member</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.teams.update', ['id' => $team->id]) }}"  method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="editImage{{ $team->id }}">Current Image:</label>
                                                                <img src="{{ asset($team->image_path) }}" alt="Current Image" style="max-height: 100px;">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editImage{{ $team->id }}">New Image File:</label>
                                                                <input type="file" class="form-control" id="editImage{{ $team->id }}" name="image_path">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editMemberName{{ $team->id }}">Member Name:</label>
                                                                <input type="text" class="form-control" id="editMemberName{{ $team->id }}" name="member_name" value="{{ $team->member_name }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editMemberPosition{{ $team->id }}">Member Position:</label>
                                                                <input type="text" class="form-control" id="editMemberPosition{{ $team->id }}" name="member_position" value="{{ $team->member_position }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editFacebook{{ $team->id }}">Facebook:</label>
                                                                <input type="text" class="form-control" id="editFacebook{{ $team->id }}" name="facebook" value="{{ $team->facebook }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editTwitter{{ $team->id }}">Twitter:</label>
                                                                <input type="text" class="form-control" id="editTwitter{{ $team->id }}" name="twitter" value="{{ $team->twitter }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editInstagram{{ $team->id }}">Instagram:</label>
                                                                <input type="text" class="form-control" id="editInstagram{{ $team->id }}" name="instagram" value="{{ $team->instagram }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editLinkedIn{{ $team->id }}">LinkedIn:</label>
                                                                <input type="text" class="form-control" id="editLinkedIn{{ $team->id }}" name="linkedin" value="{{ $team->linkedin }}">
                                                            </div>
                                                            <button type="submit" class="btn btn-success">Update</button>
                                                        </form>
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
