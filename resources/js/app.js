import "./bootstrap";
import Swal from "sweetalert2";
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.default.css";

window.Swal = Swal;
window.TomSelect = TomSelect;

window.Toast = Swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
});

// Sweet Alert 2
window.deleteSwal = (event) => {
    Swal.fire({
        title: "Lakukan Penghapusan Data ?",
        text: "Data terhapus tidak dapat di-pulihkan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dd3333",
        cancelButtonColor: "#666666",
        confirmButtonText: "Ya, Hapus Data!",
        cancelButtonText: "Batalkan Aksi",
    }).then((result) => {
        if (result.isConfirmed) {
            event && event();
        }
    });
};

window.verifySwal = (event) => {
    Swal.fire({
        title: "Ajukan Verifikasi Data ?",
        text: "Data Yang di-Ajukan Tidak Dapat di-Ubah Informasinya!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#4f46e5",
        cancelButtonColor: "#666666",
        confirmButtonText: "Ya, Lakukan Pengajuan!",
        cancelButtonText: "Batalkan Aksi",
    }).then((result) => {
        if (result.isConfirmed) {
            event && event();
        }
    });
};
