/* Small UI enhancements: count-up and slide caption helpers */
(function($){
    // format numbers into compact form (k/m)
    function formatCompact(n){
        if (n >= 1000000) return (n/1000000).toFixed(1).replace(/\.0$/, '') + 'm';
        if (n >= 1000) return (n/1000).toFixed(1).replace(/\.0$/, '') + 'k';
        return String(n);
    }

    // Count-up animation for elements with .count-number (data-count attr)
    function runCountUp($el){
        var target = parseInt($el.attr('data-count')) || 0;
        $el.text('0');
        $({count:0}).animate({count: target}, {
            duration: 1000,
            easing: 'swing',
            step: function(now){ $el.text(Math.floor(now)); },
            complete: function(){ $el.text(formatCompact(target)); }
        });
    }

    // Expose a function to animate all count numbers on the page
    window.animateCounts = function(){
        $('.count-number').each(function(){ runCountUp($(this)); });
    };

    // Reveal active slide captions using callbacks (no polling)
    window.revealActiveCaptions = function(context){
        var $context = context ? $(context) : $('.flexslider');
        $context.find('.slides li').each(function(){
            var $li = $(this);
            if ($li.hasClass('flex-active-slide')){
                $li.find('.caption').addClass('caption-visible');
            } else {
                $li.find('.caption').removeClass('caption-visible');
            }
        });
    };

    // Auto-run counts when DOM ready
    $(function(){ window.animateCounts(); });

})(jQuery);
