jQuery(document).ready(function() {
    jQuery('.tabs li a').on('click', function(e)  {
        var currentAttrValue = jQuery(this).attr('href');

        jQuery('.tabs ' + currentAttrValue).show().siblings().hide();
        jQuery(this).parent('li').addClass('selected').siblings().removeClass('selected');
        e.preventDefault();
    });

});