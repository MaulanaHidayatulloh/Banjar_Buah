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
});
