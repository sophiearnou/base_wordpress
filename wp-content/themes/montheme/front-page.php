<?php get_header() ?>
<!-- tant qu'il y en a affiche les postes -->
<?php while (have_posts()) : the_post() ?>

    <!-- titre de la page -->
    <h1><?php the_title() ?></h1>
    <!-- contenu de la page -->
    <?php the_content() ?>
    <!-- lien vers les pages d'archives, ?= pour echo -->

    <a href="<?= get_post_type_archive_link('post') ?>">Voir les dernière actualitées</a>

<?php endwhile; ?>
<?php get_footer() ?>