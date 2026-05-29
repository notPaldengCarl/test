/**
 * VØID ROASTERS — Motion Engine
 *
 * Progressive enhancement for scroll-reveal animations.
 * Uses IntersectionObserver to add .in-view class only on browsers
 * that lack native CSS animation-timeline: view() support.
 *
 * @package VØID_ROASTERS
 * @since   1.3.0
 */

( function () {
	'use strict';

	// Feature detection: if the browser supports animation-timeline, skip JS.
	var supportsScrollTimeline = CSS && CSS.supports && CSS.supports( 'animation-timeline', 'view()' );

	if ( supportsScrollTimeline ) {
		return;
	}

	// Wait for DOM to be ready, then idle.
	function onReady( callback ) {
		if ( document.readyState === 'loading' ) {
			document.addEventListener( 'DOMContentLoaded', callback );
		} else {
			callback();
		}
	}

	onReady( function () {
		// Use requestIdleCallback if available, otherwise requestAnimationFrame.
		var schedule = window.requestIdleCallback || window.requestAnimationFrame;

		schedule( function () {
			var reveals = document.querySelectorAll( '.reveal' );

			if ( ! reveals.length ) {
				return;
			}

			var observer = new IntersectionObserver(
				function ( entries ) {
					entries.forEach( function ( entry ) {
						if ( entry.isIntersecting ) {
							entry.target.classList.add( 'in-view' );
							observer.unobserve( entry.target );
						}
					} );
				},
				{
					threshold: 0.15,
					rootMargin: '0px 0px -50px 0px',
				}
			);

			reveals.forEach( function ( el ) {
				observer.observe( el );
			} );
		} );
	} );
} )();