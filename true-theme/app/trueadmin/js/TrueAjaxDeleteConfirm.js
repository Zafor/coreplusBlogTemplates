/*
Copyright (c) 2011 Damien Antipa, http://www.nethead.at/, http://damien.antipa.at

This code is edited by Jofry HS
- Updated to bootstrap 3
- Added AJAX support

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
/*
 * jQuery Plugin: jQuery AJAX Delete Confirmation Dialog
 * 
 * Requirements: jQuery 1.6.4, Bootstrap 1.3.0
 * http://jquery.com/
 * http://twitter.github.com/bootstrap/
 * 
 * This Plugin can be used for anchors, to show a confirmation popup before redirecting to the link or do ajax delete
 * 
 */
(function($){
	$.fn.extend({
		confirmDialog: function(options) {
			var defaults = {
				message: '<strong>Are you sure</strong>',				
				dialog: '<div id="confirm-dialog" class="popover top">' +
							'<div class="arrow"></div>' +
							'<h3 class="popover-title">Confirmation</h3>' +
							'<div class="inner">' +
							'<div class="popover-content">' +
							  		'<p class="message"></p>' +
									'<p class="button-group"><a href="#!" class="btn btn-xs btn-danger"></a><a href="#!" class="btn btn-info btn-xs"></a></p>' +
							'</div>' +
							'</div>' +
						'</div>',
				cancelButton: 'Cancel',
				confirmButton: 'Yes',
				ajaxUrl: '',
				ajaxData: {},
				success: function() {return;},
				error: function() {return;},
				always: function() {return;},

			};
			var options =  $.extend(defaults, options);
			
			return this.each(function() {
				var o = options;
				var $elem = $(this)
				
				$elem.bind('click', function(e) {
					e.preventDefault();
					if(!$('#confirm-dialog').length) {
						
						var offset = $elem.offset();
						var $dialog = $(o.dialog).appendTo('body');
						
						var x;
						if(offset.left > $dialog.width()) {
							//dialog can be left
							x = e.pageX - $dialog.width();
							$dialog.addClass('left');
						} else {
							x = e.pageX;
							$dialog.addClass('right');
						}
						var y = e.pageY - $dialog.height() / 2 - $elem.innerHeight() / 2;
	
						$dialog.css({
							display: 'block',
							position: 'absolute',
							top: y,
							left: x
						});
						
						$dialog.find('p.button-group').css({
							marginTop: '5px',
							textAlign: 'right'
						});

						$dialog.find('a.btn').css({
							marginLeft: '3px'
						});
						
						$dialog.find('p.message').html(o.message);
						
						$dialog.find('a.btn:eq(0)').text(o.confirmButton).bind('click', function(e) {
							var ajaxUrl = o.ajaxUrl;
							var ajaxData = o.ajaxData;
							if (o.ajaxUrl.length > 0) {
								$.post(ajaxUrl, ajaxData)
										.done(function() {
											$tr = $elem.parents('tr').eq(0);

											$dialog.fadeOut('fast', function() {
												$dialog.remove();
											});

											$tr.fadeOut('fast');

											o.success;
										})
										.always(o.always)
										.fail(o.error);
							}
							else {
								window.location.href = $elem.attr('href');
							}
						});
						
						$dialog.find('a.btn:eq(1)').text(o.cancelButton).bind('click', function(e) {
							$dialog.remove();
						});
						
						$dialog.bind('mouseleave', function() {
							$dialog.fadeOut('slow', function() {
								$dialog.remove();
							});
						});
					}
				});
			});
		}
	});   
})(jQuery);