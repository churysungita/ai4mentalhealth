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
                        <!-- Additional content if needed -->
                    </div>
                </div>

                <!-- Additional content if needed -->

            </div> <!-- page-content -->

        </div> <!-- page-wrapper -->

        <!-- partial:partials/_footer.html -->
        @include('admin.footer')
        <!-- partial -->

    </div> <!-- main-wrapper -->

    @include('admin.bottom_script')

</body>

</html>