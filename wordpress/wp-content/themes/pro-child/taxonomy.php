<?php get_header(); ?>

<div class="archive-page"> 

    <h1 class="archive-titre"><?php single_term_title() ?></h1>

    <?php get_template_part('template-parts/archive', 'projets'); ?>