/**
 * Customizer custom js
 */

jQuery(document).ready(function() {
   jQuery('.wp-full-overlay-sidebar-content').prepend('<div class="acme-ads"> <a href="http://www.acmethemes.com/themes/corporate-plus-pro/" class="button" target="_blank">{pro}</a></div>'.replace('{pro}',corporate_plus_customizer_js_obj.pro));
});