<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div class="searchform">
        <div class="searchinput"><input type="text" value="<?php echo get_search_query(); ?>" id="searchinput" name="s" id="s" placeholder="Search" /></div>
        <div class="searchsubmit"><button id="searchsubmit"><i class="icon-search"></i> </button></div>
    </div>
</form>