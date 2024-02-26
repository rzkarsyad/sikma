document.addEventListener("DOMContentLoaded", function() {
    // Mendapatkan elemen input tanggal mulai dan tanggal selesai
    var tanggalMulai = document.getElementById('tanggal_mulai');
    var tanggalSelesai = document.getElementById('tanggal_selesai');

    // Fungsi untuk mengatur nilai minimal tanggal selesai dan memperbarui nilainya jika diperlukan
    function setMinDateAndValue() {
        // Mengatur nilai minimal tanggal selesai menjadi tanggal mulai yang dipilih
        tanggalSelesai.min = tanggalMulai.value;
        
        // Jika tanggal selesai sebelum tanggal mulai, atur nilainya menjadi tanggal mulai
        if (new Date(tanggalSelesai.value) < new Date(tanggalMulai.value)) {
            tanggalSelesai.value = tanggalMulai.value;
        }
    }

    // Menambahkan event listener ke input tanggal mulai
    tanggalMulai.addEventListener('change', function() {
        setMinDateAndValue(); // Memanggil fungsi setMinDateAndValue saat tanggal mulai berubah
    });

    // Memanggil fungsi setMinDateAndValue saat halaman dimuat untuk pertama kalinya
    setMinDateAndValue();
});
