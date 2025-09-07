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
                        <li class="nav-item lang-item">
                            <?php foreach($languages as $l) : ?>
                                <?php if($l['active'] != 1) : ?>
                                    <a class="nav-link line-height-30 font-20 fw-500" href="<?= $l['url'] ?> ">
                                        <span class="text text-white mx-2">
                                            <?= $l['language_code'] ?>
                                        </span>
                                        <span class="icon mb-1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.25 12C1.25 17.928 6.072 22.75 12 22.75C17.928 22.75 22.75 17.928 22.75 12C22.75 6.07213 17.9282 1.25021 12.0004 1.25C6.0724 1.25 1.25 6.072 1.25 12ZM20.9732 9.75C21.154 10.4705 21.25 11.2243 21.25 12C21.25 12.7757 21.154 13.5295 20.9732 14.25H16.5746C16.687 13.5359 16.751 12.7846 16.751 11.9997C16.751 11.2151 16.687 10.464 16.5747 9.75H20.9732ZM20.4553 8.25H16.2585C15.6395 5.91321 14.5564 4.07877 13.7158 2.90957C16.7331 3.47793 19.2382 5.51661 20.4553 8.25ZM15.049 9.75C15.1761 10.4613 15.25 11.213 15.25 11.9997C15.25 12.7866 15.1761 13.5386 15.049 14.25H8.95105C8.82391 13.5386 8.75 12.7866 8.75 11.9997C8.75 11.2131 8.82386 10.4613 8.95094 9.75H15.049ZM9.30904 8.25H14.6909C13.966 5.82798 12.7108 4.02825 12 3.1427C11.2892 4.02759 10.0339 5.82765 9.30904 8.25ZM7.42628 9.75C7.31401 10.464 7.25 11.2151 7.25 11.9997C7.25 12.7846 7.31406 13.5359 7.4264 14.25H3.02678C2.84601 13.5295 2.75 12.7757 2.75 12C2.75 11.2243 2.84601 10.4705 3.02678 9.75H7.42628ZM3.54465 8.25H7.74243C8.3613 5.91313 9.44419 4.07864 10.2848 2.90945C7.26725 3.47764 4.76193 5.51642 3.54465 8.25ZM13.7159 21.0904C16.7331 20.522 19.2382 18.4834 20.4553 15.75H16.2584C15.6395 18.0869 14.5565 19.9213 13.7159 21.0904ZM12 20.8568C12.7107 19.9719 13.9659 18.1721 14.6908 15.75H9.30927C10.0342 18.1717 11.2893 19.9713 12 20.8568ZM10.2858 21.0907C9.44515 19.9217 8.36184 18.0871 7.74269 15.75H3.54465C4.76206 18.4839 7.26778 20.5228 10.2858 21.0907Z" fill="white"/>
                                            </svg>
                                        </span>
                                    </a>
                                <?php endif; endforeach; ?>
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

