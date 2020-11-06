<?php get_header() ?>


<!-- condition est ce qu'il y a des articles -->
<?php if (have_posts()) : ?>
    <div class="row">

        <?php while (have_posts()) : the_post(); ?>
            <div class="col-sm-4">
                <div class="card">
                    <!-- pour afficher l'image the_post_thumbnail()-->
                    <!-- le premier paramètre coresspond à la taille on peut mettre medium si on souhaite pas avoir de grosse image autrement corespond à la taille originale 'post-thumbnail' ensuite on a des attributs et styles css-->
                    <?php the_post_thumbnail('post-thumbnail', ['class' => 'card-img-top', 'alt' => '', 'style' => 'height:auto;']) ?>
                    <div class="card-body">
                        <!-- pour afficher les titre the_title() -->
                        <h5 class="card-title"><?php the_title() ?></h5>
                        <!-- pour afficher les catégories the_category() -->
                        <h6 class="card-subtitle mb-2 text-muted"><?php the_category() ?></h6>
                        <!-- pour récupérer l'extrait associer à un article' -->
                        <p class="card-text">
                            <?php the_excerpt() ?></p>
                        <!-- avec un lien a href on peut avec the_permalink() générer le lien vers un permalink -->
                        <a href="<?php the_permalink() ?>" class="card-link">Voir plus</a>
                    </div>
                </div>
            </div>
        <?php endwhile ?>

    </div>
    <!-- on appelle la fonction qu'on a crée -->
    <?php montheme_pagination() ?>

    <!-- // pour avoir plusieurs page la pagination ?php the_posts_pagination()ou alors faire ?= paginate_link();-->
    <!-- on peut aussi au au de faire une pagination mettre page précedente et page suivante avec:
                        ?= next_posts_link(); ?
                        ?= previous_post_link(); ?elseon n'oubli pas les >< avant et après le code -->
    <?= paginate_links(); ?>
<?php else : ?>
    <h1>Pas d'articles</h1>
<?php endif; ?>

<?php get_footer() ?>