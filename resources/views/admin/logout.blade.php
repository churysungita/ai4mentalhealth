<!-- resources/views/admin/logout.blade.php -->

<form id="logoutForm" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
    @csrf <!-- Add CSRF token for security -->
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Trigger the logout form submission on document load
        $('#logoutForm').submit();
    });
</script>
