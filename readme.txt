=== Display Posts - Easy lists, grids, navigation, and more ===
Contributors: billerickson
Tags: shortcode, pages, posts, page, query, display, list
Requires at least: 3.0
Tested up to: 6.0
Stable tag: 3.0.2

Add a listing of content on your website using a simple shortcode. Filter the results by category, author, and more.

== Description ==

Display Posts allows you easily list content from all across your website. Start by adding this shortcode in the content editor to display a list of your most recent posts:

`[display-posts]`

**Filter by Category**

To only show posts within a certain category, use the category parameter:

`[display-posts category="news"]`

**Display as Post Grid**

You can create a great looking, column-based grid of posts with a bit of styling. [Here's how!](https://displayposts.com/2019/01/04/post-grid-styling/)

**List Popular Posts**
You can highlight your popular content in multiple ways. If you want to feature the posts with the most comments, use:

`[display-posts orderby="comment_count"]`

You can also list [most popular posts by social shares](https://displayposts.com/2019/01/04/most-popular-posts-by-social-shares/).

**Include thumbnails, excerpts, and more**
The [display parameters](https://displayposts.com/docs/parameters/#display-parameters) let you control what information is displayed for each post. To include an image and summary, use:

`[display-posts include_excerpt="true" image_size="thumbnail"]`

You can use any image size added by WordPress (thumbnail, medium, medium_large, large) OR any custom image size added by your theme or other plugins.

**Sort the list however you like**
By default the listing will list the newest content first, but you can order by title, menu order, relevance, content type, metadata, and more.

**List upcoming events**
You can easily list upcoming events from any event calendar. Each plugin will require slightly different code.

Here are [tutorials for popular event calendar plugins](https://displayposts.com/tag/events/). If your plugin is not listed here, submit a support request and I'll add it!

**Tutorials**
[Our tutorials](https://displayposts.com/tutorials/) cover common customization requests, and are updated often.

**Full Documentation**

* [Query parameters](https://displayposts.com/docs/parameters/#query-parameters) for customizing which posts are listed (filter by category, tag, date...)
* [Display parameters](https://displayposts.com/docs/parameters/#display-parameters) determine how the posts appear (title, excerpt, image...)
* [Template parts](https://displayposts.com/2019/01/04/use-template-parts-to-match-your-themes-styling/) for Display Posts to perfectly match your theme's post listings
* [Output filter](https://displayposts.com/docs/the-output-filter/) for complete control over how the listing looks on your site
* [Filters](https://displayposts.com/docs/parameters/#display-parameters) for even more powerful customizations for developers

**Extensions**

* [Display Posts – Pagination](https://github.com/billerickson/Display-Posts-Pagination) – Allow results of Display Posts to be paginated
* [Display Posts – Date View](https://wordpress.org/plugins/display-posts-date-view/) – Lets you break your content down by month or year.
* [Display Posts – Alpha View](https://github.com/billerickson/Display-Posts-Alpha-View) – Display an alphabetical listing of your content, broken down by letter
* [Display Posts – Transient Cache](https://github.com/billerickson/Display-Posts-Transient-Cache) – Cache the output using transients
* [Co-Authors Plus Addon](https://github.com/billerickson/dps-coauthor-addon) – multiple authors on posts
* [Columns Extension](https://github.com/billerickson/dps-columns-extension) – display posts in columns
* [DPS Exclude Sticky](https://github.com/billerickson/DPS-Exclude-Sticky) – exclude sticky posts unless specifically requested
* [DPS Pinch Zoomer](https://github.com/shazahm1/Display-Posts-Shortcode-Pinch-Zoomer) – adds support pinch zooming post images on mobile devices and mouse wheel zooming on desktops
* [Display Posts Shortcode Remote](https://github.com/shazahm1/Display-Posts-Shortcode-Remote) – display posts from a remote WordPress site utilizing the WP REST API.


== Installation ==

1. Upload `display-posts-shortcode` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the *Plugins* menu in WordPress.
1. Add the `[display-posts]` shortcode to a post or page.


== Changelog ==

**Version 3.0.2**
* Added `pre_display_posts_shortcode_output` filter before shortcode runs, used for transient caching, see [#210](https://github.com/billerickson/display-posts-shortcode/issues/214)
* Updated plugin to pass coding standards, see [#214](https://github.com/billerickson/display-posts-shortcode/issues/214)
* Removed survey admin notice, see [#213](https://github.com/billerickson/display-posts-shortcode/issues/213)
* Don't display empty term list, see [#208](https://github.com/billerickson/display-posts-shortcode/issues/208)

**Version 3.0.1**
* Prevent empty empty parameters from being added to the query, see [#207](https://github.com/billerickson/display-posts-shortcode/issues/207)

**Version 3.0.0**
* Added author_id parameter, see [#195](https://github.com/billerickson/display-posts-shortcode/issues/195)
* Added has_password parameter
* Added s parameter for performing a site search, see [#184](https://github.com/billerickson/display-posts-shortcode/issues/184)
* Added date_format="relative" format option (ex: 2 days ago), see [#194](https://github.com/billerickson/display-posts-shortcode/issues/194)
* Added post_parent__in and post_parent__not_in parameters, see [#193](https://github.com/billerickson/display-posts-shortcode/issues/193)
* Added excerpt_dash="false" option to disable dash in excerpt, see [#204](https://github.com/billerickson/display-posts-shortcode/issues/204)
* Added additional parameters to the `display_posts_shortcode_output` filter
* Added additional parameters to the `display_posts_shortcode_category_display` filter, see [#185](https://github.com/billerickson/display-posts-shortcode/issues/185)
* $dps_listing loop now accessible globally, see [#198](https://github.com/billerickson/display-posts-shortcode/issues/198)
* $dps_listing loop now accessible in open/close filters
* Added .excerpt-more class to excerpt more text, see [#205](https://github.com/billerickson/display-posts-shortcode/issues/205)
* Now excerpt_more text is always appended to end of excerpt, see [#197](https://github.com/billerickson/display-posts-shortcode/issues/197)
* In parameters that support multiple terms, they can now be separated with a comma or comma-space, see [#183](https://github.com/billerickson/display-posts-shortcode/issues/183)

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
