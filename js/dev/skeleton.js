$(function() {
	$("html").removeClass("no-js");
});

/*
 * jQuery dropdown: A simple dropdown plugin
 * Inspired by Bootstrap: http://twitter.github.com/bootstrap/javascript.html#dropdowns
 * Copyright 2013 Cory LaViska for A Beautiful Site, LLC. (http://abeautifulsite.net/)
 * Dual licensed under the MIT / GPL Version 2 licenses
 *
*/

if (jQuery) (function ($) {
	$.extend($.fn, {
		dropdown: function (method, data) {

			switch (method) {
				case 'show':
					show(null, $(this));
					return $(this);
				case 'hide':
					hide();
					return $(this);
				case 'attach':
					return $(this).attr('data-dropdown', data);
				case 'detach':
					hide();
					return $(this).removeAttr('data-dropdown');
				case 'disable':
					return $(this).addClass('dropdown-disabled');
				case 'enable':
					hide();
					return $(this).removeClass('dropdown-disabled');
			}

		}
	});

	function show(event, object) {

		var trigger = event ? $(this) : object,
			dropdown = $(trigger.attr('data-dropdown')),
			isOpen = trigger.hasClass('dropdown-open');

		// In some cases we don't want to show it
		if (event) {
			if ($(event.target).hasClass('dropdown-ignore')) return;

			event.preventDefault();
			event.stopPropagation();
		} else {
			if (trigger !== object.target && $(object.target).hasClass('dropdown-ignore')) return;
		}
		hide();

		if (isOpen || trigger.hasClass('dropdown-disabled')) return;

		// Show it
		trigger.addClass('dropdown-open');
		dropdown
			.data('dropdown-trigger', trigger)
			.show();

		// Position it
		position();

		// Trigger the show callback
		dropdown
			.trigger('show', {
				dropdown: dropdown,
				trigger: trigger
			});

	}

	function hide(event) {
		// In some cases we don't hide them
		var targetGroup = event ? $(event.target).parents().addBack() : null;

		// Are we clicking anywhere in a dropdown?
		if (targetGroup && targetGroup.is('.dropdown')) {
			// Is it a dropdown menu?
			if (targetGroup.is('.dropdown-menu')) {
				// Did we click on an option? If so close it.
				if (!targetGroup.is('A')) return;
			} else {
				// Nope, it's a panel. Leave it open.
				return;
			}
		}

		// Hide any dropdown that may be showing
		$(document).find('.dropdown:visible').each(function () {
			var dropdown = $(this);
			dropdown
				.hide()
				.removeData('dropdown-trigger')
				.trigger('hide', { dropdown: dropdown });
		});

		// Remove all dropdown-open classes
		$(document).find('.dropdown-open').removeClass('dropdown-open');

	}

	function position() {
		var dropdown = $('.dropdown:visible').eq(0),
			trigger = dropdown.data('dropdown-trigger'),
			hOffset = trigger ? parseInt(trigger.attr('data-horizontal-offset') || 0, 10) : null,
			vOffset = trigger ? parseInt(trigger.attr('data-vertical-offset') || 0, 10) : null;

		if (dropdown.length === 0 || !trigger) return;

		// Position the dropdown relative-to-parent...
		if (dropdown.hasClass('dropdown-relative')) {
			dropdown.css({
				left: dropdown.hasClass('dropdown-anchor-right') ?
					trigger.position().left - (dropdown.outerWidth(true) - trigger.outerWidth(true)) - parseInt(trigger.css('margin-right')) + hOffset :
					trigger.position().left + parseInt(trigger.css('margin-left')) + hOffset,
				top: trigger.position().top + trigger.outerHeight(true) - parseInt(trigger.css('margin-top')) + vOffset
			});
		} else {
			// ...or relative to document
			dropdown.css({
				left: dropdown.hasClass('dropdown-anchor-right') ?
					trigger.offset().left - (dropdown.outerWidth() - trigger.outerWidth()) + hOffset : trigger.offset().left + hOffset,
				top: trigger.offset().top + trigger.outerHeight() + vOffset
			});
		}
	}

	$(document).on('click.dropdown', '[data-dropdown]', show);
	$(document).on('click.dropdown', hide);
	$(window).on('resize', position);

})(jQuery);

// tipsy, facebook style tooltips for jquery
// version 1.0.0a
// (c) 2008-2010 jason frame [jason@onehackoranother.com]
// released under the MIT license

(function($) {

	function maybeCall(thing, ctx) {
		return (typeof thing == 'function') ? (thing.call(ctx)) : thing;
	};

	function isElementInDOM(ele) {
	  while (ele = ele.parentNode) {
		if (ele == document) return true;
	  }
	  return false;
	};

	function Tipsy(element, options) {
		this.$element = $(element);
		this.options = options;
		this.enabled = true;
		this.fixTitle();
	};

	Tipsy.prototype = {
		show: function() {
			var title = this.getTitle();
			if (title && this.enabled) {
				var $tip = this.tip();

				$tip.find('.tipsy-inner')[this.options.html ? 'html' : 'text'](title);
				$tip[0].className = 'tipsy'; // reset classname in case of dynamic gravity
				$tip.remove().css({top: 0, left: 0, visibility: 'hidden', display: 'block'}).prependTo(document.body);

				var pos = $.extend({}, this.$element.offset(), {
					width: this.$element[0].offsetWidth,
					height: this.$element[0].offsetHeight
				});

				var actualWidth = $tip[0].offsetWidth,
					actualHeight = $tip[0].offsetHeight,
					gravity = maybeCall(this.options.gravity, this.$element[0]);

				var tp;
				switch (gravity.charAt(0)) {
					case 'n':
						tp = {top: pos.top + pos.height + this.options.offset, left: pos.left + pos.width / 2 - actualWidth / 2};
						break;
					case 's':
						tp = {top: pos.top - actualHeight - this.options.offset, left: pos.left + pos.width / 2 - actualWidth / 2};
						break;
					case 'e':
						tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth - this.options.offset};
						break;
					case 'w':
						tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width + this.options.offset};
						break;
				}

				if (gravity.length == 2) {
					if (gravity.charAt(1) == 'w') {
						tp.left = pos.left + pos.width / 2 - 15;
					} else {
						tp.left = pos.left + pos.width / 2 - actualWidth + 15;
					}
				}

				$tip.css(tp).addClass('tipsy-' + gravity);
				$tip.find('.tipsy-arrow')[0].className = 'tipsy-arrow tipsy-arrow-' + gravity.charAt(0);
				if (this.options.className) {
					$tip.addClass(maybeCall(this.options.className, this.$element[0]));
				}

				if (this.options.fade) {
					$tip.stop().css({opacity: 0, display: 'block', visibility: 'visible'}).animate({opacity: this.options.opacity});
				} else {
					$tip.css({visibility: 'visible', opacity: this.options.opacity});
				}
			}
		},

		hide: function() {
			if (this.options.fade) {
				this.tip().stop().fadeOut(function() { $(this).remove(); });
			} else {
				this.tip().remove();
			}
		},

		fixTitle: function() {
			var $e = this.$element;
			if ($e.attr('title') || typeof($e.attr('original-title')) != 'string') {
				$e.attr('original-title', $e.attr('title') || '').removeAttr('title');
			}
		},

		getTitle: function() {
			var title, $e = this.$element, o = this.options;
			this.fixTitle();
			var title, o = this.options;
			if (typeof o.title == 'string') {
				title = $e.attr(o.title == 'title' ? 'original-title' : o.title);
			} else if (typeof o.title == 'function') {
				title = o.title.call($e[0]);
			}
			title = ('' + title).replace(/(^\s*|\s*$)/, "");
			return title || o.fallback;
		},

		tip: function() {
			if (!this.$tip) {
				this.$tip = $('<div class="tipsy"></div>').html('<div class="tipsy-arrow"></div><div class="tipsy-inner"></div>');
				this.$tip.data('tipsy-pointee', this.$element[0]);
			}
			return this.$tip;
		},

		validate: function() {
			if (!this.$element[0].parentNode) {
				this.hide();
				this.$element = null;
				this.options = null;
			}
		},

		enable: function() { this.enabled = true; },
		disable: function() { this.enabled = false; },
		toggleEnabled: function() { this.enabled = !this.enabled; }
	};

	$.fn.tipsy = function(options) {

		if (options === true) {
			return this.data('tipsy');
		} else if (typeof options == 'string') {
			var tipsy = this.data('tipsy');
			if (tipsy) tipsy[options]();
			return this;
		}

		options = $.extend({}, $.fn.tipsy.defaults, options);

		function get(ele) {
			var tipsy = $.data(ele, 'tipsy');
			if (!tipsy) {
				tipsy = new Tipsy(ele, $.fn.tipsy.elementOptions(ele, options));
				$.data(ele, 'tipsy', tipsy);
			}
			return tipsy;
		}

		function enter() {
			var tipsy = get(this);
			tipsy.hoverState = 'in';
			if (options.delayIn == 0) {
				tipsy.show();
			} else {
				tipsy.fixTitle();
				setTimeout(function() { if (tipsy.hoverState == 'in') tipsy.show(); }, options.delayIn);
			}
		};

		function leave() {
			var tipsy = get(this);
			tipsy.hoverState = 'out';
			if (options.delayOut == 0) {
				tipsy.hide();
			} else {
				setTimeout(function() { if (tipsy.hoverState == 'out') tipsy.hide(); }, options.delayOut);
			}
		};

		if (!options.live) this.each(function() { get(this); });

		if (options.trigger != 'manual') {
			var binder   = options.live ? 'live' : 'bind',
				eventIn  = options.trigger == 'hover' ? 'mouseenter' : 'focus',
				eventOut = options.trigger == 'hover' ? 'mouseleave' : 'blur';
			this[binder](eventIn, enter)[binder](eventOut, leave);
		}

		return this;

	};

	$.fn.tipsy.defaults = {
		className: null,
		delayIn: 0,
		delayOut: 0,
		fade: false,
		fallback: '',
		gravity: 'n',
		html: false,
		live: false,
		offset: 0,
		opacity: 0.8,
		title: 'title',
		trigger: 'hover'
	};

	$.fn.tipsy.revalidate = function() {
		$('.tipsy').each(function() {
			var pointee = $.data(this, 'tipsy-pointee');
			if (!pointee || !isElementInDOM(pointee)) {
				$(this).remove();
			}
		});
	};

	// Overwrite this method to provide options on a per-element basis.
	// For example, you could store the gravity in a 'tipsy-gravity' attribute:
	// return $.extend({}, options, {gravity: $(ele).attr('tipsy-gravity') || 'n' });
	// (remember - do not modify 'options' in place!)
	$.fn.tipsy.elementOptions = function(ele, options) {
		return $.metadata ? $.extend({}, options, $(ele).metadata()) : options;
	};

	$.fn.tipsy.autoNS = function() {
		return $(this).offset().top > ($(document).scrollTop() + $(window).height() / 2) ? 's' : 'n';
	};

	$.fn.tipsy.autoWE = function() {
		return $(this).offset().left > ($(document).scrollLeft() + $(window).width() / 2) ? 'e' : 'w';
	};

	/**
	 * yields a closure of the supplied parameters, producing a function that takes
	 * no arguments and is suitable for use as an autogravity function like so:
	 *
	 * @param margin (int) - distance from the viewable region edge that an
	 *        element should be before setting its tooltip's gravity to be away
	 *        from that edge.
	 * @param prefer (string, e.g. 'n', 'sw', 'w') - the direction to prefer
	 *        if there are no viewable region edges effecting the tooltip's
	 *        gravity. It will try to vary from this minimally, for example,
	 *        if 'sw' is preferred and an element is near the right viewable
	 *        region edge, but not the top edge, it will set the gravity for
	 *        that element's tooltip to be 'se', preserving the southern
	 *        component.
	 */
	 $.fn.tipsy.autoBounds = function(margin, prefer) {
		return function() {
			var dir = {ns: prefer[0], ew: (prefer.length > 1 ? prefer[1] : false)},
				boundTop = $(document).scrollTop() + margin,
				boundLeft = $(document).scrollLeft() + margin,
				$this = $(this);

			if ($this.offset().top < boundTop) dir.ns = 'n';
			if ($this.offset().left < boundLeft) dir.ew = 'w';
			if ($(window).width() + $(document).scrollLeft() - $this.offset().left < margin) dir.ew = 'e';
			if ($(window).height() + $(document).scrollTop() - $this.offset().top < margin) dir.ns = 's';

			return dir.ns + (dir.ew ? dir.ew : '');
		}
	};

})(jQuery);