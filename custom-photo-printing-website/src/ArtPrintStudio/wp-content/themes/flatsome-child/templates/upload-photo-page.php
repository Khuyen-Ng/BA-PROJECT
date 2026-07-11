<?php
/*
Template Name: Upload Photo Page
*/
get_header();
?>

<div class="container" style="max-width:800px; padding:40px 0;">

    <h2 class="uppercase">Upload Ảnh</h2>

    <form method="post" enctype="multipart/form-data" class="form-flat">
        <input type="file" name="pp_photo" id="pp_photo_input" accept="image/*" required>

        <!-- PREVIEW KHUNG -->
        <div id="pp_frame_preview" style="margin-top:20px; display:none;">
            <div style="
                width: 250px;
                height: 250px;
                background-image: url('https://cdn-media.sforum.vn/storage/app/media/thanhhuyen/khung%20%E1%BA%A3nh/1/khung-anh-15.jpg');
                background-size: cover;
                background-position: center;
                padding: 18px;
                box-sizing: border-box;
                margin-bottom: 15px;">
                
                <img id="pp_photo_frame_img" style="
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 6px;">
            </div>
        </div>

        <button type="submit" name="pp_upload_photo" class="button primary">
            Upload
        </button>
    </form>

    <script>
    document.getElementById("pp_photo_input").addEventListener("change", function (event) {
        const file = event.target.files[0];
        if (!file) return;

        const img = document.getElementById("pp_photo_frame_img");
        const box = document.getElementById("pp_frame_preview");

        img.src = URL.createObjectURL(file);
        box.style.display = "block";
    });
    </script>

    <hr>

    <h3 class="uppercase">Thư viện ảnh của bạn</h3>
    <?php echo do_shortcode('[pp_photo_library]'); ?>

</div>

<?php get_footer(); ?>
