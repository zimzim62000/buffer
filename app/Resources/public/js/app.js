(function ($) {
    $(document).ready(function(){
        initAccordion();
    });
})(jQuery);


function initAccordion(){
    $('div.zimzim-accordion').each(function(i, div){
        var $div = $(div);
        var divHeight = $div.css('height');
        var $h3title = $('div.title-accordion', $div);
        var titleHeight =  $h3title.css('height');
        $div.attr('minHeight', titleHeight);
        $div.attr('maxHeight', divHeight);
        $div.css('height', titleHeight);
        $h3title.on('click', function(){
            var $this = $(this).parent();
            if($this.hasClass('active')){
                $this.css('height', $this.attr('minHeight'));
                $this.removeClass('active');
            }else{
                $this.css('height', $this.attr('maxHeight'));
                $this.addClass('active');
            }
        });
    });
}