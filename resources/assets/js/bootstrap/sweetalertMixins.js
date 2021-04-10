window.PrequelSuccessToast = Swal.mixin({
    toast            : true,
    position         : "bottom",
    title            : "Success",
    type             : "success",
    showConfirmButton: false,
    timer: 3000,
});

window.PrequelErrorToast = Swal.mixin({
    toast            : true,
    position         : "bottom",
    title            : "Oops...",
    type             : "error",
    showConfirmButton: false,
    timer            : 3000,
    customClass      : "",
});
