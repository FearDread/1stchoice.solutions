<?php
	header( "Content-Type:text/javascript" );
	
	// Get the path to the root.
	$full_path = __FILE__;
	
	$path_bits = explode( 'wp-content', $full_path );
	
	$url = $path_bits[0];
	
	// Require WordPress bootstrap.
	require_once( $url . '/wp-load.php' );
	
	$path_bits = explode( 'wp-content', dirname(__FILE__) );
	
	$woo_framework_path = trailingslashit( '../wp-content' . substr( $path_bits[1], 0, -3 ) );
	
	$woo_framework_url = get_template_directory_uri() . '/functions/';
	
	// Check if this is a Windows server or not.
	$_is_windows = false;
	$delimiter = '/';
	$dirname = dirname( __FILE__ );
	$_has_forwardslash = strpos( $dirname, $delimiter );
	
	if ( $_has_forwardslash === false ) {
	
		$_is_windows = true;
		$delimiter = '\\';
	
	} // End IF Statement
	
	$woo_framework_functions_path = str_replace( 'js' . $delimiter . 'shortcode-generator' . $delimiter . 'js', '', dirname( __FILE__ ) );

	// Require admin functions.
	require_once( $woo_framework_functions_path . $delimiter . 'admin-functions.php' );

	global $google_fonts;

	$fonts = '';

	// Build array of usabel typefaces.
	$fonts_whitelist = array( 
						'Arial, Helvetica, sans-serif', 
						'Verdana, Geneva, sans-serif', 
						'|Trebuchet MS|, Tahoma, sans-serif', 
						'Georgia, |Times New Roman|, serif', 
						'Tahoma, Geneva, Verdana, sans-serif', 
						'Palatino, |Palatino Linotype|, serif', 
						'|Helvetica Neue|, Helvetica, sans-serif', 
						'Calibri, Candara, Segoe, Optima, sans-serif', 
						'|Myriad Pro|, Myriad, sans-serif', 
						'|Lucida Grande|, |Lucida Sans Unicode|, |Lucida Sans|, sans-serif', 
						'|Arial Black|, sans-serif', 
						'|Gill Sans|, |Gill Sans MT|, Calibri, sans-serif', 
						'Geneva, Tahoma, Verdana, sans-serif', 
						'Impact, Charcoal, sans-serif'
						);
	
	$fonts_whitelist = array(); // Temporarily remove the default fonts.

	// Get just the names of the Google fonts.
	$google_font_names = array();
	
	if ( count( $google_fonts ) ) {
	
		foreach ( $google_fonts as $g ) {
		
			$google_font_names[] = $g['name'];
		
		} // End FOREACH Loop
	
		$fonts_whitelist = array_merge( $fonts_whitelist, $google_font_names );
	
	} // End IF Statement
	
	foreach ( $fonts_whitelist as $k => $v ) {
	
		$fonts_whitelist[$k] = str_replace( '|', '\"', $v );
	
	} // End FOREACH Loop
	
	$fonts = join( '|', $fonts_whitelist );
?>

var framework_url = '<?php echo dirname( __FILE__ ); ?>';

var shortcode_generator_path = '<?php echo esc_url( $woo_framework_path ); ?>';
var shortcode_generator_url = '<?php echo esc_url( $woo_framework_url ); ?>' + 'js/shortcode-generator/';

var wooDialogHelper = {

    needsPreview: false,
    setUpButtons: function () {
        var a = this;
        jQuery( "#woo-btn-cancel").click(function () {
            a.closeDialog()
        });
        jQuery( "#woo-btn-insert").click(function () {
            a.insertAction()
        });
    },
    
    setUpColourPicker: function () {

		var startingColour = '000000';

    	jQuery( '.woo-marker-colourpicker-control div.colorSelector').each ( function () {
    	
    		var colourPicker = jQuery(this).ColorPicker({
    	
	    	color: startingColour,
			onShow: function (colpkr) {
				jQuery(colpkr).fadeIn(500);
				return false;
			},
			onHide: function (colpkr) {
				jQuery(colpkr).fadeOut(500);
				return false;
			},
			onChange: function (hsb, hex, rgb) {
				jQuery(colourPicker).children( 'div').css( 'backgroundColor', '#' + hex);
				jQuery(colourPicker).next( 'input').attr( 'value','#' + hex);
			}
	    	
	    	});
	    	
	    	// jQuery(colourPicker).children( 'div').css( 'backgroundColor', '#' + startingColour);
			// jQuery(colourPicker).next( 'input').attr( 'value','#' + startingColour);
	
	    	
    	});
    	   	
    	jQuery( '.colorpicker').css( 'position', 'absolute').css( 'z-index', '9999' );
		
    }, 

    loadShortcodeDetails: function () {
        if (wooSelectedShortcodeType) {

            var a = this;
            jQuery.getScript(shortcode_generator_url + "shortcodes/" + wooSelectedShortcodeType + ".js", function () {
                a.initializeDialog();
                
                // Set the default content to the highlighted text, for certain shortcode types.
                switch ( wooSelectedShortcodeType ) {
				
					case 'box':
					case 'ilink':
					case 'quote':
					case 'button':
					case 'abbr':
					case 'unordered_list':
					case 'ordered_list':
					case 'typography':
					
						jQuery( 'input#woo-value-content').val( selectedText );
						
					case 'toggle':
					
						jQuery( 'textarea#woo-value-content').val( selectedText );
					
					break;
				
				} // End SWITCH Statement
            })

        }

    },
    initializeDialog: function () {

        if (typeof wooShortcodeMeta == "undefined") {
            jQuery( "#woo-options").append( "<p>Error loading details for shortcode: " + wooSelectedShortcodeType + "</p>" );
        } else {
            if (wooShortcodeMeta.disablePreview) {
                jQuery( "#woo-preview").remove();
                jQuery( "#woo-btn-preview").remove()
            }
            var a = wooShortcodeMeta.attributes,
                b = jQuery( "#woo-options-table" );

            for (var c in a) {
                var f = "woo-value-" + a[c].id,
                    d = a[c].isRequired ? "woo-required" : "",
                    g = jQuery( '<th valign="top" scope="row"></th>' );

                var requiredSpan = '<span class="optional"></span>';

                if (a[c].isRequired) {

                    requiredSpan = '<span class="required">*</span>';

                } // End IF Statement
                jQuery( "<label/>").attr( "for", f).attr( "class", d).html(a[c].label).append(requiredSpan).appendTo(g);
                f = jQuery( "<td/>" );

                d = (d = a[c].controlType) ? d : "text-control";

                switch (d) {

                case "column-control":

                    this.createColumnControl(a[c], f, c == 0);

                    break;
                    
                case "tab-control":

                    this.createTabControl(a[c], f, c == 0);

                    break;

                case "icon-control":
                case "color-control":
                case "link-control":
                case "text-control":

                    this.createTextControl(a[c], f, c == 0);

                    break;
                    
                case "textarea-control":

                    this.createTextAreaControl(a[c], f, c == 0);

                    break;

                case "select-control":

                    this.createSelectControl(a[c], f, c == 0);

                    break;
                    
                case "font-control":

                    this.createFontControl(a[c], f, c == 0);

                    break;
                    
                 case "range-control":

                    this.createRangeControl(a[c], f, c == 0);

                    break;
                    
                 case "colourpicker-control":
                 
                 	this.createColourPickerControl(a[c], f, c == 0);
                 
                 	break;

                }

                jQuery( "<tr/>").append(g).append(f).appendTo(b)
            }
            jQuery( ".woo-focus-here:first").focus()

			// Add additional wrappers, etc, to each select box.
			
			jQuery( '#woo-options select').wrap( '<div class="select_wrapper"></div>' ).before( '<span></span>' );
			
			jQuery( '#woo-options select option:selected').each( function () {
			
				jQuery(this).parents( '.select_wrapper').find( 'span').text( jQuery(this).text() );
			
			});
			
			// Setup the colourpicker.
            this.setUpColourPicker();

        } // End IF Statement
    },

    /* Column Generator Element */

    createColumnControl: function (a, b, c) {
        new wooColumnMaker(b, 6, c ? "woo-focus-here" : null);
        b.addClass( "woo-marker-column-control")
    },
    
     /* Tab Generator Element */

    createTabControl: function (a, b, c) {
        new wooTabMaker(b, 10, c ? "woo-focus-here" : null);
        b.addClass( "woo-marker-tab-control")
    },

	/* Colour Picker Element */

    createColourPickerControl: function (a, b, c) {

        var f = a.validateLink ? "woo-validation-marker" : "",
            d = a.isRequired ? "woo-required" : "",
            g = "woo-value-" + a.id;

		b.attr( 'id', 'woo-marker-colourpicker-control').addClass( "woo-marker-colourpicker-control" );

		jQuery( '<div class="colorSelector"><div></div></div>').appendTo(b);

        jQuery( '<input type="text">').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'txt input-text input-colourpicker').addClass(c ? "woo-focus-here" : "").appendTo(b);

        if (a = a.help) {
            jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "woo-input-help").html(a).appendTo(b)
        }

        var h = this;
        b.find( "#" + g).bind( "keydown focusout", function (e) {
        })

    },

    /* Generic Text Element */

    createTextControl: function (a, b, c) {

        var f = a.validateLink ? "woo-validation-marker" : "",
            d = a.isRequired ? "woo-required" : "",
            g = "woo-value-" + a.id, 
            defaultValue = a.defaultValue ? a.defaultValue : "";

        jQuery( '<input type="text">').attr( "id", g).attr( "name", g).attr( 'value', defaultValue ).addClass(f).addClass(d).addClass( 'txt input-text').addClass(c ? "woo-focus-here" : "").appendTo(b);

        if (a = a.help) {
            jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "woo-input-help").html(a).appendTo(b)
        }

        var h = this;
        b.find( "#" + g).bind( "keydown focusout", function (e) {
        })

    },
    
    /* Generic TextArea Element */

    createTextAreaControl: function (a, b, c) {

        var f = a.validateLink ? "woo-validation-marker" : "",
            d = a.isRequired ? "woo-required" : "",
            g = "woo-value-" + a.id;

        jQuery( '<textarea>').attr( "id", g).attr( "name", g).attr( "rows", 10).attr( "cols", 30).addClass(f).addClass(d).addClass( 'txt input-textarea').addClass(c ? "woo-focus-here" : "").appendTo(b);
        b.addClass( "woo-marker-textarea-control" );

        if (a = a.help) {
            jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "woo-input-help").html(a).appendTo(b)
        }

        var h = this;
        b.find( "#" + g).bind( "keydown focusout", function (e) {
        })

    },

    /* Select Box Element */

    createSelectControl: function (a, b, c) {

        var f = a.validateLink ? "woo-validation-marker" : "",
            d = a.isRequired ? "woo-required" : "",
            g = "woo-value-" + a.id;

        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select').addClass(c ? "woo-focus-here" : "" );

        b.addClass( 'woo-marker-select-control' );

        var selectBoxValues = a.selectValues;
        
        var labelValues = a.selectValues;

        for (v in selectBoxValues) {

            var value = selectBoxValues[v];
            var label = labelValues[v];
            var selected = '';

            if (value == '') {

                if (a.defaultValue == value) {

                    label = a.defaultText;

                } // End IF Statement
            } else {

                if (value == a.defaultValue) {
                    label = a.defaultText;
                } // End IF Statement
            } // End IF Statement
            if (value == a.defaultValue) {
                selected = ' selected="selected"';
            } // End IF Statement
            
            selectNode.append( '<option value="' + value + '"' + selected + '>' + label + '</option>' );

        } // End FOREACH Loop
        
        selectNode.appendTo(b);

        if (a = a.help) {
            jQuery( "<br/>").appendTo(b);
            jQuery( "<span/>").addClass( "woo-input-help").html(a).appendTo(b)
        }

        var h = this;

        b.find( "#" + g).bind( "change", function (e) {
            // Update the text in the appropriate span tag.
            var newText = jQuery(this).children( 'option:selected').text();
            
            jQuery(this).parents( '.select_wrapper').find( 'span').text( newText );
        })

    },
    
    /* Range Select Box Element */

    createRangeControl: function (a, b, c) {

        var f = a.validateLink ? "woo-validation-marker" : "",
            d = a.isRequired ? "woo-required" : "",
            g = "woo-value-" + a.id;

        var selectNode = jQuery( '<select>').attr( "id", g).attr( "name", g).addClass(f).addClass(d).addClass( 'select input-select input-select-range').addClass(c ? "woo-focus-here" : "" );

        b.addClass( 'woo-marker-select-control' );

        // var selectBox