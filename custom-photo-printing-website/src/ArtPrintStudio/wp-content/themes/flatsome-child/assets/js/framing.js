document.addEventListener("DOMContentLoaded", function () {
  /* =========================
     UPLOAD PAGE
  ========================== */
  const fileInput = document.getElementById("photoUpload");
  const previewImg = document.getElementById("previewImage");
  const uploadIcon = document.getElementById("uploadIcon");
  const customizeBtn = document.getElementById("customizeBtn");

  const modal = document.getElementById("imageModal");
  const modalImg = document.getElementById("modalImage");
  const deleteBtn = document.getElementById("deleteImageBtn");

  // Upload + preview ảnh
  if (fileInput && previewImg) {
    fileInput.addEventListener("change", function () {
      const file = this.files[0];
      if (!file) return;

      const reader = new FileReader();
      reader.onload = function (e) {
        previewImg.src = e.target.result;
        previewImg.style.display = "block";
        if (uploadIcon) uploadIcon.style.display = "none";

        localStorage.setItem("uploadedPhoto", e.target.result);
      };
      reader.readAsDataURL(file);
    });
  }

  // Click ảnh → mở modal
  if (previewImg && modal && modalImg) {
    previewBtn.addEventListener("click", function () {
      modalImg.src = previewImg.src;
      modal.classList.add("show");
    });
  }

  // Click nền modal → đóng
  if (modal) {
    modal.addEventListener("click", function (e) {
      if (e.target === modal) modal.classList.remove("show");
    });
  }

  // Xoá ảnh
  if (deleteBtn) {
    deleteBtn.addEventListener("click", function () {
      previewImg.src = "";
      previewImg.style.display = "none";
      if (uploadIcon) uploadIcon.style.display = "block";
      if (fileInput) fileInput.value = "";

      localStorage.removeItem("uploadedPhoto");
      if (modal) modal.classList.remove("show");
    });
  }

  // Customize → sang trang Edit
  if (customizeBtn) {
    customizeBtn.addEventListener("click", function () {
      const photo = localStorage.getItem("uploadedPhoto");
      if (!photo) {
        alert("Please upload a photo first");
        return;
      }

      const targetUrl = customizeBtn.dataset.customizeUrl;
      if (!targetUrl) {
        alert("Customize page not found");
        return;
      }

      window.location.href = targetUrl;
    });
  }
  document.addEventListener("DOMContentLoaded", function () {
    const previewImg = document.getElementById("previewImage");
    const uploadIcon = document.getElementById("uploadIcon");

    const savedPhoto = localStorage.getItem("uploadedPhoto");

    if (savedPhoto && previewImg) {
      previewImg.src = savedPhoto;
      previewImg.style.display = "block";

      if (uploadIcon) uploadIcon.style.display = "none";
    }
  });

  /* =========================
   CUSTOMIZE PAGE
========================== */

  const img = document.getElementById("userPhoto");

  // 1️⃣ ƯU TIÊN ẢNH TỪ SAVED CREATION (DB)
  if (window.SAVED_PHOTO_URL) {
    img.src = window.SAVED_PHOTO_URL;
    console.log("Load photo from Saved Creation:", window.SAVED_PHOTO_URL);
  }

  // 2️⃣ NẾU KHÔNG CÓ → LẤY TỪ LOCALSTORAGE
  else {
    const localPhoto = localStorage.getItem("uploadedPhoto");
    if (localPhoto) {
      img.src = localPhoto;
      console.log("Load photo from LocalStorage");
    } else {
      alert("No photo found");
    }
  }
  const materialOptions = document.querySelectorAll(".material-option");
  let selectedMaterial = "canvas";

  materialOptions.forEach((option) => {
    option.addEventListener("click", () => {
      materialOptions.forEach((o) => o.classList.remove("active"));
      option.classList.add("active");

      selectedMaterial = option.dataset.material;
    });
  });

  const frameBox = document.getElementById("frameBox");

  // const photo = localStorage.getItem("uploadedPhoto");t
  /*if (!photo) {
    alert("Please upload a photo first.");
    window.location.href = "/start-framing";
    return;
  }
*/
  // img.src = photo;t

  /* =====================
     STATE
  ===================== */
  let rotation = 0;
  let brightness = 1;
  let bw = 0;
  let scale = 1;
  const MIN_SCALE = 0.5;
  const MAX_SCALE = 2.5;
  const SCALE_STEP = 0.1;

  // ===== PRICE STATE =====
  let selectedFrameId = null;
  let selectedSizeId = null;
  let selectedFrameName = "";
  let selectedSizeName = "";
  let framePrice = 0;
  let sizeFactor = 1;

  /* =====================
     APPLY EFFECT
  ===================== */
  function applyEffects() {
    img.style.transform = `
    scale(${scale})
    rotate(${rotation}deg)
  `;
    img.style.filter = `brightness(${brightness}) grayscale(${bw}%)`;
  }
  function updateSummary() {
    const summaryText = document.getElementById("summaryText");
    const summaryPrice = document.getElementById("summaryPrice");

    if (!selectedFrameId) return;

    const total = Math.round(framePrice * (sizeFactor || 1));

    summaryText.innerHTML = `
    Frame: <strong>${selectedFrameName}</strong><br>
    Size: <strong>${selectedSizeName || "—"}</strong>
  `;

    summaryPrice.innerText = total.toLocaleString() + " ₫";
  }

  /* =====================
     TOOLS
  ===================== */
  document.querySelectorAll(".tool-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const tool = btn.dataset.tool;

      switch (tool) {
        case "rotate":
          rotation = (rotation + 90) % 360;
          applyEffects();
          break;

        case "brighten":
          showSlider("brighten");
          break;

        case "bw":
          showSlider("bw");
          break;

        case "plus":
          scale = Math.min(scale + SCALE_STEP, MAX_SCALE);
          applyEffects();
          break;

        case "minus":
          scale = Math.max(scale - SCALE_STEP, MIN_SCALE);
          applyEffects();
          break;

        case "remove":
          if (confirm("Xoá ảnh và quay lại Start Framing?")) {
            localStorage.removeItem("uploadedPhoto");
            window.location.href = "/artprintstudio/start-framing";
          }
          break;
      }
    });
  });

  /* =====================
     SLIDERS
  ===================== */
  function showSlider(type) {
    document.querySelectorAll(".slider-group").forEach((g) => {
      g.style.display = g.dataset.slider === type ? "block" : "none";
    });
  }

  document
    .getElementById("brightnessSlider")
    ?.addEventListener("input", (e) => {
      brightness = e.target.value;
      applyEffects();
    });

  document.getElementById("bwSlider")?.addEventListener("input", (e) => {
    bw = e.target.value;
    applyEffects();
  });

  /* =====================
     FRAME SELECT
  ===================== */
  // document.querySelectorAll(".frame-option").forEach((opt) => {
  //   opt.addEventListener("click", () => {
  //     document
  //       .querySelectorAll(".frame-option")
  //       .forEach((o) => o.classList.remove("active"));

  //     opt.classList.add("active");

  //     frameBox.style.backgroundImage = `url('${opt.dataset.frameImage}')`;
  //   });
  // });
  // const photoIdInput = document.getElementById("photo_id");
  // const storedPhotoId = localStorage.getItem("photo_id");

  // if (photoIdInput && storedPhotoId) {
  //   photoIdInput.value = storedPhotoId;
  // }

  // frame select → set frame_id
  document.querySelectorAll(".frame-option").forEach((opt) => {
    opt.addEventListener("click", () => {
      document
        .querySelectorAll(".frame-option")
        .forEach((o) => o.classList.remove("active"));

      opt.classList.add("active");

      frameBox.style.backgroundImage = `url('${opt.dataset.frameImage}')`;

      // ===== SET FRAME =====
      selectedFrameId = opt.dataset.frameId;
      selectedFrameName = opt.dataset.frameName;

      framePrice = parseFloat(opt.dataset.price);

      console.log("Frame price:", framePrice); // 👈 test
      document.getElementById("frame_id").value = selectedFrameId;

      updateSummary();
    });
  });
  document.querySelectorAll(".size-option").forEach((btn) => {
    btn.addEventListener("click", () => {
      document
        .querySelectorAll(".size-option")
        .forEach((b) => b.classList.remove("active"));

      btn.classList.add("active");

      selectedSizeId = btn.dataset.sizeId;
      selectedSizeName = btn.dataset.sizeName;
      sizeFactor = parseFloat(btn.dataset.factor);

      console.log("Frame price:", sizeFactor); // 👈 test
      document.getElementById("size_id").value = selectedSizeId;

      updateSummary();
    });
  });
  document.querySelector(".sf-save").addEventListener("click", () => {
    document.getElementById("saveModal").classList.add("show");
  });

  document.getElementById("confirmSave").addEventListener("click", async () => {
    const name = document.getElementById("creationName").value.trim();
    if (!name) {
      alert("Enter name");
      return;
    }

    const imageData = localStorage.getItem("uploadedPhoto");

    const fd = new FormData();
    fd.append("action", "save_creation");
    fd.append("image_data", imageData);
    fd.append("creation_name", name);

    const res = await fetch("/artprintstudio/wp-admin/admin-ajax.php", {
      method: "POST",
      body: fd,
    });

    const json = await res.json();

    if (json.success) {
      alert("Saved!");
      document.getElementById("photo_id").value = json.photo_id;
      document.getElementById("saveModal").classList.remove("show");
    } else {
      alert("Save failed");
    }
  });
});
