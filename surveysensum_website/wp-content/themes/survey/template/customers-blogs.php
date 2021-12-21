
   <?php 
   /*==============================================================
   
   	Template Name: Customers or Case Study Details page
   
   ==============================================================*/
   
   get_header();?>

   <style>
      
      .cxPostWrp {
          margin-bottom: 40px;
          box-shadow: 0px 1px 20px #b8caff9c;
          height: 94%;
          border-radius: 4px;
      }

      ul.categoryList li {list-style: none;}

      .cxPostHeading {
          padding: 15px 15px;
          text-align: right;
          border-top: 1px solid #02193b;
      }

      .cxPostHeading h3 {
          text-align: left;
      }

      .cxPostHeading h3 a {
          display: block;
          font-size: 22px;
          color: initial;
          font-weight: 500;
      }

      .cxPostHeading a.onDemandBtn {
          background-color: #02193b;
          border: 2px solid #02193b;
          color: #fff;
          padding: 6px 21px 9px;
          border-radius: 4px;
          line-height: normal;
          font-size: 13px;
          font-weight: 500;
      }
      .cxPostImage {
          padding: 15px 15px;
          /* background: #F4F6FC; */
      }
    
    @media(max-width: 767px){
      .filter-catagory .filter-content ul li {
          opacity: 1;
          max-height: inherit;
          display: inline-block;
          width: auto;
          margin: 10px 3px 0 3px;
      }

      .filter-catagory .filter-content ul {
          background: transparent;
          border-bottom: 0;
          display: flex;
          justify-content: center;
      }

      .filter-catagory .filter-content ul li a {
          background: #F4F6FC;
      }
      .service-tab-content.tab-content{
        padding: 10px 0 0;
      }
    }

   </style>




    <?php 
          $post_args = array(
              'posts_per_page' => -1,
              'post_type' => 'customers',
              'orderby'   => 'meta_value',
              'order' => 'DESC',
          );
          $myposts = get_posts($post_args); ?>

        <ul class="categoryList row">
            
            <?php foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
            <li class="col-12 col-md-6">
              <div class="cxPostWrp">
                <div class="cxPostImage">
                  <a href="<?php the_permalink(); ?>">
                    <?php echo get_the_post_thumbnail( $page->ID, 'full' ); ?>
                  </a>
                </div>
                <div class="cxPostHeading">
                  <h3>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                  </h3>
                  <!-- <a href="<?php #the_permalink(); ?>" class="onDemandBtn">On Demand</a> -->
                </div>
              </div>
            </li>
            <?php endforeach; ?>
        </ul> 



<?php get_footer(); ?>





