document.addEventListener("DOMContentLoaded", function () {

  const userPhoto  = document.getElementById("userPhoto");
  const frameBox   = document.getElementById("frameBox");
  const frameWrap  = document.getElementById("frameBox"); // đo KHUNG THẬT
  const frames     = document.querySelectorAll(".frame-option");

  const sizeOptions = document.querySelectorAll(".size-option");
  const sizeInput   = document.getElementById("size_id"); // nếu có

  const BASE_WIDTH  = 320;
  const BASE_HEIGHT = 400;

  let imageRatio = null;

  /* ======================
     LẤY TỶ LỆ ẢNH
  ====================== */
  userPhoto.onload = function () {
    imageRatio = userPhoto.naturalWidth / userPhoto.naturalHeight;
  };

  /* ======================
     XÁC ĐỊNH ORIENTATION THEO KHUNG
  ====================== */
  function getFrameOrientation() {
    return frameWrap.offsetWidth >= frameWrap.offsetHeight
      ? "horizontal"
      : "vertical";
  }

  /* ======================
     FORCE REFLOW
  ====================== */
  function forceReflow() {
    frameWrap.getBoundingClientRect();
  }

  /* ======================
     HIỂN THỊ SIZE THEO KHUNG
  ====================== */
  function showSizesByFrame() {
    const orientation = getFrameOrientation();

    sizeOptions.forEach(size => {
      if (size.dataset.orientation === orientation) {
        size.style.display = "inline-block";
      } else {
        size.style.display = "none";
        size.classList.remove("active");
      }
    });
  }

  /* ======================
     CLICK SIZE → ACTIVE
  ====================== */
  sizeOptions.forEach(btn => {
    btn.addEventListener("click", function () {
      // bỏ active cũ
      sizeOptions.forEach(b => b.classList.remove("active"));

      // set active mới
      btn.classList.add("active");

      // set hidden input (nếu có)
      if (sizeInput) {
        sizeInput.value = btn.dataset.sizeId;
      }
    });
  });

  /* ======================
     CHỌN KHUNG
  ====================== */
  frames.forEach(frame => {
    frame.addEventListener("click", function () {

      frames.forEach(f => f.classList.remove("active"));
      frame.classList.add("active");

      const frameImage = frame.dataset.frameImage;
      frameBox.style.backgroundImage = `url(${frameImage})`;
      frameBox.style.backgroundSize = "100% 100%";

      openRatioModal();
    });
  });

  /* ======================
     FIT MODE
  ====================== */
  window.applyFit = function () {
    if (!imageRatio) return;

    let newW, newH;

    if (imageRatio > 1) {
      newW = BASE_WIDTH;
      newH = BASE_WIDTH / imageRatio;
    } else {
      newH = BASE_HEIGHT;
      newW = BASE_HEIGHT * imageRatio;
    }

    frameWrap.style.width  = `${newW}px`;
    frameWrap.style.height = `${newH}px`;
    userPhoto.style.objectFit = "contain";

    forceReflow();
    showSizesByFrame();
    closeRatioModal();
  };

  /* ======================
     CROP MODE
  ====================== */
  window.applyCrop = function () {
    frameWrap.style.width  = `${BASE_WIDTH}px`;
    frameWrap.style.height = `${BASE_HEIGHT}px`;
    userPhoto.style.objectFit = "cover";

    forceReflow();
    showSizesByFrame();
    closeRatioModal();
  };

  /* ======================
     MODAL
  ====================== */
  function openRatioModal() {
    document.getElementById("ratioModal").classList.add("show");
  }

  window.closeRatioModal = function () {
    document.getElementById("ratioModal").classList.remove("show");
  };

  /* ======================
     FRAME SLIDER (GIỮ NGUYÊN)
  ====================== */
  const track = document.getElementById("frameTrack");
  const viewport = document.querySelector(".frame-viewport");
  const prevBtn = document.getElementById("framePrev");
  const nextBtn = document.getElementById("frameNext");

  if (!track || !viewport || !prevBtn || !nextBtn) return;

  let position = 0;

  function getStep() {
    const item = track.querySelector(".frame-option");
    if (!item) return 0;

    const gap = parseInt(getComputedStyle(track).gap) || 0;
    return item.offsetWidth + gap;
  }

  function updateNavVisibility() {
    if (track.scrollWidth <= viewport.offsetWidth) {
      prevBtn.style.display = "none";
      nextBtn.style.display = "none";
    } else {
      prevBtn.style.display = "flex";
      nextBtn.style.display = "flex";
    }
  }

  function updateButtons() {
    prevBtn.disabled = position === 0;
    const maxScroll = track.scrollWidth - viewport.offsetWidth;
    nextBtn.disabled = Math.abs(position) >= maxScroll;
  }

  prevBtn.addEventListener("click", function () {
    position += getStep();
    position = Math.min(position, 0);
    track.style.transform = `translateX(${position}px)`;
    updateButtons();
  });

  nextBtn.addEventListener("click", function () {
    const maxScroll = track.scrollWidth - viewport.offsetWidth;
    position -= getStep();
    position = Math.max(position, -maxScroll);
    track.style.transform = `translateX(${position}px)`;
    updateButtons();
  });

  updateNavVisibility();
  updateButtons();

  window.addEventListener("resize", function () {
    position = 0;
    track.style.transform = "translateX(0)";
    updateNavVisibility();
    updateButtons();
  });

btnSticker.onclick = () => {
  stickerOverlay.style.display = "block";
};


  /* ==================================================
     3. CLICK STICKER → DÁN VÀO FRAME
  ================================================== */
  document.querySelectorAll(".sticker-item").forEach(img => {
    img.addEventListener("click", () => {

      // wrapper
      const wrapper = document.createElement("div");
      wrapper.className = "sticker-wrapper";
      wrapper.style.width = (img.dataset.size || 80) + "px";
      wrapper.style.top = "40px";
      wrapper.style.left = "40px";

      // image
      const sticker = document.createElement("img");
      sticker.src = img.src;
      sticker.className = "sticker-img";

      // remove
      const removeBtn = document.createElement("span");
      removeBtn.className = "sticker-remove";
      removeBtn.innerHTML = "✕";

      // resize handle
      const resizeHandle = document.createElement("span");
      resizeHandle.className = "sticker-resize";

      // append
      wrapper.appendChild(sticker);
      wrapper.appendChild(removeBtn);
      wrapper.appendChild(resizeHandle);
      frameBox.appendChild(wrapper);

      makeDraggable(wrapper);
      makeResizable(wrapper, resizeHandle);

      removeBtn.onclick = () => wrapper.remove();

      stickerOverlay.style.display = "none";
    });
  });

  /* ==================================================
     4. KÉO THẢ STICKER
  ================================================== */
  function makeDraggable(el) {
    let dragging = false;
    let offsetX = 0;
    let offsetY = 0;

    el.addEventListener("mousedown", e => {
      if (e.target.classList.contains("sticker-resize")) return;
      dragging = true;
      offsetX = e.clientX - el.offsetLeft;
      offsetY = e.clientY - el.offsetTop;
    });

    document.addEventListener("mousemove", e => {
      if (!dragging) return;
      el.style.left = (e.clientX - offsetX) + "px";
      el.style.top  = (e.clientY - offsetY) + "px";
    });

    document.addEventListener("mouseup", () => {
      dragging = false;
    });
  }

  /* ==================================================
     5. RESIZE STICKER BẰNG GÓC
  ================================================== */
  function makeResizable(el, handle) {
    let startX = 0;
    let startWidth = 0;

    handle.addEventListener("mousedown", e => {
      e.stopPropagation();
      startX = e.clientX;
      startWidth = el.offsetWidth;

      document.onmousemove = e => {
        const newWidth = startWidth + (e.clientX - startX);
        if (newWidth > 30) {
          el.style.width = newWidth + "px";
        }
      };

      document.onmouseup = () => {
        document.onmousemove = null;
        document.onmouseup = null;
      };
    });
  }
  
  const btnDone = this.getElementById("btnDoneSticker");


  btnDone.addEventListener("click", () => {
  document.querySelectorAll(
    ".sticker-remove, .sticker-resize, .sticker-handle"
  ).forEach(el => {
    el.classList.add("hidden");
  });
});
 
  document.addEventListener("click", e => {
  const wrapper = e.target.closest(".sticker-wrapper");
  if (!wrapper) return;

  wrapper.querySelectorAll(
    ".sticker-remove, .sticker-resize"
  ).forEach(el => {
    el.classList.remove("hidden");
  });
});
});

