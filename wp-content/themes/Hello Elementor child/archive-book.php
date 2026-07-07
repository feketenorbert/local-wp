<?php get_header(); ?>

<h1>Archive Books</h1>

    <?php if (have_posts()) : ?>
        <div class="books-list">
            <?php while (have_posts()) : the_post(); ?>
                <div class="book-item">
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_excerpt(); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

    <?php else : ?>
        <p>There are no books to show!</p>
    <?php endif; ?>

<?php get_footer(); ?>