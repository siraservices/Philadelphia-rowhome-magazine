<?php
/**
 * The template for displaying comments
 *
 * @package RowHome_Magazine
 * @since 1.0.0
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area" style="margin-top: 60px; padding-top: 40px; border-top: 2px solid #e0e0e0;">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comment_count = get_comments_number();
            if ('1' === $comment_count) {
                printf(
                    esc_html__('One comment on &ldquo;%s&rdquo;', 'rowhome-magazine'),
                    '<span>' . get_the_title() . '</span>'
                );
            } else {
                printf(
                    esc_html(
                        _nx(
                            '%1$s comment on &ldquo;%2$s&rdquo;',
                            '%1$s comments on &ldquo;%2$s&rdquo;',
                            $comment_count,
                            'comments title',
                            'rowhome-magazine'
                        )
                    ),
                    number_format_i18n($comment_count),
                    '<span>' . get_the_title() . '</span>'
                );
            }
            ?>
        </h2>

        <ol class="comment-list" style="list-style: none; padding: 0;">
            <?php
            wp_list_comments(array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 60,
                'callback'    => function($comment, $args, $depth) {
                    ?>
                    <li id="comment-<?php comment_ID(); ?>" <?php comment_class('comment-item'); ?>>
                        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body" style="padding: 20px; margin-bottom: 20px; background-color: #f9f9f9; border-left: 4px solid #e0e0e0;">
                            <footer class="comment-meta" style="display: flex; gap: 15px; margin-bottom: 15px;">
                                <div class="comment-author vcard">
                                    <?php echo get_avatar($comment, 60, '', '', array('style' => 'border-radius: 50%;')); ?>
                                </div>
                                <div>
                                    <div style="font-weight: 700; font-size: 1.1rem;">
                                        <?php comment_author_link(); ?>
                                    </div>
                                    <div class="comment-metadata" style="font-size: 0.85rem; color: #999;">
                                        <a href="<?php echo esc_url(get_comment_link($comment, $args)); ?>">
                                            <?php printf(esc_html__('%1$s at %2$s', 'rowhome-magazine'), get_comment_date(), get_comment_time()); ?>
                                        </a>
                                        <?php edit_comment_link(esc_html__('(Edit)', 'rowhome-magazine'), '<span class="edit-link">', '</span>'); ?>
                                    </div>
                                </div>
                            </footer>

                            <div class="comment-content" style="margin-bottom: 10px;">
                                <?php comment_text(); ?>
                            </div>

                            <?php
                            comment_reply_link(array_merge($args, array(
                                'add_below' => 'div-comment',
                                'depth'     => $depth,
                                'max_depth' => $args['max_depth'],
                                'before'    => '<div class="reply" style="margin-top: 10px;">',
                                'after'     => '</div>',
                            )));
                            ?>
                        </article>
                    </li>
                    <?php
                },
            ));
            ?>
        </ol>

        <?php
        the_comments_navigation(array(
            'prev_text' => __('&laquo; Older Comments', 'rowhome-magazine'),
            'next_text' => __('Newer Comments &raquo;', 'rowhome-magazine'),
        ));

        if (!comments_open()) :
            ?>
            <p class="no-comments" style="font-style: italic; color: #999; margin-top: 20px;">
                <?php esc_html_e('Comments are closed.', 'rowhome-magazine'); ?>
            </p>
        <?php
        endif;

    endif; // Check for have_comments().

    comment_form(array(
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title" style="margin-top: 40px; margin-bottom: 20px;">',
        'title_reply_after'  => '</h3>',
        'class_form'         => 'comment-form',
        'class_submit'       => 'submit newsletter-submit',
        'label_submit'       => __('Post Comment', 'rowhome-magazine'),
    ));
    ?>

</div>

<style>
.comment-list {
    margin-top: 30px;
}

.comment-item {
    margin-bottom: 20px;
}

.comment-respond {
    margin-top: 40px;
}

.comment-form input[type="text"],
.comment-form input[type="email"],
.comment-form input[type="url"],
.comment-form textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    font-family: inherit;
    font-size: 1rem;
    margin-bottom: 15px;
}

.comment-form textarea {
    min-height: 150px;
    resize: vertical;
}

.comment-form label {
    display: block;
    font-weight: 600;
    margin-bottom: 5px;
    color: #333;
}

.comment-form .submit {
    background-color: #FF0000;
    color: #ffffff;
    padding: 12px 30px;
    border: none;
    border-radius: 4px;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    font-size: 0.95rem;
}

.comment-form .submit:hover {
    background-color: #cc0000;
}

.reply a {
    color: #FF0000;
    font-size: 0.9rem;
    font-weight: 600;
}

.comment-awaiting-moderation {
    display: block;
    padding: 10px;
    background-color: #fff3cd;
    color: #856404;
    border-radius: 4px;
    margin-top: 10px;
}
</style>

