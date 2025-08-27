<?php
use Roots\Sage\Assets;
/**
* This is the description for the Utilities class.
*
* @package    Utilities
* @author     Mirrorful (Superheroes Team)
* @version    1.0.0
* @since      1.0.0 First time this was introduced.
* @copyright  All right reseved Mirrorful - 2017
* @link       http://eMirrorful.com.
*/
class Utilities{
  /**
  * Function Name: Framework Path - Utilities::resources_path();
  * This Function can return the framework folder path to uesd it in our Code
  * @param ($filename) Add param in function have a file path in the framework root
  * @return ( All Path )
  */
  static function resources_path($filename) {
    $dist_path = get_template_directory_uri();
    $directory = dirname($filename) . '/';
    $file = basename($filename);

    return $dist_path . $directory . $file;
  }
  /**
  * Function Name: Global Thumbnails - Utilities::global_thumbnails();
  * This Function can return the url of any upload image
  * @param ($id, $size, true)
  * @return ( Just URl)
  */
  static function global_thumbnails($id, $size, $echo = true) {
    $thumbnail = '';
    $default_image = get_field('default_image', 'option');

    // Default_image: جلب الصورة الافتراضية من خيارات الموقع
    if (is_array($default_image) && isset($default_image['url'])) {
        $default_image = $default_image['url'];
    }

    // الصورة المميزة
    if (has_post_thumbnail($id)) {
        $thumbnail = wp_get_attachment_image_url(get_post_thumbnail_id($id), $size);
    }

    // تحديد الصورة النهائية
    if (!empty($thumbnail)) {
        $output = $thumbnail;
    } elseif (!empty($default_image)) {
        $output = $default_image;
    } else {
        $output = Utilities::resources_path('/resources/images/placeholder.png');
    }

    if ($echo) {
        echo esc_url($output);
    } else {
        return esc_url($output);
    }
}

    /**
    * Function Name: is subcategory - Utilities::is_subcategory();
    * This Function can Check for the subcategory page and redurict to it
    * @param ()
    * @return (All in ShortCode array)
    */
    static function is_subcategory( $cat_id = NULL ) {
      if (!$cat_id )
      $cat_id = get_query_var( 'cat' );
      if ( $cat_id ) {
        $cat = get_category( $cat_id );
        if ( $cat->category_parent > 0 )
        return true;
      }
      return false;
    }


    /**
    * Function Name: language selector flags - Utilities::language_selector_flags();
    * This Function can Check for the language selector flags
    * @param ()
    * @return (All in ShortCode array)
    */
    static  function language_selector_flags(){
        if(function_exists('icl_get_languages')){
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if(!empty($languages)){
            ?>
                <div class="languages-wrapper">
                    <ul class="navbar-nav">
                    <li class="nav-item lang-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-bs-toggle='dropdown' aria-haspopup="true" aria-expanded="false">
                        <?php foreach($languages as $l) : ?>
                            <?php if($l['active'] == 1) : ?>
                                <span class="icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.20646 3.18143C8.95433 3.2613 8.70533 3.35208 8.46018 3.45363C7.33792 3.91848 6.3182 4.59983 5.45926 5.45877C4.60032 6.31772 3.91897 7.33743 3.45411 8.45969C3.0852 9.35033 2.85837 10.2917 2.78045 11.2495H7.26094C7.29294 10.1536 7.39498 9.07362 7.56457 8.05008C7.7725 6.79509 8.07972 5.63865 8.47522 4.6499C8.69114 4.11008 8.9351 3.61593 9.20646 3.18143ZM12 1.24951C10.5883 1.24951 9.1904 1.52757 7.88615 2.06781C6.5819 2.60804 5.39683 3.39988 4.3986 4.39811C3.40037 5.39634 2.60853 6.58141 2.0683 7.88566C1.52806 9.18991 1.25 10.5878 1.25 11.9995C1.25 13.4112 1.52806 14.8091 2.06829 16.1134C2.60853 17.4176 3.40037 18.6027 4.3986 19.6009C5.39683 20.5991 6.5819 21.391 7.88615 21.9312C9.1904 22.4715 10.5883 22.7495 12 22.7495C13.4117 22.7495 14.8096 22.4715 16.1138 21.9312C17.4181 21.391 18.6032 20.5991 19.6014 19.6009C20.5996 18.6027 21.3915 17.4176 21.9317 16.1134C22.4719 14.8091 22.75 13.4112 22.75 11.9995C22.75 10.5878 22.4719 9.18992 21.9317 7.88567C21.3915 6.58142 20.5996 5.39635 19.6014 4.39812C18.6032 3.39989 17.4181 2.60805 16.1138 2.06781C14.8096 1.52757 13.4117 1.24951 12 1.24951ZM12 2.74951C11.7387 2.74951 11.4012 2.8753 11.0088 3.28171C10.6134 3.69112 10.2176 4.33277 9.86793 5.20699C9.52056 6.07541 9.2385 7.12375 9.04439 8.29527C8.88866 9.2352 8.79316 10.2326 8.76162 11.2495L15.2384 11.2495C15.2068 10.2326 15.1113 9.2352 14.9556 8.29527C14.7615 7.12375 14.4794 6.07541 14.1321 5.20699C13.7824 4.33277 13.3866 3.69112 12.9912 3.28171C12.5988 2.8753 12.2613 2.74951 12 2.74951ZM16.7391 11.2495C16.7071 10.1536 16.605 9.07362 16.4354 8.05009C16.2275 6.7951 15.9203 5.63865 15.5248 4.6499C15.3089 4.11008 15.0649 3.61593 14.7935 3.18142C15.0457 3.2613 15.2947 3.35208 15.5398 3.45363C16.6621 3.91848 17.6818 4.59983 18.5407 5.45878C19.3997 6.31772 20.081 7.33743 20.5459 8.45969C20.9148 9.35033 21.1416 10.2917 21.2195 11.2495H16.7391ZM15.2384 12.7495L8.76162 12.7495C8.79316 13.7664 8.88866 14.7638 9.04439 15.7038C9.2385 16.8753 9.52056 17.9236 9.86793 18.792C10.2176 19.6663 10.6134 20.3079 11.0088 20.7173C11.4012 21.1237 11.7387 21.2495 12 21.2495C12.2613 21.2495 12.5988 21.1237 12.9912 20.7173C13.3866 20.3079 13.7824 19.6663 14.1321 18.792C14.4794 17.9236 14.7615 16.8753 14.9556 15.7038C15.1113 14.7638 15.2068 13.7664 15.2384 12.7495ZM14.7935 20.8176C15.0649 20.3831 15.3089 19.8889 15.5248 19.3491C15.9203 18.3604 16.2275 17.2039 16.4354 15.9489C16.605 14.9254 16.7071 13.8454 16.7391 12.7495H21.2195C21.1416 13.7073 20.9148 14.6487 20.5459 15.5393C20.081 16.6616 19.3997 17.6813 18.5407 18.5402C17.6818 19.3992 16.6621 20.0805 15.5398 20.5454C15.2947 20.6469 15.0457 20.7377 14.7935 20.8176ZM9.20646 20.8176C8.9351 20.3831 8.69114 19.8889 8.47521 19.3491C8.07971 18.3604 7.7725 17.2039 7.56457 15.9489C7.39498 14.9254 7.29294 13.8454 7.26094 12.7495H2.78045C2.85837 13.7073 3.0852 14.6487 3.45411 15.5393C3.91897 16.6616 4.60032 17.6813 5.45926 18.5402C6.3182 19.3992 7.33792 20.0805 8.46018 20.5454C8.70533 20.6469 8.95433 20.7377 9.20646 20.8176Z" fill="#838383"/>
                                    </svg>
                                </span>
                                <span class="text mx-2">
                                    <?= $l['language_code'] ?>
                                </span>
                            <?php endif; endforeach; ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div class="dropdown-inner">
                                <?php
                                    foreach($languages as $l){
                                        // if($l['active'] != 1) {
                                ?>
                                    <a class="dropdown-item" href="<?= $l['url'] ?> ">
                                        <span class="icon">
                                            <img width="20px" height="20px" class="mx-1" src="<?= $l['country_flag_url'] ?>" alt="Country Flag">
                                        </span>
                                        <span class="text">
                                            <?= $l['language_code'] ?>
                                        </span>
                                    </a>
                                <?php
                                        // }
                                    }
                                ?>
                            </div>
                        </div>
                    </li>
                    </ul>
                </div>
                <?php
            }
        }
    }


   /**
    * Estimated reading time in minutes
    *
    * @param $content
    *
    * @return int estimated time in minutes
    */

    //estimated reading time
    static function reading_time($the_content) {

      if (!function_exists('mb_str_word_count')) {
          function mb_str_word_count($string, $format = 0, $charlist = '[]') {
              $string=trim($string);
              if(empty($string))
                  $words = array();
              else
                  $words = preg_split('~[^\p{L}\p{N}\']+~u',$string);
              switch ($format) {
                  case 0:
                      return count($words);
                      break;
                  case 1:
                  case 2:
                      return $words;
                      break;
                  default:
                      return $words;
                      break;
              }
          }
      }
        $word_count = str_word_count( strip_tags( $the_content ) );
        $readingtime = ceil($word_count / 200);

      return $readingtime;
  }
    /* End of the Utilities class. */
  }

