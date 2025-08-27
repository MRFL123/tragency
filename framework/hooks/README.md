Hooks Folder
==============================



Mirrorful-Pagination
==============================

**A custom WordPress numbered pagination function to fully implement the [Bootstrap 4.x](http://getbootstrap.com/) /pagination/ style in a custom theme.**

Featured
--------
* Bootstrap Styling
* First & Last Buttoon
* Next & Previous Button
* Glyphicon can be added instead of Next & Pervious values
* Filter to overwrite values

How it Looks
------------

Below is the example of the Bootstrap WordPress Pagination. You can customize it with your own CSS styling.
![Extras](http://3.bp.blogspot.com/-XULxjp0E4uQ/U3Dyph_GJ9I/AAAAAAAABto/4rrOgV_D_Zw/s1600/pagination-wordpress-bootstrap.png)

------------
Place **pagination.php** in your WordPress Framework folder `/framework/hooks/`


```php
// Register Custom Navigation Walker
require_once('pagination.php');
```

or simply open the **pagination.php** copy all the code and paste it in your themes **functions.php** file

Using Mirrorful Pagination
------------
Update your **index.php** or **template-blog.php** or any other file where you want to show the pagination. Add the below code into the file to show the Bootstrap WordPress Pagination.

```php
<?php
  if ( function_exists('Mirrorful_pagination') )
    Mirrorful_pagination();
?>
```
if pagination is not showing, go to WordPress Dashboard > Reading > Blog pages show at most > set value smaller then number of posts your blog has.

Filtering Next & Previous
-------------------------
To filter next and previous values use the following snippet into **functions.php**
```
function customize_Mirrorful_pagination($args) {

    $args['previous_string'] = 'previous';
    $args['next_string'] = 'next';

    return $args;
}
add_filter('Mirrorful_pagination_defaults', 'customize_Mirrorful_pagination');
```
