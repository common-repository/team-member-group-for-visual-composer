var AwsmModel = (function() {

    var $teamList = $(".awsm-popup-grid"),
        $teamItems = $(".awsm-popup-items"),
        $teamItem = $(".awsm-popup-item"),
        $modal=$('.awsm-modal'),
        init = function() {
            bindUIActions();
        },

        bindUIActions = function() {
            $teamItems.on("click", ".awsm-popup-close", close);
            $teamList.on("click", ".awsm-popup-trigger", open);
            $teamItems.on("click", ".awsm-nav-item", slider);
            $(document).on("click", ".awsm-popup-items", bgclick);
            $(document).keyup(keyBinding);
        },
        bgclick = function(e) {
            if (e.target != this) return;
            close(e);
        }
    open = function(e) {
            e.preventDefault();
            $modal = $(this).parents(".awsm-modal");
            var popItem = $(this).attr('href');
            $(popItem).parents('.awsm-popup-items').addClass('awsm-popup-on');
            $(popItem).addClass('awsm-popup-open');
        },
        close = function(e) {
            e.preventDefault();
            $teamItems.removeClass('awsm-popup-on');
            $teamItem.removeClass('awsm-popup-open');
        },
        slider = function(e) {
            e.preventDefault();
            var direction = 'forward';
            if ($(this).hasClass('awsm-nav-left')) {
                direction = 'rewind';
            }
            play(direction);
        },
        keyBinding = function(e) {
            switch (e.keyCode) {
                case 27:
                    close(e);
                    break;
                case 39:
                    play('forward');
                    break;
                case 37:
                    play('rewind');
                    break;
            }
        },
        play = function(direction) {
           /* var $slideritem = $('.awsm-popup-open').prev('.awsm-popup-item'),
                $circleslide = $('.awsm-popup-item').last('.awsm-popup-item');
            if (direction == 'forward') {
                $slideritem = $('.awsm-popup-open').next('.awsm-popup-item');
                $circleslide = $('.awsm-popup-item').first('.awsm-popup-item');
            }
            if ($slideritem.length == 0) {
                $('.awsm-popup-open').removeClass('awsm-popup-open');
                $circleslide.addClass('awsm-popup-open');
            } else {
                $('.awsm-popup-open').removeClass('awsm-popup-open');
                $slideritem.addClass('awsm-popup-open');
            } */
            var $curentOpen=$modal.find('.awsm-popup-open'),
                $curenItem =$modal.find('.awsm-popup-item'),
                $slideritem = $curentOpen.prev('.awsm-popup-item'),
                $circleslide = $curenItem.last('.awsm-popup-item');
            if (direction == 'forward') {
                $slideritem =$curentOpen.next('.awsm-popup-item');
                $circleslide = $curenItem.first('.awsm-popup-item');
            }
            if ($slideritem.length == 0) {
                $curentOpen.removeClass('awsm-popup-open');
                $circleslide.addClass('awsm-popup-open');
            } else {
                $curentOpen.removeClass('awsm-popup-open');
                $slideritem.addClass('awsm-popup-open');
            } 
        };
    return {
        init: init
    }

})();
