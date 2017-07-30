<?php

/**
 * @author Doanln
 * @copyright 2017
 */

if(isset($message)) $m = $message;
else $m = "Error";

add_pagetitle($m);

get_header();
?>
        <article class="full-width">
            <div class="container">
                <div class="error-message">
                    <h2 class="message-text"><?php echo $m; ?></h2>
                </div>
            </div>
        </article>
<?php get_footer(); ?>