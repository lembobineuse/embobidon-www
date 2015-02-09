(function (window, document, $) {
'use strict';

var pluginName = 'imageWall',
    defaults = {
        maxHeight: 180,
        margin: 6
    }    
;

function debounce (fn, delay)
{
    var timeout_id;
    return function debounced () {
        var context = this,
            args = arguments
        ;
        clearTimeout(timeout_id);
        timeout_id = setTimeout(function () {
            timeout_id = null;
            fn.apply(context,  args);
        }, delay);
    };
}

/**
 * CSS requirements:
 *   - the container must be position: relative
 *   - the images must be position: absolute
 *
 * @author ju1ius
 */
function ImageWall(container, options)
{
    this.container = container;

    this.settings = $.extend({}, defaults, options);
    this.maxHeight = this.settings.maxHeight;
    this.margin = this.settings.margin;

    this.listeners = {
        resize: $.proxy(debounce(this.layout, 150), this)
    };
    // check whether we are already litening for window.onresize 
    this.bound = false;

    this.init();
}

ImageWall.prototype = {

    init: function ()
    {
        this.update();

        return this;
    },

    update: function ()
    {
        var self = this;

        $(this.container).imagesLoaded()
            .progress(function (loader, image) {
            if (!image.isLoaded) {
                $(image.img).remove();
            }
        }).always(function () {
            self.collect();
            self.layout();
            if (!self.bound) {
                self.bound = true;
                $(window).on('resize', self.listeners.resize);
            }
        });

        return this;
    },

    destroy: function ()
    {
        $(window).off('resize', this.listeners.resize);
        $(this.container).removeClass('image-wall-container');
        this.container.style.minHeight = null;
        $(this.images).each(function () {
            this.style.width = this.style.height = this.style.margin = null;
            this.style.top = this.style.left = null;
        });
    },

    /**
     * Final layout method: do not override.
     * Wraps doLayout in a requestAnimationFrame call if available.
     */
    layout: (function ()
    {
        if (window.requestAnimationFrame) {
            return function () {
                var self = this;
                window.requestAnimationFrame(function () {
                    self.doLayout();
                });
                return this;
            };
        }
        return function () {
            this.doLayout();
            return this;
        };
    }()),

    collect: function ()
    {
        var self = this;
        this.images = [];
        this.widths = [];
        $('img', this.container).each(function () {
            var w = this.width,
                h = this.height
            ;
            if (h !== self.maxHeight) {
                // scale the image to match maxHeight
                w = Math.floor(w * (self.maxHeight / h));
            }
            self.widths.push(w);
            self.images.push(this);
        });
        this.numImages = this.images.length;
        $(this.container).addClass('image-wall-container');
    },

    /**
     * Private method that performs the layout alogrithm.
     */
    doLayout: function ()
    {
        var root = document.documentElement,
            mayReflow = (root.scrollHeight === root.clientHeight),
            i, x, y,
            maxWidth,
            // index of the first image in the current row
            baseLine = 0,
            // total number of images appearing in all previous rows
            numImgProcessed = 0,
            numImgInRow,
            totalImgWidthInRow,
            ratio,
            newHeight, newWidth,
            adjustment,
            dimensions = [], curdim
        ;
        /**
         * FIXME: if the container has a flexible width and the html element is not currently scrolling,
         * the layout operation can trigger an overflow-y, causing the scrollbar to appear
         * and the width of the container becoming invalid.
         * So we have to force the scrollbar for the duration of the reflow...
         * However, we do this only if the root element
         */
        if (mayReflow) {
            root.style.overflowY = 'scroll';
        }
        maxWidth = this.container.clientWidth;
        x = y = 0;
        while (numImgProcessed < this.numImages) {
            // Count the number of images that are going to appear in the row,
            // along with their accumulated width until we reach the width of the parent element.

            // number of images appearing in this row
            numImgInRow = 0;
            // total width of images in this row - including margins
            totalImgWidthInRow = 0;
            // image index in the current row
            i = 0;
            // calculate width of images and number of images to view in this row.
            while (totalImgWidthInRow * 1.1 < maxWidth) {
                i = this.widths[baseLine + numImgInRow++];
                if (!i) {
                    // we got past the last image, rewind and break
                    numImgInRow--;
                    break;
                }
                totalImgWidthInRow +=  i + this.margin * 2;
            }

            // Ratio of actual width of row to total width of images to be used.
            ratio = maxWidth / totalImgWidthInRow;
            // new height is not original height * ratio
            newHeight = Math.floor(this.maxHeight * ratio);
            // reset total width to be total width of processed images
            totalImgWidthInRow = 0;
            i = 0;
            while (i < numImgInRow) {
                numImgProcessed += 1;
                x = totalImgWidthInRow;
                // Calculate new width based on ratio
                newWidth = Math.floor(this.widths[baseLine + i] * ratio);
                // add to total width with margins
                totalImgWidthInRow += newWidth + this.margin * 2;
                curdim = {
                    width: newWidth,
                    height: newHeight,
                    x: x,
                    y: y
                };
                dimensions.push(curdim);
                i++;
            }
            // we need to cheat and adjust the width of the last cell in the row
            if (totalImgWidthInRow < maxWidth) {
                adjustment = maxWidth - totalImgWidthInRow;
                newWidth += adjustment;
                totalImgWidthInRow += adjustment;
            }
            if (totalImgWidthInRow > maxWidth) {
                adjustment = totalImgWidthInRow - maxWidth;
                newWidth -= adjustment;
                totalImgWidthInRow -= adjustment;
            }
            curdim.width = newWidth;
            y += newHeight + this.margin * 2;
            baseLine += numImgInRow;
        }
        this.handleOrphans(numImgInRow, dimensions);
        this.applyDimensions(dimensions);
        if (mayReflow) {
            root.style.overflowY = null;
        }

        return this;
    },

    /**
     * This method checks the last line for images that have gone too big,
     * and avoid the situation where an image is scaled to the full width of the row.
     *
     * This has to be done in two passes.
     */
    handleOrphans: function (numImgInRow, dimensions)
    {
        var rowStart = this.numImages - numImgInRow,
            maxRatio = 1.1,
            maxAllowedHeight = this.maxHeight * maxRatio,
            i, dim, ratio, x,
            mustResize = false
        ;
        for (i = rowStart; i < this.numImages; i++) {
            dim = dimensions[i];
            if (dim.height > maxAllowedHeight) {
                mustResize = true;
                break;
            }
        }
        if (!mustResize) {
            return;
        }
        x = 0;
        for (i = rowStart; i < this.numImages; i++) {
            dim = dimensions[i];
            ratio = this.maxHeight / dim.height;
            dim.height = this.maxHeight;
            dim.width = Math.floor(dim.width * ratio);
            dim.x = x;
            x += dim.width + this.margin * 2;
        }
    },

    /**
     * Private method. Applies computed dimensions to our images.
     */
    applyDimensions: function (dimensions)
    {
        var dim, img,
            i = 0,
            l = dimensions.length,
            last = dimensions[l - 1]
        ;
        this.container.style.minHeight = (last.y + last.height + (this.margin*2)) + 'px';
        for (i, l; i < l; i++) {
            dim = dimensions[i];
            img = this.images[i];
            img.style.width = dim.width + 'px';
            img.style.height = dim.height + 'px';
            img.style.margin = this.margin + 'px';
            img.style.top = dim.y + 'px';
            img.style.left = dim.x + 'px';
        }
    }
};


$[pluginName] = $.fn[pluginName] = function (options)
{
    if (typeof options === 'string') {
        this.each(function () {
            var instance = $.data(this, 'plugin_' + pluginName);
            if (options === 'destroy') {
                $.data(this, 'plugin_' + pluginName, null);
            }
            if (!instance instanceof ImageWall) {
                return;
            }
            if (['update', 'destroy', 'layout'].indexOf(options) > -1) {
                instance[options]();
            }
        });
        return this;
    }
    if (!(this instanceof $)) {
        return $.extend(defaults, options);
    }
    return this.each(function() {
        var $el = $(this);
	    if (!$.data(this, "plugin_" + pluginName)) {
            options.maxHeight = parseInt($el.attr('data-imagewall-height'), 10) || options.maxHeight;
            options.margin = parseInt($el.attr('data-imagewall-margin'), 10) || options.margin;
            $.data(this, "plugin_" + pluginName, new ImageWall(this, options));
        }
    });
};

}(this, this.document, this.jQuery));
