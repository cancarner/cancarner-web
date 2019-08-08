<?php
/**
 * Template Name: HomePage
 *
 * @package ThemeVision
 * @subpackage Agama
 * @since 1.0
 */

get_header();

$videoMp4 = get_post_meta(get_the_ID(), 'cancarner_background_mp4', TRUE);
$videoWebm = get_post_meta(get_the_ID(), 'cancarner_background_webm', TRUE);
$videoOgg = get_post_meta(get_the_ID(), 'cancarner_background_ogg', TRUE);

?>
	<div class="fullscreen">
		<div class="thumbnail-mobile">
			<?php the_post_thumbnail('full'); ?>
		</div>
		<div class="video-wrapper">
			<video autoplay muted loop>
			  <?= $videoMp4 ? '<source src="'. $videoMp4 .'" type="video/mp4">' : ''; ?>
			  <?= $videoWebm ? '<source src="'. $videoWebm .'" type="video/webm">' : ''; ?>
			  <?= $videoOgg ? '<source src="'. $videoOgg .'" type="video/ogg">' : ''; ?>
			</video>
		</div>
		<div class="info">
			<?php $postHighline = get_post_meta(get_the_ID(), 'cancarner_highline', TRUE); ?>
			<h3>Arrelem Can Carner<i></i>!</h3>
			<?php if($postHighline): ?>
				<h1><?=$postHighline?></h1>
			<?php endif; ?>
			<a class="btn" href="<?=get_post_meta(get_the_ID(), 'cancarner_link', TRUE); ?>">Saber-ne més</a>
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
