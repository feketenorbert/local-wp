<?php 

get_header();

if (have_posts()){
    while (have_posts()){
       the_post();?>

        <div class="masina">
            
            <h2><?php the_title(); ?></h2>
            <?php the_content();?>
            <div class="masina-marca">
                <?php
                $marca = get_term([
                        'taxonomy' => 'marca',
                        'hide_emplty' => true,
                    ]);
                    foreach ($marca as $value){
                        echo $value->name;
                    }
                ?>
            </div>
        </div>
    <?php
    }
}
