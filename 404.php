<?php get_header(); ?>

<section class="error404">

	<div class="grid side-padding">

		<h1><?= get_field('404_page_heading', 'options') ?: 'Page does not exist' ?></h1>
		<p><?= get_field('404_page_text', 'options') ?: '' ?></p>

	</div>
</section>

<?php
get_footer();
