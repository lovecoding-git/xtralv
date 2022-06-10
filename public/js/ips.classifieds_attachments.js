var OS = Class.create();
OS.PageLoading = true;
OS.PageLoadComplete = function() {
    OS.PageLoading = false;
    $A(OS.BehaviourQueue).each(function(selectors) {
        OS.ApplyBehaviour(selectors);
    });
    OS.BehaviourQueue = [];
};
Event.observe(document, 'dom:loaded', function() {
    OS.PageLoadComplete();
});
OS.BehaviourQueue = [];
OS.RegisterBehaviour = function(selectors) {
    if(!OS.PageLoading) { OS.ApplyBehaviour(selectors); return; }
    OS.BehaviourQueue.push(selectors);    
}
OS.ApplyBehaviour = function(selectors) {
    $H(selectors).each(function(item) {
        var sKey = item.key;
        var iDelay = 0;
        var iToken = sKey.indexOf("!D");
        if (iToken > 0) {
            iDelay = parseFloat(sKey.substring(iToken + 2)) || 0;
            sKey = sKey.substring(0, iToken);
            iDelay = parseInt(iDelay);
        }
        $$(sKey).each(function(element) {
            if (!iDelay) { item.value(element); return; }
            item.value.delay(iDelay, element);
        });
    });
};



Element.display = function(element, show) {
    Element[(show) ? 'show': 'hide'](element);
}

var CarouselItem = Class.create();
CarouselItem.prototype = {
    initialize: function() {
        this.key = null;		
        this.value = null;
        this.element = null;
        
    }
};
var Carousel = Class.create();
Carousel.prototype = {
    initialize: function(key, carouselElement, itemWidth, itemHeight, observer, options) {
        this.loaded = false;
        this.key = key;
        this.observer = observer;
        this.carouselElement = $(carouselElement);
        if (!this.carouselElement) { alert('Warning: Invalid carousel element: ' + carouselElement); return; }
        this.itemsElement = this.carouselElement.down('.items');
        if (!this.itemsElement) { alert('Warning: Class \'items\' does not exist as a child element in carousel: ' + carouselElement); return; }
        this.items = [];
        this.activeItem = null;
        this.activeIndex = 0;
        this.navScrollIndex = 0;
        this.itemHeight = itemHeight;
        this.itemWidth = itemWidth;
        if (!options) options = {};
        this.options = Object.extend({
            duration: 1.0,
            direction: 'horizontal',
            moveOpacity: .6,
            setSize: 4,
            allowAutoLoopOnSet: false,
            allowAutoLoopOnIndividual: true
        }, options);
        this.backElement = this.carouselElement.down('.navButton.previous');
        this.forwardElement = this.carouselElement.down('.navButton.next');
        if (this.backElement) Event.observe(this.backElement, 'click', this.scrollBack.bind(this));
        if (this.forwardElement) Event.observe(this.forwardElement, 'click', this.scrollForward.bind(this));
    },
    load: function() {
        var eList = this.itemsElement;
        this.items.clear();
        eList.select('.item').each(function(item) {

        	

            var oCarouselItem = new CarouselItem();
            if (this.options.itemParser) oCarouselItem.value = this.options.itemParser(item);
            oCarouselItem.index = this.items.length;
          
            oCarouselItem.element = item;
            this.items.push(oCarouselItem);

            //Store default selection
            if (item.hasClassName('selected')) {
                this.activeItem = oCarouselItem;
                this.activeIndex = this.items.size() - 1;
            }

            if (this.options.setItemEvents) this.options.setItemEvents(this, item, oCarouselItem, this.observer);
        } .bind(this));

        //Post processing
        this.loaded = true;
        this.afterLoad();
    },
    destroy: function() {
        this.loaded = false;
        var eList = this.itemsElement;
        this.items.clear();
        if (this.options.unsetItemEvents) {
            eList.select('.item').each(function(item, ix) {
                this.options.unsetItemEvents(this, item, this.items[ix], this.observer);
            } .bind(this));
        }
    },
    afterLoad: function() {
        if (this.items.length == 0) {
            alert('Warning: No Carousel Items Exist');
            return;
        }

        //Change the following line to moveToIndex if you do 
        //not want the load animation on default selected items
        this.moveToIndex(this.activeIndex);
        //this.scrollToIndex(this.activeIndex);

        if (this.activeItem) this.activate(this.activeItem);
        if (this.observer.fireActiveCarouselLoaded) this.observer.fireActiveCarouselLoaded(this);
    },
    scrollForward: function() {
        //setsize-1 at a time scrolling 
        var iIndex = 0;
        if (this.navScrollIndex > this.items.length - (this.options.setSize + 1)) {
            if (!this.options.allowAutoLoopOnSet) return;
        } else {
            iIndex = this.navScrollIndex + (this.options.setSize - 1);
        }
        this.scrollToIndex(iIndex);
    },
    scrollBack: function() {
        var iIndex = this.navScrollIndex - (this.options.setSize - 1);
        if (iIndex < 0) {
            if (!this.options.allowAutoLoopOnSet) {
                iIndex = 0;
            } else {
                iIndex = this.items.length - this.options.setSize;
                if (this.navScrollIndex > 0 || iIndex < 0) iIndex = 0;
            }
        }
        this.scrollToIndex(iIndex);
    },
    getLeft: function(index) {
        return index * (-this.itemWidth);
    },
    getTop: function(index) {
        return index * (-this.itemHeight);
    },
    activate: function(carouselItem) {
        if (this.activeItem) this.observer.fireDeactiveCarouselItem(this, this.activeItem.element, this.activeItem);
        if (carouselItem == null) return;
        this.activeItem = carouselItem;
        if (this.observer.fireActiveCarouselItem) this.observer.fireActiveCarouselItem(this, carouselItem.element, carouselItem);
    },
    reactivate: function() {
        if (!this.activeItem) return;
        this.activate(this.activeItem);
    },
    next: function() {
        if (this.activeItem == null) { this.activate(this.items[0]); return; }
        var iIndex = this.activeItem.index + 1;
        if (iIndex >= this.items.length) {
            iIndex = 0;
            if (!this.options.allowAutoLoopOnIndividual) iIndex = this.items.length - 1;
        }
        this.activate(this.items[iIndex]);
        this.activeIndex = iIndex;
        if (iIndex == 0) { this.scrollToIndex(0); return; }
        if (iIndex - this.options.setSize >= this.navScrollIndex - 1) this.scrollForward();
    },
    previous: function() {
        if (this.activeItem == null) { this.activate(this.items[0]); return; }
        var iIndex = this.activeItem.index - 1;
        if (iIndex < 0) {
            if (this.options.allowAutoLoopOnIndividual) {
                iIndex = this.items.length - 1;
            } else {
                iIndex = 0;
            }
        }
        this.activate(this.items[iIndex]);
        this.activeIndex = iIndex;
        if (iIndex == 0) { this.scrollToIndex(0); return; }
        if (iIndex == this.items.length - 1) {
            var iNavIndex = this.items.length - this.options.setSize;
            if (iNavIndex < 0) iNavIndex = 0;
            this.scrollToIndex(iNavIndex); return;
        }
        if (iIndex < this.navScrollIndex + 1) this.scrollBack();
    },
    scrollToIndex: function(index, duration) {
        if (index < 0) index = this.activeIndex;
        duration = duration || this.options.duration; //allow for override

            var iPreviousLeft = this.getLeft(this.navScrollIndex);
            var iLeft = this.getLeft(index);
            var iCurrentLeft = parseInt(Element.getStyle(this.itemsElement, 'left')) || 0;
            var offset = iPreviousLeft - iCurrentLeft;
            var move = iLeft - iCurrentLeft;
            if (move > 0) {
                move = move + offset;
            } else {
                move = move - offset;
            }
            Element.setOpacity(this.itemsElement, this.options.moveOpacity);
            var ef = new Effect.Move(this.itemsElement, {
                'duration': duration,
                'x': move,
                'afterFinish': function() {
                    Element.setStyle(this.itemsElement, { 'left': iLeft + 'px' });
                    Element.setOpacity(this.itemsElement, 1.0);
                } .bind(this)
            });
            ef = null;
        
        this.navScrollIndex = index;
        Element.display(this.forwardElement, this.navScrollIndex <= this.items.length - (this.options.setSize + 1) || this.options.allowAutoLoopOnSet);
        Element.display(this.backElement, (parseInt(this.navScrollIndex) || 0) != 0 || this.options.allowAutoLoopOnSet);
        if (this.observer.fireCarouselAtIndex) this.observer.fireCarouselAtIndex(this, index);
    },
    moveToIndex: function(index) {

            var iLeft = this.getLeft(index);
            Element.setStyle(this.itemsElement, { 'left': iLeft + 'px' });
            Element.setOpacity(this.itemsElement, 1.0);
        

        this.navScrollIndex = index;
        Element.display(this.forwardElement, this.navScrollIndex <= this.items.length - (this.options.setSize + 1) || this.options.allowAutoLoopOnSet);
        Element.display(this.backElement, (parseInt(this.navScrollIndex) || 0) != 0 || this.options.allowAutoLoopOnSet);
    }
};

var AppBehavior = Class.create();
AppBehavior.Load = function() {
    OS.RegisterBehaviour(AppBehavior.CarouselRules);
}
AppBehavior.CarouselRules = {

   
    '#Carousel': function(element) {
        //Pictures
        AppBehavior.PictureCarousel = new Carousel('PictureCarousel', element, 80, 80, AppBehavior, {
            setSize: 4,
            duration: .5,
            direction: 'horizontal',
            itemParser: function(item) {
                //Given html element you can build a data object for the item if needed for later activation
               // var sKey = item.down('.key').innerHTML;
                var sCaption = item.down('.caption').innerHTML;
                var sPictureHtml = item.down('.picture').innerHTML;
                return { name: sCaption, pictureHtml: sPictureHtml };
            },
            setItemEvents: function(carousel, itemElement, carouselItem, observer) {
                //This allows you to set events to the item like rollovers/mouse events
                Event.observe(itemElement, 'click', function() {
                    carousel.activate(carouselItem);
                });
            },
            allowAutoLoopOnSet: true,
            allowAutoLoopOnIndividual: false
        });
        AppBehavior.PictureCarousel.load();
    },
    '#Cmd_NextItem': function(element) {
        Event.observe(element, 'click', function() {
            AppBehavior.ProfileCarousel.next();
        });
    },
    '#Cmd_PreviousItem': function(element) {
        Event.observe(element, 'click', function() {
            AppBehavior.ProfileCarousel.previous();
        });
    }
}

//EVENT OBSERVATION
AppBehavior.fireActiveCarouselLoaded = function(carousel) {
}
AppBehavior.fireActiveCarouselItem = function(carousel, element, item) {
    element.addClassName('selected');

    
            $('ViewerData').update(item.value.pictureHtml);
            Element.show('Viewer');

}
AppBehavior.fireDeactiveCarouselItem = function(carousel, element, item) {
    element.removeClassName('selected');

   
            Element.hide('Viewer');
      
}

AppBehavior.Load();
