<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script type="text/javascript" src="../assets/js/jquery-3.3.1.slim.min.js" ></script>
    <script type="text/javascript" src="../assets/js/popper.min.js" ></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  </body>
</html>

<script type="text/javascript">
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>

<script type="text/javascript">

function confirm_archive(event, url) {
  event.preventDefault(); // Prevent the default action (navigation)

  Swal.fire({
    title: '<span style="color: #800000;">Are you sure?</span>', // Maroon color for title
    text: 'Do you want to archive this record?',
    icon: 'warning',
    background: '#fffef0', // Cream background color
    color: '#000000', // Black text color for contrast
    showCancelButton: true,
    confirmButtonColor: '#deb887', // Burlywood color for confirm button background
    cancelButtonColor: '#800000', // Maroon color for cancel button background
    confirmButtonText: 'Yes, archive it!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      // If confirmed, proceed to the archive action by redirecting to the URL
      window.location.href = url;
    }
  });
}

function confirm_restore(event, url) {
  event.preventDefault(); // Prevent the default action (navigation)

  Swal.fire({
    title: '<span style="color: #800000;">Are you sure?</span>', // Maroon color for title
    text: 'Do you want to restore this record?',
    icon: 'question',
    background: '#fffef0', // Cream background color
    color: '#000000', // Black text color for contrast
    showCancelButton: true,
    confirmButtonColor: '#deb887', // Burlywood color for confirm button background
    cancelButtonColor: '#800000', // Maroon color for cancel button background
    confirmButtonText: 'Yes, restore it!',
    cancelButtonText: 'Cancel'
  }).then((result) => {
    if (result.isConfirmed) {
      // If confirmed, proceed to the restore action by redirecting to the URL
      window.location.href = url;
    }
  });
}

function confirm_delete(event, url) {
    event.preventDefault(); // Prevent the default action of the link

    // First confirmation dialog for deletion
    Swal.fire({
        title: '<span style="color: #800000;">Are you sure?</span>', // Maroon color for title
        text: "You won't be able to revert this!",
        icon: 'warning',
        background: '#fffef0', // Cream background color
        color: '#000000', // Black text color for contrast
        showCancelButton: true,
        confirmButtonColor: 'burlywood', // Burlywood color for confirm button background
        cancelButtonColor: '#630707', // Maroon color for cancel button background
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Show the password verification modal
            approveRequest(url); // Pass the URL to the approveRequest function
        }
    });
}
</script>

<style>
    /* CSS to remove the default outline from SweetAlert2 buttons */
    .swal2-confirm,
    .swal2-cancel {
        outline: none !important; /* Remove the default focus outline */
    }
    .swal2-cancel:hover {
    background-color: #793232 !important; /* Hover color */
    color: white;
    }
    .swal2-confirm:hover {
      background-color: #e6c59c !important; /* Hover color */
    }
    /* Remove any box-shadow or border if needed */
    .swal2-confirm,
    .swal2-cancel {
        border: none !important; /* Remove border */
        box-shadow: none !important; /* Remove box-shadow */
    }

    
</style>
