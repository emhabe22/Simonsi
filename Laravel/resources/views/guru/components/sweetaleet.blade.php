{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

{{-- Notifikasi sukses --}}
@if(session('success'))
<script>
Swal.fire({
  icon: 'success',
  title: 'Berhasil!',
  text: '{{ session('success') }}',
  timer: 2000,
  showConfirmButton: false
});
</script>
@endif

{{-- Notifikasi error --}}
@if(session('error'))
<script>
Swal.fire({
  icon: 'error',
  title: 'Gagal!',
  text: '{{ session('error') }}',
});
</script>
@endif
