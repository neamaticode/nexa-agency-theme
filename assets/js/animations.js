/* ==============================================
   ANIMATIONS JS - NexaAgency Theme
   AOS initialization & custom effects
   ============================================== */

( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {

		// ------------------------------------------
		// Initialize AOS (Animate On Scroll)
		// ------------------------------------------
		if ( 'undefined' !== typeof AOS ) {
			AOS.init( {
				duration:   800,
				easing:     'ease-in-out',
				once:       true,
				offset:     100,
				disable:    window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches,
			} );
		}

		// ------------------------------------------
		// Parallax effect for hero section
		// ------------------------------------------
		const hero       = document.querySelector( '.nexa-hero' );
		const heroShapes = document.querySelectorAll( '.nexa-hero__shape' );

		if ( hero && heroShapes.length ) {
			window.addEventListener( 'scroll', function () {
				const scrolled = window.scrollY;
				if ( scrolled > hero.offsetHeight ) {
					return;
				}
				heroShapes.forEach( function ( shape, index ) {
					const speed  = 0.08 + index * 0.04;
					const yPos   = scrolled * speed;
					shape.style.transform = 'translateY(' + yPos + 'px)';
				} );
			}, { passive: true } );
		}

		// ------------------------------------------
		// Testimonials simple carousel
		// ------------------------------------------
		const testimonialCards = document.querySelectorAll( '.nexa-testimonial-card' );
		let currentCard        = 0;
		let carouselInterval   = null;

		if ( testimonialCards.length > 1 && isNarrowScreen() ) {
			testimonialCards.forEach( function ( card, i ) {
				if ( i > 0 ) {
					card.style.display = 'none';
				}
			} );

			carouselInterval = setInterval( function () {
				testimonialCards[ currentCard ].style.display = 'none';
				currentCard = ( currentCard + 1 ) % testimonialCards.length;
				testimonialCards[ currentCard ].style.display = '';
				testimonialCards[ currentCard ].style.animation = 'fadeIn 0.5s ease';
			}, 4000 );
		}

		/**
		 * Check if viewport is considered narrow (mobile carousel).
		 *
		 * @return {boolean} True if width <= 768px.
		 */
		function isNarrowScreen() {
			return window.innerWidth <= 768;
		}

		// Stop carousel if screen is resized to wide
		window.addEventListener( 'resize', function () {
			if ( ! isNarrowScreen() && carouselInterval ) {
				clearInterval( carouselInterval );
				testimonialCards.forEach( function ( card ) {
					card.style.display = '';
					card.style.animation = '';
				} );
			}
		} );

		// ------------------------------------------
		// Pricing toggle (monthly / annual)
		// ------------------------------------------
		const pricingToggle  = document.querySelector( '.nexa-pricing-toggle' );
		const priceAmounts   = document.querySelectorAll( '.nexa-pricing-card__amount[data-monthly]' );

		if ( pricingToggle && priceAmounts.length ) {
			pricingToggle.addEventListener( 'change', function () {
				const isAnnual = pricingToggle.checked;

				priceAmounts.forEach( function ( el ) {
					const monthly = el.dataset.monthly;
					const annual  = el.dataset.annual;

					if ( isAnnual && annual ) {
						el.textContent = annual;
					} else if ( monthly ) {
						el.textContent = monthly;
					}
				} );

				const periodLabels = document.querySelectorAll( '.nexa-pricing-card__period' );
				periodLabels.forEach( function ( label ) {
					label.textContent = isAnnual ? '/year' : '/month';
				} );
			} );
		}

	} );

} )();
