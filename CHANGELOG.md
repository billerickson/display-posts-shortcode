# Change Log
All notable changes to this project will be documented in this file, formatted via [this recommendation](http://keepachangelog.com/).

## [1.5.9] = 2016-05-23
### Fixed
- Issue with automated theme location placement not working on in all cases. See #44

### [Unreleased]
#### Added
* Support for [Co-Authors Plus Addon](https://github.com/billerickson/dps-coauthor-addon), see 4f97008d3ddad4fdf0639e416d88e7dfa47d77e1

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
