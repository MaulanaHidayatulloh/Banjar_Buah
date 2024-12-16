// Fungsi Kasir

$(document).ready(function () {
  let cart = [];
  let totalHarga = 0;

  // Fungsi untuk memperbarui tabel keranjang
  function updateCartTable() {
    const cartBody = $("#cart-body");
    cartBody.empty();
    cart.forEach((item) => {
      cartBody.append(`
                <tr>
                    <td class="td-nama-buah">${item.namaBuah}</td>
                    <td>${item.jumlahBeli} Kg</td>
                    <td class="td-sub-total">Rp ${item.harga.toLocaleString(
                      "id-ID"
                    )}</td>
                </tr>
            `);
    });
    $("#total-harga").text(`Rp ${totalHarga.toLocaleString("id-ID")}`);
  }

  // Fungsi untuk tombol Cancel
  $("#cancel-btn").click(function () {
    $("#nama-buah").val("");
    $("#jumlah-beli").val("");
  });

  // Tambah item ke keranjang
  $("#tambah-btn").click(function () {
    const namaBuah = $("#nama-buah").val();
    const jumlahBeli = parseFloat($("#jumlah-beli").val());

    if (!namaBuah || jumlahBeli <= 0) {
      alert("Nama buah dan jumlah beli harus valid!");
      return;
    }

    // Ajax untuk mendapatkan harga produk dari server
    $.ajax({
      url: "get_harga.php",
      type: "POST",
      data: { nama_buah: namaBuah },
      dataType: "json",
      success: function (data) {
        const harga = parseFloat(data.harga);
        const subtotal = harga * jumlahBeli;

        // Tambah ke keranjang
        cart.push({
          namaBuah,
          jumlahBeli,
          harga: subtotal,
        });
        totalHarga += subtotal;
        updateCartTable();
        $("#jumlah-beli").val("");
      },
      error: function () {
        alert("Gagal mendapatkan harga produk!");
      },
    });
  });

  // Proses pembelian
  $("#beli-btn").click(function () {
    if (cart.length === 0) {
      alert("Keranjang masih kosong!");
      return;
    }

    $.ajax({
      url: "proses_beli.php",
      type: "POST",
      data: { cart: JSON.stringify(cart) },
      success: function (response) {
        alert("Pembelian berhasil!");
        cart = [];
        totalHarga = 0;
        updateCartTable();
      },
      error: function () {
        alert("Gagal memproses pembelian!");
      },
    });
  });
});

// ---------------------  batas ----------------------

// fungsi max jumlah beli

$(document).ready(function () {
  // Ketika nama buah dipilih
  $("#nama-buah").on("change", function () {
    var selectedOption = $(this).find("option:selected");
    var stok = selectedOption.data("stok");

    // Menetapkan max pada input jumlah-beli sesuai stok
    if (stok > 0) {
      $("#jumlah-beli").attr("max", stok);
    } else {
      $("#jumlah-beli").attr("max", 0);
    }
  });

  // Menambahkan event listener pada input jumlah-beli
  $("#jumlah-beli").on("input", function () {
    var maxStok = $(this).attr("max");
    var currentValue = parseFloat($(this).val());

    // Jika nilai input lebih besar dari max, set nilai input menjadi max
    if (currentValue > maxStok) {
      $(this).val(maxStok);
    }
  });
});

// ---------------------  batas ----------------------
