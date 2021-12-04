<script>
    @if(Session::has('success'))
    Swal.fire({
        position: 'top-start',
        type: 'success',
        title: '{{ session()->get('success') }}',
        showConfirmButton: false,
        timer: 1500,
        confirmButtonClass: 'btn btn-primary',
        buttonsStyling: false,
    })
    @endif
</script>
