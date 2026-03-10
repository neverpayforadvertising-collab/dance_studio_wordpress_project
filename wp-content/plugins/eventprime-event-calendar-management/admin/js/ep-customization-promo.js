( function () {
    'use strict';

    var services = [
        {
            id: 'local-payment-gateway',
            title: 'Local Payment Gateway Support',
            body: 'Add or adapt local gateways with custom checkout rules, callback handling, and event-specific payment flow behavior.',
            tags: [ 'payments', 'gateway', 'checkout', 'stripe', 'paypal' ]
        },
        {
            id: 'third-party-integrations',
            title: '3rd-Party Integrations',
            body: 'Sync EventPrime data with CRMs, ERP, marketing tools, and internal systems using API-based or webhook-based connections.',
            tags: [ 'integrations', 'api', 'webhook', 'crm' ]
        },
        {
            id: 'registration-workflow',
            title: 'Registration Workflow Modifications',
            body: 'Replace workaround-heavy flows with conditional steps, approvals, and event-specific logic for cleaner operations.',
            tags: [ 'workflow', 'registration', 'approval', 'logic' ]
        },
        {
            id: 'mobile-feature-additions',
            title: 'Mobile App Feature Additions',
            body: 'Extend EventPrime mobile check-in capabilities for role-based actions, custom scan behavior, and on-ground processes.',
            tags: [ 'mobile', 'check-in', 'scanner', 'app' ]
        },
        {
            id: 'custom-seating-layouts',
            title: 'Custom Seating Layouts',
            body: 'For complex seating setups, we can handcraft seat maps, zone behavior, and booking rules to match your exact venue operation.',
            tags: [ 'seating', 'layout', 'venue', 'seats' ]
        },
        {
            id: 'ticket-qr',
            title: 'Ticket and QR Experience Enhancements',
            body: 'Improve ticket validation and entry flow with custom QR behavior, scan rules, and ticket metadata logic.',
            tags: [ 'ticket', 'qr', 'entry', 'checkin' ]
        },
        {
            id: 'notification-automation',
            title: 'Notification and Messaging Automation',
            body: 'Set up custom email and SMS triggers, conditional templates, and event-driven notification flows.',
            tags: [ 'email', 'sms', 'notification', 'automation' ]
        },
        {
            id: 'data-reports',
            title: 'Data Exports and Reporting',
            body: 'Build custom exports and operational reporting views for finance, attendance, and organizer workflows.',
            tags: [ 'reporting', 'exports', 'data' ]
        },
        {
            id: 'role-based-admin-workflows',
            title: 'Role-Based Admin Workflows',
            body: 'Set up role-specific event management flows so each admin user sees only the tools and actions relevant to their responsibilities.',
            tags: [ 'roles', 'permissions', 'admin', 'workflow' ]
        },
        {
            id: 'multi-event-registration-rules',
            title: 'Multi-Event Registration Rules',
            body: 'Build registration logic for linked events, bundled passes, and event-series constraints across multiple schedules.',
            tags: [ 'multi-event', 'series', 'registration', 'rules' ]
        },
        {
            id: 'custom-pricing-discount-models',
            title: 'Custom Pricing and Discount Models',
            body: 'Create pricing rules with conditional discounts, tier-based pricing, and event-specific checkout calculations.',
            tags: [ 'pricing', 'discount', 'rules', 'checkout' ]
        },
        {
            id: 'attendee-access-flows',
            title: 'Attendee Account and Access Flows',
            body: 'Customize attendee account actions, access control, and post-booking user journeys for your event process.',
            tags: [ 'attendee', 'account', 'access', 'journey' ]
        },
        {
            id: 'location-timezone-logic',
            title: 'Location and Timezone Booking Logic',
            body: 'Support region-aware booking behavior with custom timezone handling and location-specific event display rules.',
            tags: [ 'location', 'timezone', 'regional', 'booking' ]
        },
        {
            id: 'organizer-partner-portal',
            title: 'Organizer and Partner Portal Extensions',
            body: 'Build dedicated workflows for organizers, partners, or contributors with custom submission and management views.',
            tags: [ 'organizer', 'partner', 'portal', 'submission' ]
        },
        {
            id: 'legacy-migration-bridges',
            title: 'Legacy System Migration Bridges',
            body: 'Create migration and sync bridges from legacy tools so your event data moves cleanly into EventPrime workflows.',
            tags: [ 'legacy', 'migration', 'sync', 'data' ]
        },
        {
            id: 'large-event-performance',
            title: 'Performance Optimization for Large Events',
            body: 'Optimize heavy event workflows for scale, including high attendee volume, complex queries, and operational load.',
            tags: [ 'performance', 'scale', 'large events', 'optimization' ]
        },
        {
            id: 'custom-requirement',
            title: 'Custom Requirement (Not listed here)',
            body: 'If your use case does not match any card, share your requirement and we will scope a custom EventPrime solution for it.',
            tags: [ 'custom', 'requirement', 'other', 'not listed', 'unique' ]
        }
    ];

    function escapeHtml( text ) {
        return String( text ).replace( /[&<>"']/g, function ( ch ) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                '\'': '&#39;'
            }[ ch ];
        } );
    }

    function getServiceIcon( id ) {
        var icon = 'dashicons-admin-generic';
        var tone = 'blue';

        if ( id.indexOf( 'payment' ) !== -1 || id.indexOf( 'pricing' ) !== -1 ) {
            icon = 'dashicons-money-alt';
            tone = 'mint';
        } else if ( id.indexOf( 'integrat' ) !== -1 || id.indexOf( 'api' ) !== -1 || id.indexOf( 'webhook' ) !== -1 ) {
            icon = 'dashicons-randomize';
            tone = 'violet';
        } else if ( id.indexOf( 'mobile' ) !== -1 || id.indexOf( 'app' ) !== -1 ) {
            icon = 'dashicons-smartphone';
            tone = 'blue';
        } else if ( id.indexOf( 'seating' ) !== -1 || id.indexOf( 'venue' ) !== -1 ) {
            icon = 'dashicons-tickets-alt';
            tone = 'peach';
        } else if ( id.indexOf( 'ticket' ) !== -1 || id.indexOf( 'qr' ) !== -1 || id.indexOf( 'checkin' ) !== -1 ) {
            icon = 'dashicons-tickets';
            tone = 'violet';
        } else if ( id.indexOf( 'report' ) !== -1 || id.indexOf( 'data' ) !== -1 || id.indexOf( 'export' ) !== -1 ) {
            icon = 'dashicons-chart-bar';
            tone = 'blue';
        } else if ( id.indexOf( 'role' ) !== -1 || id.indexOf( 'access' ) !== -1 || id.indexOf( 'account' ) !== -1 ) {
            icon = 'dashicons-lock';
            tone = 'mint';
        } else if ( id.indexOf( 'custom-requirement' ) !== -1 ) {
            icon = 'dashicons-star-filled';
            tone = 'peach';
        }

        return '<span class="ep-card-icon ep-card-icon-' + tone + '"><span class="dashicons ' + icon + '" aria-hidden="true"></span></span>';
    }

    function renderServiceCard( service ) {
        var title = escapeHtml( service.title );
        var body = escapeHtml( service.body );
        var icon = getServiceIcon( service.id || '' );
        var ctaUrl = buildTrackedUrl( 'service_card_' + ( service.id || 'general' ) );

        return '<article class="ep-service-card">' +
            '<div class="ep-card-head">' +
            '<span class="ep-card-icon-wrap">' + icon + '</span>' +
            '<span class="ep-card-head-text">' + title + '</span>' +
            '</div>' +
            '<div class="ep-card-body">' + body + '</div>' +
            '<div class="ep-card-meta"><a href="' + ctaUrl + '" class="ep-card-cta" target="_blank" rel="noopener noreferrer">Discuss this requirement</a></div>' +
            '</article>';
    }

    function renderFallbackCard( query ) {
        var suffix = query ? ' (' + escapeHtml( query ) + ')' : '';
        var icon = getServiceIcon( 'custom-requirement' );
        var ctaUrl = buildTrackedUrl( 'custom_fallback_card' );

        return '<article class="ep-service-card ep-custom-fallback">' +
            '<div class="ep-card-head">' +
            '<span class="ep-card-icon-wrap">' + icon + '</span>' +
            '<span class="ep-card-head-text">Could not find an exact match?</span>' +
            '</div>' +
            '<div class="ep-card-body">Tell us what you need and we will scope a custom EventPrime feature or workflow for your requirement' + suffix + '.</div>' +
            '<div class="ep-card-meta"><a href="' + ctaUrl + '" class="ep-card-cta" target="_blank" rel="noopener noreferrer">Discuss your requirement</a></div>' +
            '</article>';
    }

    function renderErrorFallbackCard() {
        var icon = getServiceIcon( 'custom-requirement' );
        var ctaUrl = buildTrackedUrl( 'search_error_fallback' );

        return '<article class="ep-service-card ep-custom-fallback">' +
            '<div class="ep-card-head">' +
            '<span class="ep-card-icon-wrap">' + icon + '</span>' +
            '<span class="ep-card-head-text">Could not load results</span>' +
            '</div>' +
            '<div class="ep-card-body">Please retry your search or continue with a direct customization request.</div>' +
            '<div class="ep-card-meta"><a href="' + ctaUrl + '" class="ep-card-cta" target="_blank" rel="noopener noreferrer">Open customization services</a></div>' +
            '</article>';
    }

    function filterServices( query ) {
        var normalized = String( query || '' ).trim().toLowerCase();

        if ( ! normalized ) {
            return services.slice();
        }

        return services.filter( function ( service ) {
            var haystack = [ service.title, service.body, ( service.tags || [] ).join( ' ' ) ].join( ' ' ).toLowerCase();
            return haystack.indexOf( normalized ) !== -1;
        } );
    }

    function buildTrackedUrl( placementKey ) {
        var config = window.ep_customization_promo || {};
        var baseUrl = config.base_url || 'https://theeventprime.com/customizations/';
        var tracked = new URL( baseUrl );

        tracked.searchParams.set( 'utm_source', config.utm_source || 'eventprime_admin' );
        tracked.searchParams.set( 'utm_medium', config.utm_medium || 'plugin_services_page' );
        tracked.searchParams.set( 'utm_campaign', config.utm_campaign || 'customizations_cta' );
        tracked.searchParams.set( 'utm_content', placementKey );

        return tracked.toString();
    }

    function bootPromoPage() {
        var cardsContainer = document.getElementById( 'ep-cards-container' );
        var searchInput = document.getElementById( 'ep-service-search' );
        var requestButton = document.querySelector( '.ep-request-button' );
        var timer = null;

        if ( ! cardsContainer || ! searchInput ) {
            return;
        }

        function runSearch( query ) {
            try {
                var filtered = filterServices( query );

                if ( ! filtered.length ) {
                    cardsContainer.innerHTML = renderFallbackCard( query );
                    return;
                }

                cardsContainer.innerHTML = filtered.map( renderServiceCard ).join( '' );
            } catch ( err ) {
                cardsContainer.innerHTML = renderErrorFallbackCard();
            }
        }

        function debounceSearch() {
            clearTimeout( timer );
            timer = setTimeout( function () {
                runSearch( searchInput.value );
            }, 180 );
        }

        if ( requestButton ) {
            var requestPlacement = requestButton.getAttribute( 'data-placement-key' ) || 'request_card_bottom';
            requestButton.setAttribute( 'href', buildTrackedUrl( requestPlacement ) );
        }

        searchInput.addEventListener( 'input', debounceSearch );
        runSearch( '' );
    }

    if ( document.readyState === 'loading' ) {
        document.addEventListener( 'DOMContentLoaded', bootPromoPage );
    } else {
        bootPromoPage();
    }
}() );
