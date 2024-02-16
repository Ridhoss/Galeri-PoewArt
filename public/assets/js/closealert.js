const alertElement = document.querySelector(".alert");
alertElement.classList.add("show");

// Set timeout untuk menutup alert setelah 1 detik
setTimeout(() => {
    // Tambahkan animasi fade out
    alertElement.classList.remove("show");
    alertElement.classList.add("fade");

    // Tunggu animasi fade out selesai, lalu hilangkan alert dari DOM
    setTimeout(() => {
        alertElement.remove();
    }, 3000); // Ubah angka timeout sesuai kebutuhan durasi animasi fade out
}, 2000); // Ubah angka timeout sesuai kebutuhan waktu tampilan alert
