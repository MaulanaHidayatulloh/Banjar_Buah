document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("form-produk");
  const cancelButtonBuah = document.getElementById("cancel-btn-buah");
  const previewImageElement = document.getElementById("preview-gambar");

  // Fungsi untuk preview gambar
  window.previewImage = (event) => {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = (e) => {
        previewImageElement.style.display = "block";
        previewImageElement.src = e.target.result;
      };
      reader.readAsDataURL(file);
    } else {
      previewImageElement.style.display = "none";
    }
  };

  // Fungsi untuk reset form
  cancelButtonBuah.addEventListener("click", () => {
    form.reset();
    previewImageElement.style.display = "none";
    previewImageElement.src = "#";
  });

  // Fungsi untuk input stok dengan tombol "+" dan "–"
  const stokInput = document.getElementById("stok-produkBuah");
  const incrementBtn = document.getElementById("increment-btn");
  const decrementBtn = document.getElementById("decrement-btn");

  incrementBtn.addEventListener("click", () => {
    let value = parseFloat(stokInput.value) || 0;
    stokInput.value = (value + 0.1).toFixed(1); // Tambah 0.1
  });

  decrementBtn.addEventListener("click", () => {
    let value = parseFloat(stokInput.value) || 0;
    if (value > 0) {
      // Hindari nilai negatif
      stokInput.value = (value - 0.1).toFixed(1); // Kurangi 0.1
    }
  });
});
