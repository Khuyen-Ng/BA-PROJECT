document.addEventListener("DOMContentLoaded", function () {
  /* ========= DELETE ========= */
  document.querySelectorAll(".del").forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();

      if (!confirm("Delete this creation?")) return;

      const photoId = this.dataset.id;
      const card = this.closest(".saved-card");

      const fd = new FormData();
      fd.append("action", "delete_creation");
      fd.append("photo_id", photoId);

      fetch(ajaxurl, {
        method: "POST",
        body: fd,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            card.remove();
          } else {
            alert("Delete failed");
          }
        });
    });
  });

  /* ========= DUPLICATE ========= */
  document.querySelectorAll(".dup").forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();

      const photoId = this.dataset.id;

      const fd = new FormData();
      fd.append("action", "duplicate_creation");
      fd.append("photo_id", photoId);

      fetch(ajaxurl, {
        method: "POST",
        body: fd,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.success) {
            location.reload(); // đơn giản nhất
          } else {
            alert("Duplicate failed");
          }
        });
    });
  });
});
