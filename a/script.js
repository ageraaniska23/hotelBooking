// Fungsi untuk menghitung total bayar berdasarkan durasi menginap, tipe kamar, dan opsi sarapan
function hitungTotalBayar() {
  // Mengambil nilai durasi menginap dari input
  var durasiMenginap = parseInt(document.getElementById("durasiMenginap").value);
  
  // Mengambil nilai tipe kamar dari input
  var tipeKamar = document.getElementById("tipeKamar").value;
  
  // Menentukan apakah opsi sarapan dipilih
  var termasukBreakfast = document.getElementById("termasukBreakfast").checked;

  // Inisialisasi harga kamar
  var hargaKamar = 0;

  // Menentukan harga kamar berdasarkan tipe kamar
  switch (tipeKamar) {
      case "standar":
          hargaKamar = 300000;
          break;
      case "deluxe":
          hargaKamar = 750000;
          break;
      case "Exlusive": //EXECUTIVE ROOM
          hargaKamar = 1000000;
          break;
      default:
          hargaKamar = 0;
  }

  // Menghitung total bayar berdasarkan durasi menginap dan harga kamar
  var totalBayar = durasiMenginap * hargaKamar;

  // Memberikan diskon 10% jika durasi menginap lebih dari 3 hari
  if (durasiMenginap > 3) {
      totalBayar *= 0.9;
  }
  
   // Memberikan diskon 10% jika durasi menginap lebih dari 3 hari
   var diskonStatus = durasiMenginap > 3 ? "Ya" : "Tidak";
   document.getElementById("diskonStatus").value = diskonStatus;

  // Menambah biaya sarapan jika opsi sarapan dipilih
  if (termasukBreakfast) {
      totalBayar += 80000 * durasiMenginap;
  }

  // Menampilkan total bayar pada elemen dengan id "totalBayar"
  document.getElementById("totalBayar").value = parseFloat(totalBayar.toFixed(2));
}

// Fungsi untuk membatalkan pemesanan dengan mengreset formulir dan total bayar
function batalPesan() {
  // Mereset formulir pemesanan
  document.getElementById("bookingForm").reset();
  
  // Mengosongkan nilai total bayar
  document.getElementById("totalBayar").value = "";
}
