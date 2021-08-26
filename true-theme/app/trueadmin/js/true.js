jQuery( document ).ready(function( $ ) 
{	
		// Toastr
		
		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "positionClass": "toast-top-right",
		  "onclick": null,
		  "showDuration": "1000",
		  "hideDuration": "1000",
		  "timeOut": "5000",
		  "extendedTimeOut": "1000",
		  "showEasing": "swing",
		  "hideEasing": "linear",
		  "showMethod": "fadeIn",
		  "hideMethod": "fadeOut"
		}

		
		// Loading overlay
		$(window).load(function() {
			$('#loading-overlay').hide();
		});
		
		if ($('#notif-wrapper').length> 0) {
			$('.notif').each(function() {
				var type = $(this).data('notif-type');

				if (type == 'success') {
					toastr.success($(this).text());
				}
				else if (type == 'warning') {
					toastr.warning($(this).text());
				}
				else if (type == 'info') {
					toastr.info($(this).text());
				}
				else if (type == 'error') {
					toastr.error($(this).text());
				}
			});

			// Time to go
			$('#notif-wrapper').remove();
		}

		// Initiate select2 on selects
		$('form select').select2();

		// Bootstrap global tooltip binding
		$('body').tooltip({
		    selector: '[data-toggle="tooltip"]'
		});

		// Bootstrap Switch on assigned classes
		$('.bs').bootstrapSwitch();

		// Default BlockUI Options
		$.blockUI.defaults = {
			theme: false,
			message: '<h5>Loading..</h5>',
			// styles for the message when blocking; if you wish to disable 
		    // these and use an external stylesheet then do this in your code: 
		    // $.blockUI.defaults.css = {}; 
		    css: { 
		        padding:        0, 
		        margin:         0, 
		        width:          '30%', 
		        top:            '40%', 
		        left:           '35%', 
		        textAlign:      'center', 
		        color:          '#000', 
		        border:         '3px solid #aaa', 
		        backgroundColor:'#fff', 
		        cursor:         'wait' 
		    }, 
		 
		    // minimal style set used when themes are used 
		    themedCSS: { 
		        width:  '30%', 
		        top:    '40%', 
		        left:   '35%' 
		    }, 
		 
		    // styles for the overlay 
		    overlayCSS:  { 
		        backgroundColor: '#fff', 
		        opacity:         0.6, 
		        cursor:          'wait' 
		    }, 

		    blockMsgClass: 'blockMsg',
		    showOverlay: true, 
		};


		// Global Confirm on delete on assigned class
		$('.ajaxConfirmDelete').each(function() {
			$self = $(this);

			var deleteAjaxUrl = $self.data('ajax-delete-url');
			var deleteID = $self.data('delete-id');

			var ajaxData = {
				pk: deleteID
			};

			$self.confirmDialog({
				ajaxUrl : ajaxurl + '?action=' + deleteAjaxUrl, // Wordpress ajax url is used here
				ajaxData: ajaxData,
				success: function() {
				},
			});
		});
	
	$('body').on('click', '.portlet > .portlet-title > .tools > .collapse, .portlet .portlet-title > .tools > .expand', function (e) {
        e.preventDefault();
        var el = jQuery(this).closest(".portlet").children(".portlet-body");
        if (jQuery(this).hasClass("collapse")) {
            jQuery(this).removeClass("collapse").addClass("expand");
            el.slideUp(200);
        } else {
            jQuery(this).removeClass("expand").addClass("collapse");
            el.slideDown(200);
        }
    });
    
    $('.reports-filters > .portlet-title.click-able').click(function(e)
    {
        var $button = $(this).find('.tools > a');
        var el = $button.closest(".portlet").children(".portlet-body");
        if ($button.hasClass("collapse")) {
            $button.removeClass("collapse").addClass("expand");
            el.slideUp(200);
        } else {
            $button.removeClass("expand").addClass("collapse");
            el.slideDown(200);
        }
        return false;
    });
});
