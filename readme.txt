=== Display Posts Shortcode ===
Contributors: billerickson
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=MQKRBRFVRUV8C
Tags: shortcode, pages, posts, page, query, display, list
Requires at least: 3.0
Tested up to: 4.8
Stable tag: 2.9.0

Display a listing of posts using the [display-posts] shortcode

== Description ==

The *Display Posts Shortcode* was written to allow users to easily display listings of posts without knowing PHP or editing template files.

Add the shortcode in a post or page, and use the arguments to query based on tag, category, post type, and many other possibilities. You can also customize the output with parameters like: include_date, include_excerpt, and image_size.

* [Available Parameters](https://github.com/billerickson/display-posts-shortcode/blob/master/README.md#parameters)
* [Customization with Filters](https://github.com/billerickson/display-posts-shortcode/wiki#customization-with-filters)
* [Extension Plugins](https://github.com/billerickson/display-posts-shortcode/wiki#extension-plugins)
* [Full Change Log](https://github.com/billerickson/display-posts-shortcode/blob/master/CHANGELOG.md)
* [View on GitHub](https://github.com/billerickson/display-posts-shortcode)


== Installation ==

1. Upload `display-posts-shortcode` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the *Plugins* menu in WordPress.
1. Add the shortcode to a post or page.


== Changelog ==

**Version 2.9.0**
* New parameter `exclude` for excluding specific post IDs, see [#154](https://github.com/billerickson/display-posts-shortcode/issues/154)
* New parameter `category_id` for specifying category by ID (note: only accepts a single ID), see [#156](https://github.com/billerickson/display-posts-shortcode/issues/156)
* New parameter `include_date_modified` for displaying the date the post was last updated, see [#150](https://github.com/billerickson/display-posts-shortcode/issues/150)
* Shortcode title now appears above the wrapper (ul/ol/div), fixing invalid markup, see [#165](https://github.com/billerickson/display-posts-shortcode/issues/165)
* Limit visibility to readable posts

**Version 2.8.0**
* Added include_link="false" to remove link from post title and image, see [#137](https://github.com/billerickson/display-posts-shortcode/pull/137)
* Fixed category display when using multiple post types, see [#143](https://github.com/billerickson/display-posts-shortcode/issues/143)
* Fixed issue combining multiple taxonomies, see [#131](https://github.com/billerickson/display-posts-shortcode/issues/131)


**Version 2.7.0**
* Added support for [Co-Authors Plus Addon](https://github.com/billerickson/dps-coauthor-addon).
* Added parameter to exclude children terms in tax queries, [more information](https://github.com/billerickson/display-posts-shortcode/issues/120)
* Added a filter to display the full version of manual excerpt, regardless of excerpt_length. [more information](https://github.com/billerickson/display-posts-shortcode/issues/123)
* Removed shortcodes from custom excerpts, [more information](https://github.com/billerickson/display-posts-shortcode/issues/113)
* Fixed private post visibility, [more information](https://github.com/billerickson/display-posts-shortcode/issues/115)

**Version 2.6.2**
* More improvements to excerpts, see #110
* Added content_class parameter
* Fix date query bug, see #108
* Fixed undefined variable notice if include_title="false"

**Version 2.6.1**
* Fix issue with manually specified excerpts

**Version 2.6**

* Add support for author="current"
* Add support for multiple wrapper classes
* Add support for excerpt_length parameter
* Add support for excerpt_more parameter

**Version 2.5.1**

* Fix an issue with manually specified excerpts

**Version 2.5**

* Add support for date queries
* Exclude child pages with post_parent="0"
* Query by current taxonomy terms. Ex: [display-posts taxonomy="category" tax_term="current"]
* Display the post's categories with [display-posts category_display="true"]
* Many more fixes. See GitHub for a full list of changes.

**Version 2.4**

* Add 'include_author' parameter
* Add 'exclude_current' parameter for excluding the current post from the results
* If you display the full content of results, additional uses of the shortcode within those posts are now turned off
* Other minor improvements

**Version 2.3**

* Include the shortcode attributes on wrapper filter
* Add 'no_posts_message' parameter to specify content displayed if no posts found
* Add filters to the title and permalink
* Limit private posts to logged in users
* Add support for excluding sticky posts
* Add support for ordering by meta_key

**Version 2.2**

* Use original attributes for filters
* Add support for multiple taxonomy queries
* Add filter for post classes
* Add support for post content in the post loop

**Version 2.1**

* Add support for post status
* Add support for post author
* Add support for post offset

**Version 2.0**

* Explicitly declare arguments, props danielbachhuber
* Sanitize each shortcode attribute for security, props danielbachhuber

**Version 1.9**

* Add 'date_format' parameter, so you can customize how dates are displayed
* Added a class of .excerpt-dash so CSS can be used to remove the dash
* Cleaned up the codebase according to WordPress coding standards

**Version 1.8**

* Added `display_posts_shortcode_no_results` filter for displaying content if there's no posts matching current query.
* Add support for multiple post types. [display-posts post_type="page, post"]

**Version 1.7**

* Added `id` argument to specify specific post IDs
* Added `display_posts_shortcode_args` filter in case the arguments you want aren't already included in the shortcode. See example: http://www.billerickson.net/code/display-posts-shortcode-exclude-posts/

**Version 1.6**

* Added `post_parent` where you can specify a parent by ID, or you can say `post_parent=current` and it will use the current page's ID.
* Added `wrapper` where you can decide if the posts are an unordered list, ordered list, or div's
* Added support for multiple taxonomy terms (comma separated) and taxonomy operator (IN, NOT IN, or AND).

**Version 1.5**
* For the sake of clarity I'm changing version numbers. No feature changes

**Version 0.1.5**
* Added a filter (display_posts_shortcode_output) so you can modify the output of individual posts however you like.

**Version 0.1.4**

* Added post_type, taxonomy, tax_term, and include_excerpt
* Added classes to each part of the listing (image, title, date, excerpt) to make it easier to change the look using CSS

**Version 0.1.3**

* Updated Readme

**Version 0.1.2**

* Added image_size option

**Version 0.1.1**

* Fix spacing issue in plugin

**Version 0.1**

* This is version 0.1.  Everything's new!
