<?php
/**
 * Template Name: HomePage
 *
 * @package ThemeVision
 * @subpackage Agama
 * @since 1.0
 */

get_header(); ?>
	<div class="fullscreen">
		<?php the_post_thumbnail('full'); ?>
		<div class="info">
			<?php $postHighline = get_post_meta(get_the_ID(), 'cancarner_highline', TRUE); ?>

			<h3>Arrelem a Can Carner<i></i>!</h3>
			<?php if($postHighline): ?>
				<h1><?=$postHighline?></h1>
			<?php endif; ?>
			<a class="btn">Saber més</a>
		</div>
	</div>
	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); $widget = 'page-widget-' . esc_attr( get_the_ID() ); ?>

                <?php if( is_active_sidebar( $widget ) ): ?>

                    <?php dynamic_sidebar( $widget ); ?>

                    <?php do_action( 'agama_add_widget', get_the_ID() ); ?>

                <?php else: ?>

                    <?php get_template_part( 'content', 'page' ); ?>
				    <?php comments_template( '', true ); ?>

                <?php endif; ?>


			<?php endwhile; // end of the loop. ?>

		</div>
	</div>

<?php get_footer(); ?>
