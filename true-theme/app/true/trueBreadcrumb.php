<?php

    class TrueBreadcrumb
    {
        private $startTitle = '';
        private $startURL = '';
        private $endURL = '';
        private $endTitle = '';
        private $sep = '&gt;';
        
        private $sections = array();
        
        public function __construct()
        {
            $this->startTitle = 'Home';
            $this->startURL = home_url();
            $this->endURL = get_permalink();
            $this->endTitle = get_the_title();    
            
            if(is_search())
            {
                $this->endURL = get_search_link();
                $this->endTitle = 'Search';
            }
            
            if(is_tax())
            {
                global $wp_query;
                $term = $wp_query->get_queried_object();
                $this->endTitle = $term->name;
                $this->endURL = get_term_link($term, $term->taxonomy);
            }
        }
        
        public function addSection($url, $title)
        {
            $this->sections[$title] = $url;
        }
        
        public function show()
        {
            if($this->endTitle == '') return;
           
            ?>
            <span class="true-breadcrumb"><a href="<?php echo $this->startURL?>"><?php echo $this->startTitle?></a> <?php echo $this->sep?> 
            <?php
                foreach($this->sections as $title => $url)
                {
                    ?>
                    <a href="<?php echo $url?>"><?php echo $title?></a> <?php echo $this->sep?> 
                    <?php
                }
            ?>    
            <a href="<?php echo $this->endURL?>"><?php echo $this->endTitle?></a></span>
            <?php
        }
    }





