Copyright
--------------

Garfunkel WordPress Theme, Copyright 2015 Anders Norén
Garfunkel is distributed under the terms of the GNU GPL v2



Install steps
--------------

1. Upload the theme
2. Activate the theme



Translate the theme
--------------

1. Install and activate the plugin CodeStyling Localization, available on the WordPress plugin depository.
2. Go to Tools > Localization on your WordPress installation.
3. Scroll down until you find Garfunkel in the list.
4. Click Add New Language in the Garfunkel box.
5. Select the language you wish to translate Garfunkel to, and click Create PO file.
6. Click on Edit next to the first list item in the list of strings.
7. Enter the translation, and click "Save & Next".
8. Repeat until all strings in Garfunkel have been translated.
9. Click on Generate MO File button in the top of the window.
10. Provided that your WordPress installation has the same language set as the translation you've added, the translation should now be active on your site.



Display the social menu in the navigation bar
--------------

1. Go to Admin > Appearance > Menus.
2. Create a new menu.
3. Click the "Links" dropdown in the left sidebar, and enter the URL and title of the social link you wish to include. The menu will automatically select the appropriate icon based on the domain name entered in the URL field.
4. Click "Add to Menu" to add it to the menu. Repeat for each link you wish to include.
5. Scroll down to "Menu Settings", and next to "Theme locations", select "Social Menu". Click save.
6. The menu will now be displayed on the site.

For a list of all social icons supported, visit http://genericons.com/.



Use the gallery post format
--------------

1. Go to Admin > Posts > Add New.
2. Select the "Gallery" post format in the Post Attributes box.
3. Click "Add Media" and upload the images you wish to display in the gallery.
4. Close the Media window and publish/update the post.
5. The images you uploaded should now be displayed in the post gallery.



Link Format
--------------

1. Create a new post.
2. Select "Link" in the Format window to the right.
3. In the post content, enter the title of your link within a paragraph element, and the link to the page in a link element.
4. Directly after the two elements, add the <!--more--> tag followed by the rest of the content. Example:

<p>[title]</p>
<a href="[url]">[website]</a>
<!--more-->
The rest of the content...

5. Publish.
6. The link title and link will now be displayed in a separate section from the content of your post.



Quote Format
--------------

1. Create a new post.
2. Select "Quote" in the Format window to the right.
3. In the post content, enter the quote content within a blockquote element, and the quote attribution within a cite element.
4. Directly after the two elements, add the <!--more--> tag followed by the rest of the content. Example:

<blockquote>[quote content]
<cite>[quote attribution]</cite>
</blockquote>
<!--more-->
The rest of the content...

5. Publish.
6. The quote will now be displayed in a separate section from the content of your post.



Video Format
--------------

1. Create a new post.
2. Select "Video" in the Format window to the right.
3. In the post content, enter the full url to the video you want to include.
4. Directly after the url, add the <!--more--> tag followed by the rest of the content. Example:

https://www.youtube.com/watch?v=iszwuX1AK6A
<!--more-->
The rest of the content...

5. Publish.
6. The video will now be displayed in a separate section from the content of your post.



Licenses
--------------

Standard header image license: CC0 1.0 Universal (CC0 1.0) http://creativecommons.org/publicdomain/zero/1.0/

Fira Sans font license : SIL Open Font License, 1.1 http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL

Crimson Text font license : SIL Open Font License, 1.1 http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL

Playfair Display font license : SIL Open Font License, 1.1 http://scripts.sil.org/cms/scripts/page.php?site_id=nrsi&id=OFL

Genericon font icon set license : GNU GPL v2.0 http://www.gnu.org/licenses/gpl-2.0.html

Masonry cascading grid layout library : MIT License http://desandro.mit-license.org

FlexSlider jQuery slider : GNU GPL v2.0 http://www.gnu.org/licenses/gpl-2.0.html