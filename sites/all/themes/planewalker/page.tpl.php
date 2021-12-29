<?php
// $Id: page.tpl.php,v 1.14.2.6 2009/02/13 16:28:33 johnalbin Exp $

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 * - $body_classes_array: An array of the body classes. This is easier to
 *   manipulate then the string in $body_classes.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>">

<head><base href="https://planewalker.com">
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <!--[if IE]>
    <link rel="stylesheet" href="<?php print $base_path . $directory; ?>/ie.css" type="text/css">
    <?php if ($subtheme_directory && file_exists($subtheme_directory .'/ie.css')): ?>
      <link rel="stylesheet" href="<?php print $base_path . $subtheme_directory; ?>/ie.css" type="text/css">
    <?php endif; ?>
  <![endif]-->
  <?php print $scripts; ?>

	<?php if (! $sidebar_left) { ?>
		<style>
            #main-inner{padding-left:0px !important;}
            #sidebar-left{display: none !important;}
        </style>
	<?php  } ?>

	<?php if (! $sidebar_right) { ?>
		<style>
            #main-inner{padding-right:0px !important;}
            #sidebar-right{display: none !important;}
        </style>
	<?php  } ?>  
	<script type="text/javascript" src="sites/all/themes/zen/planewalker/gutter_handler.js"></script>



</head>

<body class="<?php print $body_classes; ?>"><?php if ($above_header): ?>
      <div id="above-header">
        <div id="above-header-inner">
            <?php print $above_header; ?>
        </div>
      </div> <!-- /#above_header -->
<?php endif; ?><div id="page"><div id="page-inner">
    <a name="top" id="navigation-top"></a>
    <div id="header"><div id="header-inner" class="clear-block">

      <?php if ($logo || $site_name || $site_slogan): ?>
        <div id="logo-title">

          <?php if ($logo): ?>
            <div id="logo">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo-image" />
              <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home" class="logo_link"></a>
            </div>
          <?php endif; ?>

          <?php if ($site_name): ?>
            <?php if ($title): ?>
              <div id="site-name"><strong>
                <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home">
                <?php print $site_name; ?>
                </a>
              </strong></div>
            <?php else: ?>
              <h1 id="site-name">
                <a href="<?php print $base_path; ?>" title="<?php print t('Home'); ?>" rel="home">
                <?php print $site_name; ?>
                </a>
              </h1>
            <?php endif; ?>
          <?php endif; ?>

          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>

        </div> <!-- /#logo-title -->
      <?php endif; ?>

      <?php if ($header): ?>
        <div id="header-blocks">
          <?php print $header; ?>
        </div> <!-- /#header-blocks -->
        
      <?php if ($navbar): ?>
        <div id="navbar"><div id="navbar-inner">

          <a name="navigation" id="navigation"></a>

          <?php print $navbar; ?>

        </div></div> <!-- /#navbar-inner, /#navbar -->
      <?php endif; ?>   
      
      <?php endif; ?>

    </div></div> <!-- /#header-inner, /#header -->
    
    <div id="main"><div id="main-inner" class="clear-block<?php if ($search_box || $primary_links || $secondary_links || $navbar) { print ' with-navbar'; } ?>">

    <div id="content">
      
<div id="contentframe-t"><div id="contentframe-l"><div id="contentframe-r"><div id="contentframe-b">
<div id="contentframe-tr"><div id="contentframe-tl"><div id="contentframe-br"><div id="contentframe-bl" class="contentframe_bl">
    
      <div id="content-inner" class="content_inner">
        <?php if ($mission): ?>
          <div id="mission"><?php print $mission; ?></div>
        <?php endif; ?>

        <?php if ($breadcrumb || $title || $tabs || $help || $messages): ?>
          <div id="content-header">
            <?php print $breadcrumb; ?>
            <?php if ($title): ?>
              <h1 class="title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php print $messages; ?>
            <?php if ($tabs): ?>
              <div class="tabs"><?php print $tabs; ?></div>
            <?php endif; ?>
            <?php print $help; ?>
          </div> <!-- /#content-header -->
        <?php endif; ?>

        <?php if ($content_top): ?>
          <div id="content-top">
            <?php print $content_top; ?>
          </div> <!-- /#content-top -->
        <?php endif; ?>
        
        <div id="content-area">
          <?php print $content; ?>
        </div>

        <?php if ($content_bottom): ?>
          <div id="content-bottom">
            <?php print $content_bottom; ?>
          </div> <!-- /#content-bottom -->
        <?php endif; ?>
        
        <?php if ($feed_icons): ?>
          <div class="feed-icons"><?php print $feed_icons; ?></div>
        <?php endif; ?>

      </div> <!-- /#content-inner -->

</div></div></div></div>
</div></div></div></div>

      </div> <!-- /#content -->
      

      <?php if ($sidebar_left): ?>
        <div id="sidebar-left"><div id="sidebar-left-inner">
          <?php print $sidebar_left; ?>
        </div></div> <!-- /#sidebar-left-inner, /#sidebar-left -->
      <?php endif; ?>

      <?php if ($sidebar_right): ?>
		<div id="sidebar-right-expand"></div>		  
        <div id="sidebar-right"><div id="sidebar-right-inner">
		  <div id="sidebar-right-collapse"></div>	
          <?php print $sidebar_right; ?>
        </div></div> <!-- /#sidebar-right-inner, /#sidebar-right -->		
      <?php endif; ?>
	  
        <div id="sidebar-gutter"><div id="sidebar-gutter-inner" class="region region-gutter">
		  <div id="sidebar-right-expand"></div>		
          <?php print $gutter; ?>
        </div></div> <!-- /#sidebar-gutter-inner, /#sidebar-gutter --> 	  

    </div></div> <!-- /#main-inner, /#main -->

    <div id="footer"><div id="footer-inner">

    <div id="secondary-logo"></div>
      <div id="footer-message"><?php print $footer_message; ?></div>

    </div></div> <!-- /#footer-inner, /#footer -->

    <?php if ($closure_region): ?>
      <div id="closure-blocks"><?php print $closure_region; ?></div>
    <?php endif; ?>

    <?php print $closure; ?>

  </div></div> <!-- /#page-inner, /#page -->

</body>
</html>
