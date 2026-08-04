<?php 

get_header();

// creati o pagina de arhiva unde se vor afisa toate cpt-urile, din php adaugati filtrare prin actions and hooks. la fel ca pe devhub, dar fara copy paste! 
function formular_filtrare(){
    ob_start();

    ?>
    <form method='GET' action=''>
        <input type="text" name="s" placeholder="Cauta..." value="<?php echo esc_attr($_GET['s'] ?? ''); ?>" />
        <select name='marca' onchange='this.form.submit()'>
            <option value=''>Toate Marcile</option>
            <?php
            $terms = get_terms('marca');       
            $selected_marca = $_GET['marca'] ?? '';
            foreach($terms as $term){
                echo '<option value="' . esc_attr($term->slug) . '" ' . selected($selected_marca, $term->slug, false) . '>' . esc_html($term->name) . '</option>';
            }
            ?>
        </select>
    </form>
    <?php
    return ob_get_clean();
}

if ( have_posts() ) { ?>

    <header class="page-header">
        <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
        ?>
    </header>
    <?php 
    do_action('before_filter');
    echo formular_filtrare(); ?>
    <div class="container">
    <?php
    while ( have_posts() ) {
         the_post();
         ?>
         <div class="card">
                <h5 class="card-title"><?php the_title(); ?></h5>
                <p class="card-text"><?php the_content(); ?></p>
         </div>
         <?php
    }
    ?>
    </div>
    <?php
}
