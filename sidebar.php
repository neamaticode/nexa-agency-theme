<?php
/**
 * Sidebar template.
 *
 * @package NexaAgency
 */

if ( ! is_active_sidebar( 'sidebar-main' ) ) {
	return;
}
?>
<aside id="secondary" class="nexa-sidebar widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-main' ); ?>
</aside>
