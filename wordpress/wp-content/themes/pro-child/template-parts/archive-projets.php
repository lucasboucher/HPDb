<?php if (have_posts()) : ?>
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <?php 
                $terms = wp_get_post_terms( get_the_ID(), 'competences');
                $number_of_terms = count($terms);
                $competences = []; 
                for ($i=0; $i < $number_of_terms; $i++) {
                    $competence = get_the_terms(get_the_ID(), 'competences')[$i];
                    array_push($competences, $competence->name);
                } //récupérer toutes les compétences
                
                $image = get_field('image'); //récupérer l'image     
            ?>
            
            <a class="projet-archive" href="<?php the_permalink() ?>">
                <div class="archive-image">
                    <?php if( !empty( $image ) ): ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                </div>
                
                <div class="archive-contenu">
                    <div class="archive-texte">
                        <h2><?php the_title() ?></h2>
                        <li class="archive-competences">
                            <?php 
                                foreach ($competences as $competence) {
                                    echo '<ul class="archive-competence">' . $competence . '</ul>';
                                }
                            ?>
                        </li>
                    </div>
                    <div class="archive-details">
                        <p>Par <span class="archive-detail"><?php the_author() ?></span> le <span class="archive-detail"><?php echo get_the_date('j F Y') ?></span></p>
                    </div>
                    
                </div>
            </a>

        <?php endwhile; ?>
    <?php endif; ?>

</div>

<?php get_footer(); ?>