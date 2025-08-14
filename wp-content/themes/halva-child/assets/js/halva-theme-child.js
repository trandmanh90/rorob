jQuery(document).ready(function($) {
    $('.bwp-nav .toggle-main-navigation img').click(function() {
        $('.bwp-nav .box-nav').addClass('active');
    });
    $('.bwp-nav .btn-close').click(function() {
        $('.bwp-nav .box-nav').removeClass('active');
    });
});
