/*
    Simple jQuery Carousel
    Author: Meeraj Wadhwa
*/

$.fn.basicSlider = function(opt) {

    // current slider tab default to first
    var _this = this,

    options = {
        // crousel length
        crouselLength: null,
        // crousel per element width
        crouselWidth: null,
        currentTab : 1
    },
    
    // selectors use by plugin
    selector = {
        ul: ".slider-container ul",
        prev: ".prev",
        next: ".next",
        container: ".slider-container",
        mainContainer: $(this),
        li: ".slider-container ul li"
    };

    // merging the objects
    $.extend(options, opt);

    // bind click events
    var bindEvents = function() {
    	selector.mainContainer.find(selector.prev).click(function() { _this.moveBack() });
        selector.mainContainer.find(selector.next).click(function() { _this.moveForward() });
    },

    // add classes to elements
    addClassToElements = function(sel, cls) {
        for(var i in sel) {
            selector.mainContainer.find(sel[i]).addClass(cls);
        }
    },

    // remove classes from element
    removeClassToElements = function(sel, cls) {
        for(var i in sel) {
            selector.mainContainer.find(sel[i]).removeClass(cls);
        }
    },

    init = function() {
    	// set crousel layout
    	_this.setCrousel();
        bindEvents();
    };

    // setting carousel on DOM
    this.setCrousel = function() {
        var parentUl;

    	// disable prev link
    	addClassToElements([selector.prev], "disable-link");
        parentUl = selector.mainContainer.find(selector.ul);

    	options.crouselLength = parentUl.find('li').length;
        options.crouselWidth = selector.mainContainer.find(selector.container).width();

        parentUl.css({width: (options.crouselLength * options.crouselWidth) + "px"});
    	selector.mainContainer.css({width: options.crouselWidth + "px"}).find(selector.container +"," + selector.li ).css({width: options.crouselWidth + "px"});
    },

    // move back
    this.moveBack = function() {
    	if(options.currentTab > 1) {
	    	removeClassToElements([selector.next, selector.prev], "disable-link");
    		options.currentTab--;
    		_this.moveCrousel();
    	} 

    	if(options.currentTab == 1) addClassToElements([selector.prev], "disable-link");
    },

    // move forward
    this.moveForward = function() {
    	if(options.currentTab < options.crouselLength) {	
            removeClassToElements([selector.next, selector.prev], "disable-link");
    		options.currentTab++;
    		_this.moveCrousel();
    	} 

    	if(options.currentTab == options.crouselLength) addClassToElements([selector.next], "disable-link");
    },

    // move crousel
    this.moveCrousel = function() {
		selector.mainContainer.find(selector.ul).animate({ 'left': -((options.currentTab - 1)*options.crouselWidth)+'px' }, 800, function() {});
    };

    // calling the init function on the fly
    init();
};

