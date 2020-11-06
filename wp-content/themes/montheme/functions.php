<?php


function montheme_supports()
{
    //pour que le theme support le titre
    add_theme_support('title-tag');
    //pour que le theme support les images
    add_theme_support('post-thumbnails');
    //pour supporter les menus
    add_theme_support('menus');
    // register_nav_menu Permet d’enregistrer une nouvelle barre de navigation
    // premier paramètre id qui sera un id de localisation permet de savoir quel menu on veut afficher et 2ème description affiché au niveau du back office
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
    //support du format d'image
    //true pour croper donc si l'image n'a pas le bon ratio on centre
    add_image_size('post-thumbnail', 350, 215, true);
    // On peut remplacer des formats non utulisé par défaut dans wp
    //remove_image_size('medium');
    //add_image_size('medium', 500, 500);
}

//pour les styles bootstrap, js et jquey, popper
function montheme_register_assets()
{
    wp_register_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css', []);
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js', ['popper', 'jquery'], false, true);
    wp_register_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.5.1.slim.min.js', [], false, true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');
}

//2_filtre pour mettre | comme séparateur dans l'onglet
function montheme_title_separator()
{
    return '|';
}

//3_filtre
function montheme_document_title_parts($title)
{
    // //on obtient un tableau
    // var_dump($title);
    // die();

    //permet de filtrer ce qu'on met dans l'onglet
    // unset($title['tagline']);

    //si on veut rajout des pipes avec nom dans l'onglet
    $title['demo'] = 'Salut';
    return $title;
}

//2_filtre class de menu
//(array $classes): array    array sert à typer pour eviter les bug pas obligatoire
function montheme_menu_class(array $classes): array
{

    //on rajoute la class qu'on a dans bootstrap donc un nav-item
    $classes[] = 'nav-item';
    //il est important de retourner le premier paramètre car on est dans un filtre et non une action donc on doit tjs retourner quelque chose
    return $classes;

    // //permet de débuguer l'ensemble des arguments que l'on reçoit
    // var_dump(func_get_args());
    // die();
}

//2_filtre pour les liens de menu
function montheme_menu_link_class($attrs)
{
    //on rajoute la class qu'on a dans bootstrap donc un nav-link
    $attrs['class'] = 'nav-link';
    //il est important de retourner le premier paramètre car on est dans un filtre et non une action donc on doit tjs retourner quelque chose
    return $attrs;
}

// on crée une fonction pour personnaliser et générer la pagination
function montheme_pagination()
{
    // 'array' permet de récupérer l'ensemble des pages
    $pages = paginate_links(['type' => 'array']);
    //on fait une condition pour ne pas avoir d'erreur si pas besoin de pagination par rapport au nombre d'articles
    if ($pages === null) {
        return;
    }
    //my-4 pour avoir une marge en haut et en bas
    echo '<nav aria-label="Pagination" class="my-4">';
    //echo pour afficher le ul
    echo '<ul class="pagination">';

    // on parcours l'ensemble des pages avec foreach
    foreach ($pages as  $page) {
        //on crée une variable active on lui dit que ce sera string post et on cherche dans page le mot clé 'current' si çà n'a pas était retrouvé çà reoutrne false donc on met différent de false !==
        $active = strpos($page, 'current') !== false;
        //on rajoute une variable $class qui s'appelle page-item et si elle est active on rajoute à la class active
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }

        //echo pour afficher le li et la conténation de la variable $class
        echo '<li class="' . $class . '">';
        // on affiche et on dit je veux que tu cherche page-numbers class par défaut de wp et je veux que tu la remplace par la class bootstrap page-link
        echo str_replace('page-numbers', 'page-link', $page);
        // on affiche la fermeture du </li>
        echo '<li>';
    }
    //var_dump($pages);
    // on affiche la fermeture du </ul>
    echo '</ul>';
    echo '</nav>';
}



//after_setup_theme c'est un hook pour le titre dans l'onglet
add_action('after_setup_theme', 'montheme_supports');

//lorsque l'action wp_enqueue_scripts est appellé, je veux que tu appelles la function montheme_register_assets
add_action('wp_enqueue_scripts', 'montheme_register_assets');

//1_filtre ajout d'un filtre
add_filter('document_title_separator', 'montheme_title_separator');
//4_filtre
add_filter('document_title_parts', 'montheme_document_title_parts');
//1_filtre class de menu
add_filter('nav_menu_css_class', 'montheme_menu_class');
//1_filtre pour les liens de menu
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');


//on fait un require_once pour inclure le fichier sponso.php
require_once('metaboxes/sponso.php');
SponsoMetaBox::register();
