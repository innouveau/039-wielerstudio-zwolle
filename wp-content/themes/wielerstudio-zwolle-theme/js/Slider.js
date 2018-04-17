function Slider(element) {
    this.element = element;
    this.frequency = 5000;
    this.fadeout = 1000;
    this.slides = [];
    this.l = null;
    this.timer = null;
    this.countdownTimer = null;
    this.init();

}

Slider.prototype.init = function() {
    this.updateSelection();
    this.addClickListener();
    this.setFrequency();
    this.set();
    this.play();
};

Slider.prototype.setFrequency = function() {
    if (this.element.attr('freq')) {
        this.frequency = this.element.attr('freq');
        if (this.frequency < this.fadeout + 50) {
            this.frequency = this.fadeout + 50;
        }
    }
};

Slider.prototype.addClickListener = function() {
    var self = this;
    this.element.click(function(){
        self.stop();
        self.next(true);
        self.countdown();
    });
};

Slider.prototype.updateSelection = function() {
    this.slides = this.element.find('.wp-caption');
    this.l = this.slides.length;
};

Slider.prototype.set = function() {
    var height, parent, ratio = 450/620;

    // set height
    height = (this.element.outerWidth() - 16) * ratio + 16 + 20;
    this.element.css('height', height);

    // check if parent is an img-frame
    // if so set its font-size to 0, to prevent using float
    parent = this.element.parent();
    if (parent.hasClass('img-frame')) {
        parent.css('font-size', 0);
    }
};

Slider.prototype.countdown = function() {
    var self = this;
    clearTimeout(this.countdownTimer);
    this.countdownTimer = setTimeout(function(){
        self.play();
    }, this.frequency);
};

Slider.prototype.stop = function() {
    clearInterval(this.timer);
};


Slider.prototype.play = function() {
    var self = this;
    this.timer = setInterval(function(){
        self.next(false);
    }, this.frequency)
};

Slider.prototype.next = function(fast) {
    var self = this,
        last = $(this.slides[this.l - 1]),
        time = this.fadeout;
    if (fast) {
        time = 120;
    }
    last.fadeOut(time);
    setTimeout(function(){
        last.show();
        self.element.prepend(last);
        self.updateSelection();
    }, time + 50);
};

