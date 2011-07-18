/*jslint browser: true *//*global jQuery: true */

/**
 * jQuery Cookie plugin
 *
 * Copyright (c) 2010 Klaus Hartl (stilbuero.de)
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 */

// TODO JsDoc
/**
 * Create a cookie with the given key and value and other optional parameters.
 *
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Set the value of a cookie.
 * @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
 * @desc Create a cookie with all available options.
 * @example $.cookie('the_cookie', 'the_value');
 * @desc Create a session cookie.
 * @example $.cookie('the_cookie', null);
 * @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain
 *       used when the cookie was set.
 *
 * @param String key The key of the cookie.
 * @param String value The value of the cookie.
 * @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
 * @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
 *                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
 *                             If set to null or omitted, the cookie will be a session cookie and will not be retained
 *                             when the the browser exits.
 * @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
 * @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
 * @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will
 *                        require a secure protocol (like HTTPS).
 * @type undefined
 *
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */

/**
 * Get the value of a cookie with the given key.
 * 
 * @example $.cookie('the_cookie');
 * @desc Get the value of a cookie.
 * 
 * @param String
 *            key The key of the cookie.
 * @return The value of the cookie.
 * @type String
 * 
 * @name $.cookie
 * @cat Plugins/Cookie
 * @author Klaus Hartl/klaus.hartl@stilbuero.de
 */
jQuery.cookie = function(key, value, options) {

	// key and at least value given, set cookie...
	if (arguments.length > 1 && String(value) !== "[object Object]") {
		options = jQuery.extend({}, options);

		if (value === null || value === undefined) {
			options.expires = -1;
		}

		if (typeof options.expires === 'number') {
			var days = options.expires, t = options.expires = new Date();
			t.setDate(t.getDate() + days);
		}

		value = String(value);

		return (document.cookie = [
				encodeURIComponent(key),
				'=',
				options.raw ? value : encodeURIComponent(value),
				options.expires ? '; expires=' + options.expires.toUTCString()
						: '', // use expires attribute, max-age is not
								// supported by IE
				options.path ? '; path=' + options.path : '',
				options.domain ? '; domain=' + options.domain : '',
				options.secure ? '; secure' : '' ].join(''));
	}

	// key and possibly options given, get cookie...
	options = value || {};
	var result, decode = options.raw ? function(s) {
		return s;
	} : decodeURIComponent;
	return (result = new RegExp('(?:^|; )' + encodeURIComponent(key)
			+ '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
/**
 * Watches attribute changes credits go to Darcy Clarke
 * http://darcyclarke.me/development/detect-attribute-changes-with-jquery/
 */
$.fn.watch = function(props, func, interval, id) {
	// / <summary>
	// / Allows you to monitor changes in a specific
	// / CSS property of an element by polling the value.
	// / when the value changes a function is called.
	// / The function called is called in the context
	// / of the selected element (ie. this)
	// / </summary>
	// / <param name="prop" type="String">CSS Properties to watch sep. by
	// commas</param>
	// / <param name="func" type="Function">
	// / Function called when the value has changed.
	// / </param>
	// / <param name="interval" type="Number">
	// / Optional interval for browsers that don't support DOMAttrModified or
	// propertychange events.
	// / Determines the interval used for setInterval calls.
	// / </param>
	// / <param name="id" type="String">A unique ID that identifies this watch
	// instance on this element</param>
	// / <returns type="jQuery" />
	if (!interval)
		interval = 100;
	if (!id)
		id = "_watcher";
	return this.each(function() {
		var _t = this;
		var el$ = $(this);
		var fnc = function() {
			__watcher.call(_t, id)
		};
		var data = {
			id : id,
			props : props.split(","),
			vals : [ props.split(",").length ],
			func : func,
			fnc : fnc,
			origProps : props,
			interval : interval,
			intervalId : null
		};
		// store initial props and values
		$.each(data.props, function(i) {
			data.vals[i] = el$.css(data.props[i]);
		});
		el$.data(id, data);
		hookChange(el$, id, data);
	});
	function hookChange(el$, id, data) {
		el$.each(function() {
			var el = $(this);
			if (typeof (el.get(0).onpropertychange) == "object")
				el.bind("propertychange." + id, data.fnc);
			else if ($.browser.mozilla)
				el.bind("DOMAttrModified." + id, data.fnc);
			else
				data.intervalId = setInterval(data.fnc, interval);
		});
	}
	function __watcher(id) {
		var el$ = $(this);
		var w = el$.data(id);
		if (!w)
			return;
		var _t = this;
		if (!w.func)
			return;
		// must unbind or else unwanted recursion may occur
		el$.unwatch(id);
		var changed = false;
		var i = 0;
		for (i; i < w.props.length; i++) {
			var newVal = el$.css(w.props[i]);
			if (w.vals[i] != newVal) {
				w.vals[i] = newVal;
				changed = true;
				break;
			}
		}
		if (changed)
			w.func.call(_t, w, i);
		// rebind event
		hookChange(el$, id, w);
	}
}
$.fn.unwatch = function(id) {
	this.each(function() {
		var el = $(this);
		var data = el.data(id);
		try {
			if (typeof (this.onpropertychange) == "object")
				el.unbind("propertychange." + id, data.fnc);
			else if ($.browser.mozilla)
				el.unbind("DOMAttrModified." + id, data.fnc);
			else
				clearInterval(data.intervalId);
		}
		// ignore if element was already unbound
		catch (e) {
		}
	});
	return this;
}