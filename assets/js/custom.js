(function($) {

/*
 *  Custom jQuery Functions (CjqF) v1.1
 *  Defined Custom jQuery Functions used commonly in most project which will be helpful
 *  http://www.manjunathg.com/
 *
 *  Made by Manjunath G
 *  Under MIT License
 */


    //Scroll Into Element    
    $.fn.scrollIntoElem = function(options) {
        var settings = $.extend({
        	add : 0,
        	sub : 0,
            speed : 500
        }, options);

        return this.each(function() {
            _offset = $(this).offset().top + settings.add - settings.sub;
        	$('html, body').animate({
                    scrollTop: _offset
			},settings.speed);	
        });
    }

    //Notification Toggler
    $.fn.notify = function(options) {
        var settings = $.extend({
            triggerEl : ".notify-btn",
            container : ".notifies-container",
            toggleClass : "active",
            closeEl : ".back"
        }, options);

        return this.each(function() {

            var triggerEl = $(this).find(settings.triggerEl),
                container = $(this).find(settings.container),
                toggleClass = settings.toggleClass,
                closeEl = $(this).find(settings.closeEl);

            triggerEl.click(function () { 
                container.toggleClass(toggleClass); 
            });
            closeEl.click(function () { 
                container.removeClass(toggleClass); 
            });
        });
    }


    //Grid info viewer
    $.fn.gridder = function(options) {

        return this.each(function() {

            var $grid = $(this);
            var $cell = $grid.find('.image__cell');
            var $infoViewer = $cell.find(".image--basic");
            var $infoCloseBtn = $cell.find('.expand__close');

            $infoViewer.click(function() {
                var $thisCell = $(this).closest('.image__cell');            
                $thisCell.scrollIntoElem(); 
                if ($thisCell.hasClass('is-collapsed')) {
                    $cell.not($thisCell).removeClass('is-expanded').addClass('is-collapsed');
                    $thisCell.removeClass('is-collapsed').addClass('is-expanded');
                    $grid.addClass("has-expanded");
                } else {
                    $thisCell.removeClass('is-expanded').addClass('is-collapsed');
                    $grid.removeClass("has-expanded")
                }
            });
            $infoCloseBtn.click(function(e){     
                e.preventDefault();           
                var $thisCell = $(this).closest('.image__cell');                      
                $thisCell.removeClass('is-expanded').addClass('is-collapsed');
                $grid.removeClass("has-expanded")
            });

        });
    }

    //Click Counter 
    $.fn.treeCounts = function(options) {

        var settings = $.extend({
            initValue : 1,
            plusEl : ".plus",
            minusEl : ".minus",
            treeRate : 999,
            rateEl : ".total-fee .rate"
        }, options);

        return this.each(function() {
            var input = $(this).find("input"),
                plusEl = $(this).find(settings.plusEl),
                minusEl = $(this).find(settings.minusEl),
                treeRate = settings.treeRate,
                rateEl = $(settings.rateEl);

            input.val(parseInt(settings.initValue));

            plusEl.click(function () {
               input.val(parseInt(input.val()) + 1 ); 
               changeTotal();
            });

            minusEl.click(function () {
                if(input.val() > 1)
                    input.val(parseInt(input.val()) - 1 ); 
                changeTotal();
            });

            function changeTotal() {
                rateEl.text(parseInt(input.val()) * treeRate);
            }
                

        });
    }

    //Popup card
    !(function(){
        var $trigger = $("[data-popup-target]");
        var $targetId = $trigger.attr("data-popup-target");
        var $target = $('#'+$targetId);
        $trigger.click(function (e) {
            e.preventDefault();
            $target.addClass("active");
        });
        $target.click(function (e) {
            if(e.target.id == $targetId){
                $target.removeClass("active");
            }
        })
    })();

    


})(jQuery);