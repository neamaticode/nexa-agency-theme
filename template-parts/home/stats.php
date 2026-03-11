<?php
/**
 * Stats section template part.
 *
 * @package NexaAgency
 */

$stats = array(
	array(
		'icon'   => '🏆',
		'count'  => nexa_get_customizer( 'stat1_number', '250' ),
		'suffix' => '+',
		'label'  => nexa_get_customizer( 'stat1_label', esc_html__( 'Projects Completed', 'nexa-agency' ) ),
	),
	array(
		'icon'   => '😊',
		'count'  => nexa_get_customizer( 'stat2_number', '180' ),
		'suffix' => '+',
		'label'  => nexa_get_customizer( 'stat2_label', esc_html__( 'Happy Clients', 'nexa-agency' ) ),
	),
	array(
		'icon'   => '📅',
		'count'  => nexa_get_customizer( 'stat3_number', '8' ),
		'suffix' => '+',
		'label'  => nexa_get_customizer( 'stat3_label', esc_html__( 'Years Experience', 'nexa-agency' ) ),
	),
	array(
		'icon'   => '👥',
		'count'  => nexa_get_customizer( 'stat4_number', '24' ),
		'suffix' => '+',
		'label'  => nexa_get_customizer( 'stat4_label', esc_html__( 'Team Members', 'nexa-agency' ) ),
	),
);
?>
<section class="nexa-stats" aria-label="<?php esc_attr_e( 'Company statistics', 'nexa-agency' ); ?>">
	<div class="nexa-container">
		<div class="nexa-stats__grid">
			<?php foreach ( $stats as $index => $stat ) : ?>
				<div
					class="nexa-stats__item"
					data-aos="fade-up"
					data-aos-delay="<?php echo esc_attr( $index * 100 ); ?>"
				>
					<span class="nexa-stats__icon" aria-hidden="true"><?php echo esc_html( $stat['icon'] ); ?></span>
					<div class="nexa-stats__number">
						<span
							class="nexa-counter"
							data-count="<?php echo esc_attr( absint( $stat['count'] ) ); ?>"
							data-suffix="<?php echo esc_attr( $stat['suffix'] ); ?>"
						>
							<?php echo esc_html( $stat['count'] . $stat['suffix'] ); ?>
						</span>
					</div>
					<div class="nexa-stats__label"><?php echo esc_html( $stat['label'] ); ?></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
