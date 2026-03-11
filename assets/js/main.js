/* ==============================================
   MAIN JAVASCRIPT - NexaAgency Theme
   Vanilla JS, no jQuery dependency
   ============================================== */

( function () {
	'use strict';

	document.addEventListener( 'DOMContentLoaded', function () {

		// ------------------------------------------
		// Preloader
		// ------------------------------------------
		const preloader = document.querySelector( '.nexa-preloader' );
		if ( preloader ) {
			window.addEventListener( 'load', function () {
				preloader.classList.add( 'is-hidden' );
				setTimeout( function () {
					preloader.remove();
				}, 600 );
			} );
		}

		// ------------------------------------------
		// Sticky header on scroll
		// ------------------------------------------
		const header = document.querySelector( '.nexa-header' );
		if ( header ) {
			const handleHeaderScroll = function () {
				if ( window.scrollY > 50 ) {
					header.classList.add( 'scrolled' );
				} else {
					header.classList.remove( 'scrolled' );
				}
			};
			window.addEventListener( 'scroll', handleHeaderScroll, { passive: true } );
			handleHeaderScroll();
		}

		// ------------------------------------------
		// Hamburger menu toggle
		// ------------------------------------------
		const hamburger  = document.querySelector( '.nexa-hamburger' );
		const mobileNav  = document.querySelector( '.nexa-mobile-nav' );

		if ( hamburger && mobileNav ) {
			hamburger.addEventListener( 'click', function () {
				const isOpen = hamburger.classList.toggle( 'is-active' );
				mobileNav.classList.toggle( 'is-open', isOpen );
				hamburger.setAttribute( 'aria-expanded', String( isOpen ) );
				document.body.style.overflow = isOpen ? 'hidden' : '';
			} );

			// Close menu on outside click
			document.addEventListener( 'click', function ( e ) {
				if (
					mobileNav.classList.contains( 'is-open' ) &&
					! mobileNav.contains( e.target ) &&
					! hamburger.contains( e.target )
				) {
					hamburger.classList.remove( 'is-active' );
					mobileNav.classList.remove( 'is-open' );
					hamburger.setAttribute( 'aria-expanded', 'false' );
					document.body.style.overflow = '';
				}
			} );

			// Close mobile menu on link click
			const mobileNavLinks = mobileNav.querySelectorAll( 'a' );
			mobileNavLinks.forEach( function ( link ) {
				link.addEventListener( 'click', function () {
					hamburger.classList.remove( 'is-active' );
					mobileNav.classList.remove( 'is-open' );
					hamburger.setAttribute( 'aria-expanded', 'false' );
					document.body.style.overflow = '';
				} );
			} );

			// Close on Escape key
			document.addEventListener( 'keydown', function ( e ) {
				if ( 'Escape' === e.key && mobileNav.classList.contains( 'is-open' ) ) {
					hamburger.classList.remove( 'is-active' );
					mobileNav.classList.remove( 'is-open' );
					hamburger.setAttribute( 'aria-expanded', 'false' );
					document.body.style.overflow = '';
				}
			} );
		}

		// ------------------------------------------
		// Smooth scroll for anchor links
		// ------------------------------------------
		document.querySelectorAll( 'a[href^="#"]' ).forEach( function ( anchor ) {
			anchor.addEventListener( 'click', function ( e ) {
				const href = anchor.getAttribute( 'href' );
				if ( '#' === href || '' === href ) {
					return;
				}
				const target = document.querySelector( href );
				if ( target ) {
					e.preventDefault();
					const headerOffset = header ? header.offsetHeight : 80;
					const targetTop    = target.getBoundingClientRect().top + window.scrollY - headerOffset;
					window.scrollTo( {
						top:      targetTop,
						behavior: 'smooth',
					} );
				}
			} );
		} );

		// ------------------------------------------
		// Scroll-to-top button
		// ------------------------------------------
		const scrollTopBtn = document.querySelector( '.nexa-scroll-top' );
		if ( scrollTopBtn ) {
			window.addEventListener( 'scroll', function () {
				if ( window.scrollY > 400 ) {
					scrollTopBtn.classList.add( 'visible' );
				} else {
					scrollTopBtn.classList.remove( 'visible' );
				}
			}, { passive: true } );

			scrollTopBtn.addEventListener( 'click', function () {
				window.scrollTo( { top: 0, behavior: 'smooth' } );
			} );
		}

		// ------------------------------------------
		// Active nav link highlight based on scroll
		// ------------------------------------------
		const sections   = document.querySelectorAll( 'section[id]' );
		const navLinks   = document.querySelectorAll( '.nexa-nav__menu a, .nexa-mobile-nav__menu a' );

		const setActiveNavLink = function () {
			if ( ! sections.length || ! navLinks.length ) {
				return;
			}
			const scrollPos = window.scrollY + ( header ? header.offsetHeight : 80 ) + 80;
			let current     = '';

			sections.forEach( function ( section ) {
				if ( scrollPos >= section.offsetTop ) {
					current = section.id;
				}
			} );

			navLinks.forEach( function ( link ) {
				link.parentElement.classList.remove( 'active' );
				const href = link.getAttribute( 'href' );
				if ( href && href === '#' + current ) {
					link.parentElement.classList.add( 'active' );
				}
			} );
		};

		if ( sections.length && navLinks.length ) {
			window.addEventListener( 'scroll', setActiveNavLink, { passive: true } );
			setActiveNavLink();
		}

		// ------------------------------------------
		// Portfolio filter buttons
		// ------------------------------------------
		const filterBtns  = document.querySelectorAll( '.nexa-filter-btn' );
		const portfolioItems = document.querySelectorAll( '.nexa-portfolio__item' );

		if ( filterBtns.length && portfolioItems.length ) {
			filterBtns.forEach( function ( btn ) {
				btn.addEventListener( 'click', function () {
					// Update active state
					filterBtns.forEach( function ( b ) {
						b.classList.remove( 'is-active' );
					} );
					btn.classList.add( 'is-active' );

					const filter = btn.dataset.filter || 'all';

					portfolioItems.forEach( function ( item ) {
						if ( 'all' === filter || item.dataset.category === filter ) {
							item.classList.remove( 'is-hidden' );
						} else {
							item.classList.add( 'is-hidden' );
						}
					} );
				} );
			} );
		}

		// ------------------------------------------
		// Counter animation (IntersectionObserver)
		// ------------------------------------------
		const counters = document.querySelectorAll( '.nexa-counter' );

		if ( counters.length && 'IntersectionObserver' in window ) {
			const counterObserver = new IntersectionObserver(
				function ( entries ) {
					entries.forEach( function ( entry ) {
						if ( entry.isIntersecting ) {
							animateCounter( entry.target );
							counterObserver.unobserve( entry.target );
						}
					} );
				},
				{ threshold: 0.5 }
			);

			counters.forEach( function ( counter ) {
				counterObserver.observe( counter );
			} );
		}

		/**
		 * Animate a counter element from 0 to its data-count value.
		 *
		 * @param {HTMLElement} el Counter element.
		 */
		function animateCounter( el ) {
			const target   = parseInt( el.dataset.count, 10 );
			const suffix   = el.dataset.suffix || '';
			const duration = 2000;
			const start    = performance.now();

			el.classList.add( 'counting' );

			const step = function ( timestamp ) {
				const progress = Math.min( ( timestamp - start ) / duration, 1 );
				const eased    = easeOutCubic( progress );
				const current  = Math.floor( eased * target );

				el.textContent = current.toLocaleString() + suffix;

				if ( progress < 1 ) {
					requestAnimationFrame( step );
				} else {
					el.textContent = target.toLocaleString() + suffix;
					el.classList.remove( 'counting' );
				}
			};

			requestAnimationFrame( step );
		}

		/**
		 * Ease out cubic function.
		 *
		 * @param {number} t Progress 0-1.
		 * @return {number} Eased value.
		 */
		function easeOutCubic( t ) {
			return 1 - Math.pow( 1 - t, 3 );
		}

	} );

} )();
