(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	function setAvatar(e) {
		const avatar = $(e.currentTarget).data('url');
		const messageContainer = $('.giphy-message');

		const url = giphy.url;
		const data = {
			'avatar': avatar,
			'nonce': giphy.nonce,
			'action': giphy.action
		};

		$.post(url, data, function (response) {

			const responseData = JSON.parse(response);
			
			if (responseData.status) {

				messageContainer.addClass(responseData.status);
				messageContainer.text(responseData.message);
				messageContainer.show();
				
				setInterval(function () {
					messageContainer.hide();
					messageContainer.removeClass(responseData.status);
				}, 5000);
			}
		})
	}

	$(function () {
		const grid = $('ul.giphy-grid');
		
		if (grid.length > 0) {
			grid.on("click", '.handler', setAvatar);
		}		
	});	

})( jQuery );
