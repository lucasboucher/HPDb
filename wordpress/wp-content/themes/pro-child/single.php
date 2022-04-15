<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>

        <?php 
            $terms = wp_get_post_terms( get_the_ID(), 'competences');
            $number_of_terms = count($terms);
            $competences = []; 
            for ($i=0; $i < $number_of_terms; $i++) {
                $competence = get_the_terms(get_the_ID(), 'competences')[$i];
                array_push($competences, [$competence->name, get_term_link($competence)]);
            } //récupérer toutes les compétences

            $terms = wp_get_post_terms( get_the_ID(), 'auteurs');
            $number_of_terms = count($terms);
            $auteurs = []; 
            for ($i=0; $i < $number_of_terms; $i++) {
                $auteur = get_the_terms(get_the_ID(), 'auteurs')[$i];
                array_push($auteurs, [$auteur->name,get_term_link($auteur)]);
            } //récupérer tous les auteurs
            
            $image = get_field('image'); //récupérer l'image

            $link = get_field('lien');
        ?>
        
        <div class="projet">
            
            <a href="/projets">
                <div class="projet-back">
                    <img src="/wp-content/themes/pro-child/arrow_back_icon.svg"/>
                    <p>Voir tous les projets</p>
                </div>
            </a>
        
            <li class="projet-competences">
                <?php 
                    foreach ($competences as $competence) {
                        $term_link = get_term_link('competences');
                        echo '<a href="' . esc_url( $competence[1] ) . '"><ul class="projet-competence">' . $competence[0] . '</ul></a>';
                    }
                ?>
            </li>

            <div class="projet-header">
                <div class="projet-title">
                    <h1><?php the_title() ?></h1>
                    <p class="projet-version">v<?php the_field('version'); ?></p>
                </div>
                <p class="projet-auteurs">
                    Par&nbsp;<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))) ?>"><span class="projet-auteur"><img src="<?php echo get_avatar_url(get_the_author_meta()) ?>" alt="Avatar du publicateur de ce projet"><?php the_author() ?></span></a><?php foreach ($auteurs as $auteur) { 
                        echo '<a href="' . esc_url( $auteur[1] ) . '"><span class="projet-auteur">' . $auteur[0] . '</span></a>';
                    } ?>
                </p>
            </div>

            <?php if(!empty($link)) { ?>
                <?php echo '<a class="projet-link" href="' . $link . '">Lien vers le projet</a>'; ?>
            <?php } else { ?>
                <?php echo '<a class="projet-no_link">Aucun lien disponible</a>'; ?>
            <?php } ?>
   
            <p class="projet-description"><?php the_field('description'); ?></p>
            
            <p class="projet-tips">Tips : Cliquez sur l'image pour accéder à la source.</p>

            <?php if( !empty( $image ) ): ?>
                <a href="<?php echo esc_url($image['url']); ?>"><img class="projet-image" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" /></a>
            <?php endif; ?>

            <?php do_shortcode('[autres-projets-meme-auteur]'); ?>

        </div>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>