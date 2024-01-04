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
                        <h4 class="mb-3 mb-md-0">Contacts</h4>
                    </div>
                    <div class="d-flex align-items-center flex-wrap text-nowrap">
                        <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
                            <span class="input-group-text input-group-addon bg-transparent border-primary"
                                data-toggle><i data-feather="calendar" class="text-primary"></i></span>
                            <input type="text" class="form-control bg-transparent border-primary"
                                placeholder="Select date" data-input>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-xl-12 stretch-card">
                        <div class="row flex-grow-1">
                            <!-- Display the list of contact messages -->
                            @foreach($contactMessages as $contactMessage)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>{{ $contactMessage->fullname }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Email:</strong> {{ $contactMessage->email_address }}</p>
                                        <p><strong>Phone:</strong> {{ $contactMessage->phone_number }}</p>
                                        <p><strong>Message:</strong>
                                            {{ substr(strip_tags($contactMessage->message), 0, 100) }}{{ strlen(strip_tags($contactMessage->message)) > 100 ? "..." : "" }}
                                        </p>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary btn-edit" data-toggle="modal"
                                            data-target="#editModal{{ $contactMessage->id }}">Edit</button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                            data-target="#viewModal{{ $contactMessage->id }}">
                                            View Details
                                        </button>
                                        <form
                                            action="{{ route('admin.contact.destroy', ['id' => $contactMessage->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal for View -->
                            <div class="modal fade" id="viewModal{{ $contactMessage->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="viewModalLabel{{ $contactMessage->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="viewModalLabel{{ $contactMessage->id }}">View
                                                Contact Details</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Email:</strong> {{ $contactMessage->email_address }}</p>
                                            <p><strong>Phone:</strong> {{ $contactMessage->phone_number }}</p>
                                            <p><strong>Message:</strong> {{ $contactMessage->message }}</p>
                                            <!-- Add any other necessary details to display -->
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal -->
                            <div class="modal fade" id="editModal{{ $contactMessage->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="editModalLabel{{ $contactMessage->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $contactMessage->id }}">Edit
                                                contact</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form
                                                action="{{ route('admin.contact.update', ['id' => $contactMessage->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <!-- Placeholder form fields, replace with actual form fields for editing -->
                                                <div class="form-group">
                                                    <label for="editFullName{{ $contactMessage->id }}">Full
                                                        Name:</label>
                                                    <input type="text" class="form-control"
                                                        id="editFullName{{ $contactMessage->id }}" name="fullname"
                                                        value="{{ $contactMessage->fullname }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editEmail{{ $contactMessage->id }}">Email
                                                        Address:</label>
                                                    <input type="email" class="form-control"
                                                        id="editEmail{{ $contactMessage->id }}" name="email_address"
                                                        value="{{ $contactMessage->email_address }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editPhone{{ $contactMessage->id }}">Phone
                                                        Number:</label>
                                                    <input type="text" class="form-control"
                                                        id="editPhone{{ $contactMessage->id }}" name="phone_number"
                                                        value="{{ $contactMessage->phone_number }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editMessage{{ $contactMessage->id }}">Message:</label>
                                                    <textarea class="form-control"
                                                        id="editMessage{{ $contactMessage->id }}" name="message"
                                                        rows="4">{{ $contactMessage->message }}</textarea>
                                                </div>
                                                <!-- Add any other necessary fields for editing -->
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
                <!-- partial:partials/_footer.html -->
                @include('admin.footer')
                <!-- partial -->

            </div>
        </div>
        <script src="https://cdn.ckeditor.com/ckeditor5/37.0.0/classic/ckeditor.js"></script>

        @include('admin.bottom_script')

</body>

</html>