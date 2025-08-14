<?php
// Đăng ký Option page và menu item
function ecentura_register_options_page()
{
    add_menu_page(
        'Ecentura Settings', // Tiêu đề trên menu
        'Ecentura Settings', // Tên menu
        'manage_options', // Quyền truy cập (thay đổi nếu cần)
        'ecentura-settings', // Slug của menu
        'ecentura_options_page_content', // Callback function hiển thị nội dung
        'dashicons-admin-generic', // Icon cho menu (thay đổi nếu cần)
        -1 // Độ ưu tiên, số càng nhỏ sẽ xuất hiện ở trên cùng
    );
}
add_action('admin_menu', 'ecentura_register_options_page');

//Đăng ký thư viện ảnh
function load_media_files()
{
    wp_enqueue_media();
}
add_action('admin_enqueue_scripts', 'load_media_files');

// Nội dung hiển thị trên Option page
function ecentura_options_page_content()
{
?>
    <div class="wrap">
        <h1>Ecentura Settings</h1>
        <form method="post" action="options.php">
            <?php
            // Hiển thị các trường và tùy chọn ở đây
            settings_fields('ecentura_options_group');
            do_settings_sections('ecentura-settings');
            submit_button();
            ?>
        </form>
    </div>
<?php
}

// Đăng ký các trường và tùy chọn trong Option page
function ecentura_register_settings()
{
    add_settings_field('ecentura_banner_header', 'Banner Header', 'ecentura_banner_header_callback', 'ecentura-settings', 'ecentura_settings_section');
    add_settings_field('ecentura_title_header', 'Title Header', 'ecentura_title_header_callback', 'ecentura-settings', 'ecentura_settings_section');
    add_settings_field('ecentura_subtitle_header', 'Sub Title Header', 'ecentura_subtitle_header_callback', 'ecentura-settings', 'ecentura_settings_section');
    add_settings_field('ecentura_text_header', 'Text Header', 'ecentura_text_header_callback', 'ecentura-settings', 'ecentura_settings_section');
    add_settings_field('ecentura_thumbnail_header', 'Thumbnail Header', 'ecentura_thumbnail_header_callback', 'ecentura-settings', 'ecentura_settings_section');
    add_settings_field('ecentura_image_scroll_section_post', 'Logo Scroll', 'ecentura_image_scroll_section_post_callback', 'ecentura-settings', 'ecentura_settings_section');
    add_settings_section('ecentura_settings_section', 'General Settings', 'ecentura_settings_section_callback', 'ecentura-settings');

    // Đăng ký các trường và tùy chọn với database
    register_setting('ecentura_options_group', 'ecentura_banner_header');
    register_setting('ecentura_options_group', 'ecentura_title_header');
    register_setting('ecentura_options_group', 'ecentura_subtitle_header');
    register_setting('ecentura_options_group', 'ecentura_text_header');
    register_setting('ecentura_options_group', 'ecentura_thumbnail_header');
    register_setting('ecentura_options_group', 'ecentura_image_scroll_section_post');
}
add_action('admin_init', 'ecentura_register_settings');

// Callback function hiển thị phần tiêu đề của section
function ecentura_settings_section_callback()
{
    echo 'This is the description for general settings section.';
}

// Callback function scroll_section_post
function ecentura_image_scroll_section_post_callback()
{
    $ecentura_image_scroll_section_post = get_option('ecentura_image_scroll_section_post');
?>
    <div class="image-preview-scroll_section_post" style=" max-width: 300px; margin-bottom: 10px; ">
        <?php if ($ecentura_image_scroll_section_post) : ?>
            <img src="<?php echo esc_url(wp_get_attachment_image_url($ecentura_image_scroll_section_post, 'full')); ?>" alt="Image Preview">
        <?php else : ?>
            No images
        <?php endif; ?>
    </div>
    <input type="hidden" name="ecentura_image_scroll_section_post" id="ecentura_image_scroll_section_post" value="<?php echo esc_attr($ecentura_image_scroll_section_post); ?>">
    <button type="button" class="button" id="ecentura_image_scroll_section_post-button">Choose Image</button>
    <button type="button" class="button" id="ecentura_image_scroll_section_post-remove">Remove Image</button>
    <style>
        .image-preview-scroll_section_post img {
            width: 100%;
        }

        td input {
            width: 100%;
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            // Xử lý sự kiện khi click nút 'Choose Image'
            $('#ecentura_image_scroll_section_post-button').on('click', function() {
                var customUploader = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });

                customUploader.on('select', function() {
                    var attachment = customUploader.state().get('selection').first().toJSON();
                    $('#ecentura_image_scroll_section_post').val(attachment.id);
                    $('.image-preview-scroll_section_post').html('<img src="' + attachment.url + '" alt="Image Preview">');
                });

                customUploader.open();
            });

            // Xử lý sự kiện khi click nút 'Remove Image'
            $('#ecentura_image_scroll_section_post-remove').on('click', function() {
                $('#ecentura_image_scroll_section_post').val('');
                $('.image-preview-scroll_section_post').html('');
            });
        });
    </script>

<?php
}

// Callback function banner_header
function ecentura_banner_header_callback()
{
    $ecentura_banner_header = get_option('ecentura_banner_header');
?>
    <div class="image-preview-banner_header" style=" max-width: 300px; margin-bottom: 10px; ">
        <?php if ($ecentura_banner_header) : ?>
            <img src="<?php echo esc_url(wp_get_attachment_image_url($ecentura_banner_header, 'full')); ?>" alt="Image Preview">
        <?php else : ?>
            No images
        <?php endif; ?>
    </div>
    <input type="hidden" name="ecentura_banner_header" id="ecentura_banner_header" value="<?php echo esc_attr($ecentura_banner_header); ?>">
    <button type="button" class="button" id="ecentura_banner_header-button">Choose Image</button>
    <button type="button" class="button" id="ecentura_banner_header-remove">Remove Image</button>
    <style>
        .image-preview-banner_header img {
            width: 100%;
        }

        td input {
            width: 100%;
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            // Xử lý sự kiện khi click nút 'Choose Image'
            $('#ecentura_banner_header-button').on('click', function() {
                var customUploader = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });

                customUploader.on('select', function() {
                    var attachment = customUploader.state().get('selection').first().toJSON();
                    $('#ecentura_banner_header').val(attachment.id);
                    $('.image-preview-banner_header').html('<img src="' + attachment.url + '" alt="Image Preview">');
                });

                customUploader.open();
            });

            // Xử lý sự kiện khi click nút 'Remove Image'
            $('#ecentura_banner_header-remove').on('click', function() {
                $('#ecentura_banner_header').val('');
                $('.image-preview-banner_header').html('');
            });
        });
    </script>

<?php
}

// Callback function scroll_section_post
function ecentura_thumbnail_header_callback()
{
    $ecentura_thumbnail_header = get_option('ecentura_thumbnail_header');
?>
    <div class="image-preview-thumbnail_header" style=" max-width: 300px; margin-bottom: 10px; ">
        <?php if ($ecentura_thumbnail_header) : ?>
            <img src="<?php echo esc_url(wp_get_attachment_image_url($ecentura_thumbnail_header, 'full')); ?>" alt="Image Preview">
        <?php else : ?>
            No images
        <?php endif; ?>
    </div>
    <input type="hidden" name="ecentura_thumbnail_header" id="ecentura_thumbnail_header" value="<?php echo esc_attr($ecentura_thumbnail_header); ?>">
    <button type="button" class="button" id="ecentura_thumbnail_header-button">Choose Image</button>
    <button type="button" class="button" id="ecentura_thumbnail_header-remove">Remove Image</button>
    <style>
        .image-preview-thumbnail_header img {
            width: 100%;
        }

        td input {
            width: 100%;
        }
    </style>
    <script>
        jQuery(document).ready(function($) {
            // Xử lý sự kiện khi click nút 'Choose Image'
            $('#ecentura_thumbnail_header-button').on('click', function() {
                var customUploader = wp.media({
                    title: 'Choose Image',
                    button: {
                        text: 'Choose Image'
                    },
                    multiple: false
                });

                customUploader.on('select', function() {
                    var attachment = customUploader.state().get('selection').first().toJSON();
                    $('#ecentura_thumbnail_header').val(attachment.id);
                    $('.image-preview-thumbnail_header').html('<img src="' + attachment.url + '" alt="Image Preview">');
                });

                customUploader.open();
            });

            // Xử lý sự kiện khi click nút 'Remove Image'
            $('#ecentura_thumbnail_header-remove').on('click', function() {
                $('#ecentura_thumbnail_header').val('');
                $('.image-preview-thumbnail_header').html('');
            });
        });
    </script>

<?php
}

// Text header
function ecentura_title_header_callback()
{
    $option_title_header = get_option('ecentura_title_header');
    echo '<textarea name="ecentura_title_header" rows="1" style="width: 100%;">' . esc_textarea($option_title_header) . '</textarea>';
}
function ecentura_subtitle_header_callback()
{
    $option_subtitle_header = get_option('ecentura_subtitle_header');
    echo '<textarea name="ecentura_subtitle_header" rows="1" style="width: 100%;">' . esc_textarea($option_subtitle_header) . '</textarea>';
}
function ecentura_text_header_callback()
{
    $option_text_header = get_option('ecentura_text_header');
    echo '<textarea name="ecentura_text_header" rows="5" style="width: 100%;">' . esc_textarea($option_text_header) . '</textarea>';
}


//3. Lấy dữ liệu từ các theme option
//Lấy trường theo key, ví dụ:
// $ecentura_text_header = get_option('ecentura_text_header');
// echo 'Điện thoại: ' .$tm_custom_privacy_hotline;
// $ecentura_facebook = get_option('ecentura_facebook');
// echo 'Email: ' .$tm_custom_privacy_hotline;
// $ecentura_image_payment = get_option('ecentura_image_payment');
// echo wp_get_attachment_image($ecentura_image_payment, 'full');