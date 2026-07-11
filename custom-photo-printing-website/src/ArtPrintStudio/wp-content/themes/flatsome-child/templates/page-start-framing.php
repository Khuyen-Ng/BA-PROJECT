<?php
/* Template Name: Start Framing */
get_header();
?>

<div class="sf-wrapper">

    <!-- TOP BAR -->
    <div class="sf-top">
        <a href="/" class="sf-back">← BACK</a>
    </div>

    <div class="sf-body">

        <!-- LEFT STEP -->
        <div class="sf-sidebar">
            <div class="sf-step active">Add Photos</div>
            <div class="sf-step">Edit Photos & Layout</div>
            <div class="sf-step">Order</div>
        </div>

        <!-- MAIN CONTENT -->
        <div class="sf-content">
            <div class="sf-upload-card">

               <div class="sf-upload-preview">
    <img id="previewImage" style="display:none;">
    <span id="uploadIcon">⬆</span>
</div>

                <div class="sf-upload-info">
                    <h3>Your photo is ready</h3>
                    <p>Upload and preview your photo before customizing the frame.</p>

                    <input type="file" id="photoUpload" accept="image/*">

                    <button id="previewBtn" class="sf-preview-btn">
                        Preview
                    </button>
                </div>

            </div>

            <div class="sf-footer">
                <button 
    id="customizeBtn"
    class="sf-customize-btn"
    data-customize-url="<?php echo esc_url( get_permalink( get_page_by_path('customize') ) ); ?>">
    Customize
</button>
            </div>
        </div>

    </div>
    <!-- IMAGE PREVIEW MODAL -->
<div id="imageModal" class="sf-modal">
    <div class="sf-modal-content">
        <button id="deleteImageBtn" class="sf-delete-btn">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/icons/trash.svg" alt="Delete">
</button>
        <img id="modalImage">
    </div>
</div>
</div>

<?php get_footer(); ?>
