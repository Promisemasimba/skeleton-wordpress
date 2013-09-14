## IMPROVEMENTS
* Look at Twenty Thirteen for footer widget/sidebar
* Add smooth scroll to top (allow for option on admin end too)

## TODO
* Shortcodes
	* `[button]`
		* size: small, large
		* color: custom color (e.g red or #000000)
		* border: border color (e.g. red or #000000)
		* text: black (for light color background on button)
		* class: custom class
		* link: button link (e.g https://www.woothemes.com)
		* window: true (open link in new window)
	* `[info_box]`
		* type: info, alert, tick, download, note
		* size: medium, large
		* style: rounded
		* border: none, full
		* icon: none OR full URL to a custom icon
	* Social Buttons
		* `[twitter]`
			* style: "horizontal", "vertical", "none" ("none" hides the counter 	* default: "horizontal")
			* url: specify URL directly
			* source: username to mention in tweet
			* related: related account
			* hashtag: optional hashtags to include.
			* size: optional size of the button (medium or large).
			* text: optional tweet text (default: title of page)
			* float: none, left, right (default: left)
			* lang: 'fr', 'de', 'es', 'js', 'hi', 'zh	*cn', 'pt', 'id', 'hu', 'it', 'da', 'tr', 'fil', 'ko', 'sv', 'no', 'zh	*tw', 'nl', 'ru', 'ja', 'fi', 'msa', 'pl' (default: english)
			* use_post_url: automatically retrieve the URL to the specific post (useful on archive screens)
		* `[twitter_follow]`
			* username: Your Twitter username. This argument is **required**
			* align: optional alignment of the button within the shortcode DIV tag container
			* count: show follower count (default is empty and true. Set to "false" to disable follower count)
			* float: none, left, right (default: left)
			* language: en, fr, de, it, es, ko, ja (default: english)
			* width: An optional width, in percentage (<strong>50%50px</strong>) format.
			* align: Used in conjunction with 'width' to align the button within the shortcode container DIV tag.
			* size: Specify the size of the button (medium or large)
			* show_screen_name: Optionally hide the display of your screen name on the button (set to "false").
		* `[digg]`
			* link: specify URL directly
			* title: specify a title (must add link also)
			* style: medium, large, compact, icon (default: medium)
			* float: none, left, right (default: left)
		* `[fb_like]`
			* float: none (default), left, right
			* url: link you want to share (default: current post ID)
			* style: standard (default), button_count
			* showfaces: true or false (default)
			* width: 450
			* verb: like (default) or recommend
			* colorscheme: light (default), dark
			* font: arial (default), lucida grande, segoe ui, tahoma, trebuchet ms, verdana
			* locale: optionally add a locale to change the Facebook button's language (eg: de_DE for German or fr_FR for French)
		* `[fb_share]`
			* type: box_count, button_count, button (default), icon_link, or icon
			* float: none, left, right (default: left)
		* `[google_plusone]`
			* href: Optional specific URL to "+1". Takes the current URL if no URL is specified
			* size: standard, small, medium, tall
			* float: none, left, right (default: left)
			* annotation: none, bubble, inline (default: none)
			* callback: optional callback JavaScript function to run when the button is clicked
			* language: optionally change the language to one of the following supported languages: 
				* Arabic
				* Bulgarian
				* Catalan
				* Chinese (Simplified)
				* Chinese (Traditional)
				* Croatian
				* Czech
				* Danish
				* Dutch
				* English (US)
				* English (UK)
				* Estonian
				* Filipino
				* Finnish
				* French
				* German
				* Greek
				* Hebrew
				* Hindi
				* Hungarian
				* Indonesian
				* Italian
				* Japanese
				* Korean
				* Latvian
				* Lithuanian
				* Malay
				* Norwegian
				* Persian
				* Polish
				* Portuguese (Brazil)
				* Portuguese (Portugal)
				* Romanian
				* Russian
				* Serbian
				* Swedish
				* Slovak
				* Slovenian
				* Spanish
				* Spanish (Latin America)
				* Thai
				* Turkish
				* Ukrainian
				* Vietnamese
	* `[stumble]`
		* design: The format to use to display the badge (horizontal_large (default), horizontal_medium, horizontal_small, icon_small, icon_large, vertical_count)
		* float: The position of the badge (left, right, none (default))
		* url: An optional URL to link to on the badge.
		* use_post: Use the most recent $post variable as the link (useful in archive screens when linking to each individual post). Alternatively, the current page URL is used.
	* `p[initerest]`
		* count: The format to use to display the counter (horizontal (default), vertical, none)
		* float: The position of the button (left, right, none (default))
		* url: An optional URL to link to on the button (defaults to current $post URL).
		* image_url: An optional image URL to link to on the button (defaults to current $post's image).
		* use_post: Use the most recent $post variable as the link (useful in archive screens when linking to each individual post).
	* `[linkedin_share]`
		* style: The format to use to display the counter (none (default), top, right)
		* float: The position of the button (left, right, none (default))
		* url: An optional URL to link to on the button (defaults to current $post URL).
	* Columns
		* Two Columns
			* `[two_col_one]`
			* `[two_col_last]`
		* Three Columns
			* `[three_col_one]`
			* `[three_col_one_last]`
			* `[three_col_two]`
			* `[three_col_two_last]`
		* Four Coluns
			* `[four_col_one]`
			* `[four_col_one_last]`
			* `[four_col_two]`
			* `[four_col_two_last]`
			* `[four_col_three]`
			* `[four_col_three_last]`
			* `[four_col_four]`
			* `[four_col_four_last]`
		* Five Columns
			* `[five_col_one]`
			* `[five_col_one_last]`
			* `[five_col_two]`
			* `[five_col_two_last]`
			* `[five_col_three]`
			* `[five_col_three_last]`
			* `[five_col_four]`
			* `[five_col_four_last]`
		* Six Columns
			* `[six_col_one]`
			* `[six_col_one_last]`
			* `[six_col_two]`
			* `[six_col_two_last]`
			* `[six_col_three]`
			* `[six_col_three_last]`
			* `[six_col_four]`
			* `[six_col_four_last]`
			* `[six_col_five]`
			* `[six_col_five_last]`
	* `[quote]`
		* style: boxed
		* float: left, right
	* Icon Link
		* `[ilink]`
			* style: download, note, tick, info, alert
			* url: the url for your link
			* icon: add an url to a custom icon
	* Lists
		* `[ul]`
			* style: tick, red-x, bullet, green-dot, arrow, star
	* Typography
		* `[dropcap]`
		* `[highlight]`
		* `[abbr]`
	* Tabs
		* `[tabs]`
			* `[tab]`
				* title is required for the tab title
			* style: boxed
	* Content
		* `[toggle]`
			* title_open: The title text for when the toggle is open
			* title_closed: The title text for when the toggle is closed
			* hide: Hide the toggle box on load
			* display_main_trigger: Display the main trigger on the toggle
			* style: white
			* border: yes
	* Social Icons
		* `[social_icon]`
			* **Required:** url: The link to your social profile. Specifying "feed" in this field will generate a link directly to your WordPress RSS feed.
			* float: Optionally float the icon to the left or right.
			* icon_url: Optionally add a custom icon URL.
			* title: Optionally add a custom title for when the user hovers over your icon.
			* profile_type: Optionally specify the type of profile in use.

## Admin Interface
* General
	* Branding
		* Custom Logo
		* Favicon
		* Custom Login Logo
	* Footer
		* Back to Top Button y/n
		* Footer (copyright)
		* Tracking Code
	* Layout
		* one-col-l
		* one-col-r
		* two-cols-l
		* two-cols-r
		* two-cols-lr
* Style
	* Colors
		* Style
			* Light
			* Dark
		* Body Background Color
		* Header Background Color
		* Footer Background Color
		* Body Background Image
* Typography
	* Global font selection (incl google fonts)
		* Family
		* Line Height
		* Size
		* Color
	* Headings
		* Font
		* Weight
		* Color
	* Navigation
		* Font
		* Size
		* Weight
		* Transform
		* Hover Color