$(".delete-confirm").click(function (event) {
    var form = $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
        title: "Kamu Yakin?",
        text: "Kamu yakin ingin menghapus ini",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya,Hapus ini!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});