<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.header_scripts')
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
                        <h4 class="mb-3 mb-md-0">AI4MH DASHBOARD</h4>
                    </div>
                    <div class="d-flex align-items-center flex-wrap text-nowrap">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-12 stretch-card">
                        <div class="row flex-grow-1">
                            <!-- Blog Card -->
                            <div class="col-md-4 grid-margin stretch-card">
                                <a href="{{ route('admin.blogs.index') }}" class="card-link">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <h6 class="card-title mb-0">Blogs</h6>
                                                <div class="dropdown mb-2">
                                                    <i class="icon-lg text-muted pb-3px"
                                                        data-feather="more-horizontal"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-12 col-xl-5">
                                                    <h3 class="mb-2">{{ $blogCount }}</h3>
                                                    <div class="d-flex align-items-baseline">
                                                        <!-- Additional content if needed -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Messages Card -->
                            <div class="col-md-4 grid-margin stretch-card">
                                <a href="{{ route('admin.contact.index') }}" class="card-link">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <h6 class="card-title mb-0">Messages</h6>
                                                <div class="dropdown mb-2">
                                                    <i class="icon-lg text-muted pb-3px"
                                                        data-feather="more-horizontal"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-12 col-xl-5">
                                                    <h3 class="mb-2">{{ $contactUsCount }}</h3>
                                                    <div class="d-flex align-items-baseline">
                                                        <!-- Additional content if needed -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Team Card -->
                            <div class="col-md-4 grid-margin stretch-card">
                                <a href="{{ route('admin.teams.index') }}" class="card-link">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <h6 class="card-title mb-0">TEAM</h6>
                                                <div class="dropdown mb-2">
                                                    <i class="icon-lg text-muted pb-3px"
                                                        data-feather="more-horizontal"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-12 col-xl-5">
                                                    <h3 class="mb-2">{{ $teamCount }}</h3>
                                                    <div class="d-flex align-items-baseline">
                                                        <!-- Additional content if needed -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Conference Papers Card -->
                            <div class="col-md-4 grid-margin stretch-card">
                                <a href="{{ route('admin.conference_papers.index') }}" class="card-link">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <h6 class="card-title mb-0">Conference Papers</h6>
                                                <div class="dropdown mb-2">
                                                    <i class="icon-lg text-muted pb-3px"
                                                        data-feather="more-horizontal"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-12 col-xl-5">
                                                    <h3 class="mb-2">{{ $conferencePaperCount }}</h3>
                                                    <div class="d-flex align-items-baseline">
                                                        <!-- Additional content if needed -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <!-- Journal Papers Card -->
                            <div class="col-md-4 grid-margin stretch-card">
                                <a href="{{ route('admin.journal_papers.index') }}" class="card-link">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-baseline">
                                                <h6 class="card-title mb-0">Journal Papers</h6>
                                                <div class="dropdown mb-2">
                                                    <i class="icon-lg text-muted pb-3px"
                                                        data-feather="more-horizontal"></i>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 col-md-12 col-xl-5">
                                                    <h3 class="mb-2">{{ $journalPaperCount }}</h3>
                                                    <div class="d-flex align-items-baseline">
                                                        <!-- Additional content if needed -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->
            </div>
            <!-- partial:partials/_footer.html -->
            @include('admin.footer')
            <!-- partial -->
        </div>
    </div>
    @include('admin.bottom_script')
</body>

</html>