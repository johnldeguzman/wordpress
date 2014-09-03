<?php if (is_plugin_active('ai-twitter-feeds/ai-twitter-feeds.php')) { ?>
    <div class="block twitterblock">
        <div class="block-container">
            <div class="twitterlogo"><i class="icon-twitter"></i></div>
            <section class="messages-container">
                <?php echo do_shortcode("[AIGetTwitterFeeds ai_username='' ai_numberoftweets='' ai_tweet_title=' ']"); ?>
            </section>
        </div>
    </div>
<?php } ?>