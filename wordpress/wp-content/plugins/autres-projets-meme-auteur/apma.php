<?php

/*
Plugin Name: APMA
Description: ...voir d'Autres Projets du Même Auteur.
Author: Lucas Boucher & Eva Sayagh
Version: 1.0.0
*/

// Note : pas la peine de mettre en liste d'attente le style, problème avec Themco Pro
// Note : Impossible de passer avec l'output buffering

function apma() 
{

    $arguments = [
        'post_type' => 'projets',
        'posts_per_page' => 2,
        'author' => get_the_author_meta('ID'),
        'post__not_in' => array(get_the_ID())
    ];

    $query = new WP_Query($arguments); ?>
        
    <?php if ($query->have_posts()) : ?>
        
        <div class="apma">
            
            <div class="apma-titre">
                <h2>Derniers projets de <span class="apma-nom"><?php the_author(); ?></span></h2>
            </div>

            <div class="apma-projets">
                <?php while ($query->have_posts()) : ?>
                    <?php $query->the_post(); ?>
                    
                    <?php $image = get_field('image'); ?>

                    <a href="<?php the_permalink(); ?>">   
                        <div class="apma-projet">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <div class="apma-texte">
                                <h3><?php the_title(); ?></h3>
                                <p><?= substr(get_field('description'), 0, 100); ?>...</p>
                            </div>         
                        </div>
                    </a>
                    
                <?php endwhile; ?>
            </div>

        </div>
    <?php endif; ?>

    <?php wp_reset_postdata();
}

add_shortcode('autres-projets-meme-auteur', 'apma');