<?php get_header() ?>
<!-- si il y a des post alors tant qu'il y en a affiche les postes -->
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <h1><?php the_title() ?></h1>
        <!-- get_the_ID() pour l'id en coursdans la class SponsoMetaBox et on utilise la clé META_KEY, 3eme paramètre single qui est true-->
        <?php if (get_post_meta(get_the_ID(), SponsoMetaBox::META_KEY, true) === '1') : ?>
            <div class="alert alert-info">Cet article est sponsorisé</div>
        <?php endif ?>

        <!-- on utilise the_post_thumbnail_url() pour pouvoir mettre du style avec une hauteur et largeur -->
        <p><img src="<?php the_post_thumbnail_url() ?> " alt="" style="width:100%; heigth:auto;"></p>

        <?php the_content() ?>
<?php endwhile;
endif; ?>

<?php get_footer() ?>