    <!DOCTYPE html>

    <html lang="en">

    <head>
        @include('admin.header_scripts')


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js">
        </script>

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
                            <h4 class="mb-3 mb-md-0">Conference papers</h4>
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
                                                @if(session('success')) Success! @elseif(session('delete')) Delete!
                                                @endif
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

                                        <form id="createConferencePaperForm" action="{{ route('admin.conference_papers.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="title">Title:</label>
                                                <input type="text" class="form-control" id="title" name="title" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="link">Link:</label>
                                                <input type="text" class="form-control" id="link" name="link" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="pdf_path">PDF File:</label>
                                                <input type="file" class="form-control-file" id="pdf_path" name="pdf_path" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="image_path">Image File:</label>
                                                <input type="file" class="form-control-file" id="image_path" name="image_path">
                                            </div>
                                            <div class="form-group">
                                                <label for="publication_date">Publication Date:</label>
                                                <input type="date" class="form-control" id="publication_date" name="publication_date" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="team_members">Team Members:</label>
                                                <select class="selectpicker" id="team_members" multiple data-live-search="true" name="team_members[]" required>
                                                    @foreach($teamMembers as $teamMember)
                                                    <option value="{{ $teamMember->id }}">{{ $teamMember->member_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </form>
                                    </div>


                                    <div class="row">
                                        @foreach($conferencePapers as $conferencePaper)
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{ $conferencePaper->title }}</h5>
                                                    <p class="card-text"><strong>Link:</strong> <a href="{{ $conferencePaper->link }}" target="_blank">{{ $conferencePaper->link }}</a></p>
                                                    <p class="card-text"><strong>Publication Date:</strong> {{ $conferencePaper->publication_date }}</p>
                                                    <p class="card-text"><strong>Team Members:</strong>
                                                        @foreach($conferencePaper->teams as $teamMember)
                                                        {{ $teamMember->member_name }}@if(!$loop->last),@endif
                                                        @endforeach
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <!-- Display PDF file -->
                                                            <a href="{{ asset($conferencePaper->pdf_path) }}" target="_blank">View PDF</a>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <!-- Display Image file -->
                                                            <img src="{{ asset($conferencePaper->image_path) }}" alt="Conference Image" style="max-width: 100%; height: auto;">
                                                        </div>
                                                    </div>
                                                    <div class="mt-3">
                                                        <!-- Edit button -->
                                                        <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal{{ $conferencePaper->id }}">Edit</button>
                                                        <form action="{{ route('admin.conference_papers.destroy', ['conference_paper' => $conferencePaper->id]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <!-- Delete button -->
                                                            <button type="submit" class="btn btn-danger btn-delete ml-2">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal{{ $conferencePaper->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $conferencePaper->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $conferencePaper->id }}">
                                                            Edit Conference Paper</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>



                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.conference_papers.update', ['conference_paper' => $conferencePaper->id]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="updateTitle{{ $conferencePaper->id }}">Title:</label>
                                                                <input type="text" class="form-control" id="updateTitle{{ $conferencePaper->id }}" name="title" value="{{ $conferencePaper->title }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updateLink{{ $conferencePaper->id }}">Link:</label>
                                                                <input type="text" class="form-control" id="updateLink{{ $conferencePaper->id }}" name="link" value="{{ $conferencePaper->link }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updatePublicationDate{{ $conferencePaper->id }}">Publication
                                                                    Date:</label>
                                                                <input type="date" class="form-control" id="updatePublicationDate{{ $conferencePaper->id }}" name="publication_date" value="{{ $conferencePaper->publication_date }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updatePDF{{ $conferencePaper->id }}">Upload
                                                                    PDF:</label>
                                                                <input type="file" class="form-control-file" id="updatePDF{{ $conferencePaper->id }}" name="pdf_path">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updateImage{{ $conferencePaper->id }}">Upload
                                                                    Image:</label>
                                                                <input type="file" class="form-control-file" id="updateImage{{ $conferencePaper->id }}" name="image_path">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updateTeamMembers{{ $conferencePaper->id }}">Team
                                                                    Members:</label>
                                                                <select class="selectpicker" id="updateTeamMembers{{ $conferencePaper->id }}" multiple data-live-search="true" name="team_members[]">
                                                                    @foreach($teamMembers as $teamMember)
                                                                    <option value="{{ $teamMember->id }}" @if(in_array($teamMember->id,
                                                                        $conferencePaper->teams->pluck('id')->toArray()))
                                                                        selected @endif>
                                                                        {{ $teamMember->member_name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
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
        <!-- Initialize the plugin: -->
        <script type="text/javascript">
            $(document).ready(function() {
                $('select').selectpicker();
            });

        </script>
        <script src="https://cdn.ckeditor.com/ckeditor5/37.0.0/classic/ckeditor.js"></script>

        @include('admin.bottom_script')



    </body>

    </html>
