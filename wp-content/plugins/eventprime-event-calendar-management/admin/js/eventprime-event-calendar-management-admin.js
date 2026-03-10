(function( $ ) {
	'use strict';
        $( ".ep-dismissible" ).on( 'click', function() {
            var notice_name = $( this ).attr( 'id' );
            var data        = {'action': 'ep_dismissible_notice','notice_name': notice_name,'nonce':ep_ajax_object.nonce};
            $.post(
                ep_ajax_object.ajax_url,
                data,
                function(response) {

                });
        });

        $( document ).on( 'click', '.ep-license-notice .notice-dismiss', function() {
            var noticeWrapper = $( this ).closest( '.ep-license-notice' );
            var noticeType    = noticeWrapper.data( 'notice-type' );
            //console.log(noticeType);
            if ( ! noticeType ) {
                return;
            }

            $.post(
                ep_ajax_object.ajax_url,
                {
                    action: 'ep_dismiss_license_notice',
                    notice_type: noticeType,
                    nonce: ep_ajax_object.nonce
                }
            );
        } );

        // Add submenu icon for Services only when the Material icon font is available.
        function epInjectServicesMenuIcon() {
            var servicesMenu = document.querySelector( '#adminmenu .wp-submenu a[href$="page=ep-customization-promo"]' );
            if ( ! servicesMenu ) {
                return;
            }

            if ( servicesMenu.querySelector( '.material-icons' ) ) {
                return;
            }

            if ( document.fonts && document.fonts.check && ! document.fonts.check( '16px "Material Icons"' ) ) {
                return;
            }

            var icon = document.createElement( 'span' );
            icon.className = 'material-icons';
            icon.setAttribute( 'aria-hidden', 'true' );
            icon.style.fontSize = '16px';
            icon.style.verticalAlign = '-2px';
            icon.style.marginRight = '6px';
            icon.textContent = 'build';
            servicesMenu.prepend( icon );
        }

       // epInjectServicesMenuIcon();
        if ( document.fonts && document.fonts.ready ) {
            document.fonts.ready.then( epInjectServicesMenuIcon );
        }

})( jQuery );
