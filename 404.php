<?php get_header(); ?>

<section class="error404">

	<div class="grid padding">

		<h1><?= get_field('404_page_heading', 'options') ?: 'Denne siden finnes ikke' ?></h1>
		<p><?= get_field('404_page_text', 'options') ?: '' ?></p>

	</div>
</section>

<?php
get_footer();
