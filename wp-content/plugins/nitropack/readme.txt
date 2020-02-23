=== NitroPack ===
Contributors: nitropack
Tags: cache,caching,perfomance,optimize,pagespeed,fast,cdn,cloudflare,compression,nitropack,nitro,pack
Requires at least: 4.7
Tested up to: 5.3
Requires PHP: 5.3
Stable tag: trunk
License: GNU General Public License, version 2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A site performance optimization plugin

== Description ==
NitroPack is a new type of performance optimization plugin. It does the optimizations in the cloud which makes it very lightweight, compared to standard caching plugins NitroPack has much lower overhead on your CPU.
Configuration of the plugin requires no technical knowledge as all you need to do is select your desired optimization level: Standard, Medium, Strong or Ludicrous.
NitroPack uses a wide array of techniques to achieve the best possible automated optimization on your website based on the selected optimization level.
By using NitroPack you get the following (typically paid in other plugins) functionalities for free without the need of any additional configuration:

* Amazon CloudFront CDN - your static assets are automatically served from a CDN based on Amazon's CloudFront service
* Image optimization - all of your images are automatically optimized and converted to WebP
* Cache warmup - We will keep your most important pages optimized at all times

Due to its revolutionary design NitroPack offers some unique features and benefits like:

* Cache invalidation - cache files in NitroPack can be invalidated instead of purged, which means NitroPack will keep serving your visitors from cache until while a fresh copy of the cache is being generated in the background. This helps you in high traffic situations (e.g. campaigns) allowing you to keep updating your site while still serving cache to your clients, keeping your site fast.
* Critical CSS tailored to each of your unique layouts - typically plugins that provide critical CSS functionality will prepare a single critical CSS file per post type. However, you may have multiple pages with the same post type but different layouts. NitroPack detects this and generates unique critical CSS for each unique layout. Oh, and because desktop and mobile devices have vastly different viewports NitroPack will use different critical CSS for each device type as well ;)
* Optimize resources linked statically into your theme files - NitroPack will discover and optimize all resources linked into your theme, even ones that come hardcoded into your CSS files (even if they are multiple levels down an @import chain)
* No risk of damaging your original site files - NitroPack works on copies of your site files, so even if an optimization goes bad you can simply purge your cache to start over, or disable NitroPack in which case your site goes back to the state it was in before activating our plugin

## Key features

* HTML, CSS and JavaScript minification (including inline CSS and JS + CSS found in style attributes)
* HTML, CSS and JavaScript compression
* Image lazy loading
* Iframe lazy loading
* Amazon CDN
* Cloudflare integration
* Sucuri integration
* Generic reverse proxy integration (NGINX, Varnish, etc.)
* Image previews for YouTube embeds
* Deferring render-blocking resources
* Font rendering optimization
* DNS prefetch
* Compatible with mobile, tablet and desktop devices out of the box
* Multisite ready
* Support for scheduled posts
* eCommerce compatibility
* Multilingual support
* Easy setup
* Advanced resource loading mechanism
* Resource preloading using web workers
* Automatic cache management - NitroPack will automatically update its cache files when you update content on your site
* Option to exclude certain pages from being cache
* Option to exclude certain resources from being optimized
* Option to ignore URL parameters that do not modify the content of your pages (e.g. campaign parameters like utm_source, utm_campaign, etc.)
* No database connection needed

## NitroPack and Campaigns

There are two major issues when running a campaign - the first is that each visitor hits your server with a unique URL request and the second issue is that you will lose your cache if you update content on your site.
NitroPack has two very powerful features that help you survive during such high traffic situations whether you are running a big campaign or your site suddenly becomes trending. 

 1. NitroPack recognizes campaign parameters in the URL and ignores them when looking up a cache file for the campaign request.
 2. Cache invalidation - Typically when you update content on your site caching plugins have to purge their cache and start rebuilding it. However, this may impact user experience when a purge occurs during a high traffic period because your visitors will no longer be served from cache and your server will have to work extra hard to generate new cache files. NitroPack solves this by invalidating its cache, instead of purging, which means it starts refreshing the cache files in the background while your clients are still being served the slightly outdated cache files.

== Installation ==
After you have installed NitroPack IO, you will need an account at https://nitropack.io/.
Once you have registered and added your site simply use the provided Site ID and Site Secret to connect the plugin to our service. You can find these keys in the "Connect Your Website" section in your user panel at https://nitropack.io/

== Frequently Asked Questions ==

= Does NitroPack modify site files? =

No. NitroPack works on copies of your site files. However, it does modify your wp-config.php file if WP_CACHE is not enabled yet.

= I installed NitroPack but my pages are still slow. Why? =

After installing and activating NitroPack, you need to open its settings page and connect it with our cloud service using your Site ID and Site secret.

= Why my scores are still low after connecting NitroPack? =

After connecting NitroPack you need to select your desired optimization mode - Standard, Medium, Strong or Ludicrous. Once you do that, please visit your home page and allow NitroPack a minute to prepare an optimized version of your page. You can then run the tests again.

= How long does it take for pages to get optimized =

It usually takes several seconds for a page to become optimized.

= Can I use another page caching plugin and NitroPack at the same time? =

WordPress is designed in a way that you can use only a single page cache solution at a time. Such is the case with other page cache solutions too. You can use other non-page cache optimization solutions perfectly well with NitroPack.io (e.g. ShortPixel, database optimization plugins, etc.).

= What if I have a question? =

You can contact us anytime at https://m.me/getnitropack

= Will NitroPack slow down my server? =

No, NitroPack is designed to be very lightweight and adds no CPU overhead to your server.

== Screenshots ==
1. Connect your store
2. Dashboard - see and manage the data in your Nitropack.io

== Changelog ==

= 1.3.7 =
* Bug fix: Resolve an issue causing insufficient permissions error

= 1.3.6 =
* Bug fix: Resolve an issue with nonces in REST requests

= 1.3.5 =
* Improvement: Show instructions for configuring recommended hosting settings if needed
* Improvement: Better detection of taxonomies and archive pages
* Improvement: Better compatibility with ShortPixel
* Improvement: Better WP Engine compatibility
* Improvement: Updated nonce handling
* Bug fix: Category pages were not being optimized if archive optimization was disabled. This is now fixed.
* Bug fix: Fix an issue with custom cache expiration for The Events Calendar

= 1.3.4 =
* Improvement: Better compatibility with Kinsta
* Improvement: Improved handling of post status transiotions
* Improvement: Allow optimizations for archive pages

= 1.3.3 =
* Improvement: Optimize all post/page types by default ot avoid confusion why a certain URL is not optimized.
* Improvement: Automatically refresh cache based on comment actions (posting, approving, unapproving, etc.)

= 1.3.2 =
* Improvement: Workaround for an issue in the WP Engine environment which causes timeouts in certain network communication scenarios. This resolves slow post/page updates in the admin area.

= 1.3.1 =
* Improvement: Nicer cache purge reason messages
* Bug fix: Resolve an issue where the home page was not always updated after publishing new posts/pages

= 1.3 =
* New feature: Option select which post types and taxonomies get optimized
* New feature: Option to enable/disable the automated cache purges
* New feature: Automatically warmup new posts/pages
* New feature: Add meta box to allow cache purge/invalidate from the post/page edit screens
* New feature: New and improved way of tracking relationships between pages allowing for smarter automated cache purges, which affect less cache files
* Resolve layout issues in the admin panel on mobile
* Add compatibility with GoDaddy's managed WordPress hosting

= 1.2.3 =
* Stability improvements

= 1.2.2 =
* Synchronize the nonce and page cache life times
* Improve cache synchronization when updating menu entries
* Improve cache synchronization when making appearance customizations
* Fix false "plugin conflict" error with WP Optimize
* Stability improvements

= 1.2.1 =
* Added support for Fusion Builder's container expiration
* Added compatibility with the Post Expirator plugin
* Added compatibility with the Portfolio Sorting plugin
* Stability improvements

= 1.2 =
* Stability improvements

= 1.1.5 =
* Improved cache management for scheduled posts
* Fix cache expiration for posts scheduled for dates in the past
* Better update handling

= 1.1.4 =
* Stability improvements

= 1.1.3 =
* Prevent crashes originating from missing functions.php file

= 1.1.2 =
* Better handling of automated updates

= 1.1.1 =
* Automatically update the advanced-cache.php file after plugin update

= 1.1 =
* Performance and stability improvements

= 1.0 =
* Initial release
