<div class="global-finder">

    <div class="row">
      <div class="eight columns centered">
        <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
        <div class="row collapse">
          <div class="ten mobile-three columns">
            <input type="text" placeholder="What are you looking for?" name="s" value="<?php the_search_query(); ?>" />
          </div>
          <div class="two mobile-one columns">
            <button type="submit" class="button expand postfix search secondary">Search</button>
          </div>
        </div>
        </form>

        
        <?php if ( is_search() ) : // Only display Excerpts for Search ?>
        <!-- <h4>/ Search Results for &ldquo;<?php echo get_search_query(); ?>&rdquo;</h4> -->
        <?php else : ?>
        <h4>/ Let us suggest something</h4>
        <h5>
          <?php $terms = array('Project','Estimate','FileMaker','Ponies','Flowers','Barbies');
              foreach($terms as $i=>$term){
                printf('<a href="%s">%s</a>', home_url( '/' )."?s=". strtolower($term), $term);
                if($i != count($terms)-1) echo ", ";
              }
          ?>
        </h5>
        <?php endif; ?>
      </div>
      <a href="#" class="button black up" rel="close-finder">Close</a>
    </div>
    <!-- end global-finder -->
  </div>