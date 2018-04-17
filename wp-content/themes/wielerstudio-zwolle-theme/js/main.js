$(function() {
    // intro
    
    var gridItems = [],
        l,
        timer;
    $('.grid-item').each(function() {
        gridItems.unshift(this);
    });
    l = gridItems.length;
    
    $('.grid').waitForImages({
        finished: function() {
            launch(l);
            setTimeout(function(){
                resizeTiles();
            }, 250);
        },
        each: function() {},
        waitForAll: true
    });
    
    function launch() {
        var timer = setInterval(function(){ 
            l--;
            if (l < -1) {
                clearInterval(timer);
            } else {
                splashItem(gridItems[l]);
            }
            
        }, 100);
    }
    
    function splashItem(item) {
        $(item).css('display', 'inline-block'); 
        $(item).find('.grid-item-content').animate({
            width: '100%',
            height: '100%',
            margin: 0
        }, 300, function() {
            // Animation complete.
        });
    }
    
    // rotate items
    
    $('.grid-item').click(function(event){
        if (!$(event.target).hasClass('a-outer-link')) {
            $(this).toggleClass('flipped');
        }
        
    });
    
    // responsiveness
    
    $( window ).resize(function() {
        resizeTiles();
    });
    
    function resizeTiles() {
        $('.grid-item').each(function(){
          var height = $(this).outerWidth() / 320 * 305;
          $(this).css('height', height);
      })
    }
    
    $('iframe').each(function(){
        var height = $(this).outerWidth() * 0.5625;
        console.log(height);
        $(this).css('height', height);
        
    });


    $('.drs-slider').each(function(){
        new Slider($(this));
    });
    

    
 
    
    // hamburg 
    
    $('#hamburg').click(function(){
        $(this).toggleClass('active');    
    });
});