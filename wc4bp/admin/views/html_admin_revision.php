<?php

if ( ! defined( 'ABSPATH' ) ) { exit; }

// Leaven empty tag to let automation add the path disclosure line
?>
<div class="notice review-notice active" id="wc4bp-ask-revision" style="">
	<div class="review-notice-logo"><span class="dashicons dashicons-chart-line"></span></div>
	<div class="review-notice-message">
		<strong>WC4BP</strong>  <br>
		<?php echo sprintf( esc_html__( ' Hey, you just updated to the %s version – that’s awesome!', 'wc4bp' ), esc_html( WC4BP_Loader::VERSION ) ); ?> <img draggable="false" class="emoji" alt="🎉" src="https://s.w.org/images/core/emoji/2.3/svg/1f389.svg"> <?php esc_html_e( ' Could you please do me a BIG favor and give it a 5-star rating on WordPress? Just to help us spread the word and boost our motivation.', 'wc4bp' ); ?><br/>
		~ <a target="_blank" href="https://www.themekraft.com/">ThemeKraft Team</a>
	</div>
	<div class="review-notice-cta">
		<button class="review-notice-dismiss" data-action="review">
			<?php esc_html_e( ' Ok, you deserve it', 'wc4bp' ); ?>
		</button>
		<button class="review-notice-dismiss" data-action="later">
			<?php esc_html_e( ' Nope, maybe later', 'wc4bp' ); ?>
		</button>
		<button class="review-notice-dismiss" data-action="already">
			<?php esc_html_e( ' I already did', 'wc4bp' ); ?>
		</button>
	</div>
</div>
