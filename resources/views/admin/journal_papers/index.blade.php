<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.header_scripts')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
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
                        <h4 class="mb-3 mb-md-0">Journal papers</h4>
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
                            <!-- Display the list of Journal Papers entries -->
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

                                    <form id="createJournalPaperForm" action="{{ route('admin.journal_papers.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input type="text" class="form-control" id="title" name="title">
                                        </div>
                                        <div class="form-group">
                                            <label for="link">Link:</label>
                                            <input type="text" class="form-control" id="link" name="link">
                                        </div>
                                        <div>
                                            <label for="pdf_path">PDF File:</label>
                                         <sub class="text-danger">min size: MB 2</sub>
                                            <input type="file" class="form-control-file" id="pdf_path" name="pdf_path" accept=".pdf" required>
                                            @error('pdf_path')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    <div class="form-group">
                                            <label for="image_path">Image File:</label>
                                           <sub class="text-danger">min size: MB 2</sub>
                                            <input type="file" class="form-control-file" id="image_path" name="image_path" accept=".jpeg, .png, .jpg">
                                            @error('image_path')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="publication_date">Publication Date:</label>
                                            <input type="date" class="form-control" id="publication_date" name="publication_date">
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
                                    <br>
                                    <div class="row">
                                        @foreach($journalPapers as $journalPaper)
                                        <div class="col-md-4 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <!-- Journal Paper Details -->
                                                    <h5 class="card-title">{{ $journalPaper->title }}</h5>
                                                    <p class="card-text"><strong>Link:</strong> <a href="{{ $journalPaper->link }}" target="_blank">{{ $journalPaper->link }}</a></p>
                                                    <p class="card-text"><strong>Publication Date:</strong> {{ $journalPaper->publication_date }}</p>
                                                    <p class="card-text"><strong>Team Members:</strong>
                                                        @foreach($journalPaper->teams as $teamMember)
                                                        {{ $teamMember->member_name }}@if(!$loop->last),@endif
                                                        @endforeach
                                                    </p>

                                                    <!-- Display PDF file -->
                                                    <a href="{{ asset($journalPaper->pdf_path) }}" target="_blank">View PDF</a>
                                                    

                                                    <!-- Display Image file -->
                                                    <img src="{{ asset($journalPaper->image_path) }}" alt="Journal Image" style="max-width: 100%; height: auto;">

                                                    <div class="mt-3">
                                                        <!-- Edit and Delete buttons -->
                                                        <button class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal{{ $journalPaper->id }}">Edit</button>
                                                        <form action="{{ route('admin.journal_papers.destroy', ['journal_paper' => $journalPaper->id]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-delete ml-2">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="editModal{{ $journalPaper->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $journalPaper->id }}" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $journalPaper->id }}">Edit
                                                            Journal Paper</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>

                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Update form inside the modal -->
                                                        <form action="{{ route('admin.journal_papers.update', ['journal_paper' => $journalPaper->id]) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group">
                                                                <label for="updateTitle{{ $journalPaper->id }}">Title:</label>
                                                                <input type="text" class="form-control" id="updateTitle{{ $journalPaper->id }}" name="title" value="{{ $journalPaper->title }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updateLink{{ $journalPaper->id }}">Link:</label>
                                                                <input type="text" class="form-control" id="updateLink{{ $journalPaper->id }}" name="link" value="{{ $journalPaper->link }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updatePublicationDate{{ $journalPaper->id }}">Publication
                                                                    Date:</label>
                                                                <input type="date" class="form-control" id="updatePublicationDate{{ $journalPaper->id }}" name="publication_date" value="{{ $journalPaper->publication_date }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updatePDF{{ $journalPaper->id }}">Upload
                                                                    PDF:</label>
                                                                  <sub class="text-danger">min size: MB 2</sub>
                                                                <input type="file" class="form-control-file" id="updatePDF{{ $journalPaper->id }}" name="pdf_path" accept=".pdf">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="updateImage{{ $journalPaper->id }}">Upload
                                                                    Image:</label>
                                                                    <sub class="text-danger">min size: MB 2</sub>
                                                                <input type="file" class="form-control-file" id="updateImage{{ $journalPaper->id }}" name="image_path" accept=".jpeg, .png, .jpg">
                                                            </div>


                                                            <div class="form-group">
                                                                <label for="updateTeamMembers{{ $journalPaper->id }}">Team
                                                                    Members:</label>
                                                                <select class="selectpicker" id="updateTeamMembers{{ $journalPaper->id }}" multiple data-live-search="true" name="team_members[]">
                                                                    @foreach($teamMembers as $teamMember)
                                                                    <option value="{{ $teamMember->id }}" @if(in_array($teamMember->id,
                                                                        $journalPaper->teams->pluck('id')->toArray()))
                                                                        selected @endif>
                                                                        {{ $teamMember->member_name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>


                                                            <!-- Move the Update button outside of the select element -->
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
