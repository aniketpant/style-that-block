<?php  
    if($_POST['stb_hidden'] == 'Y') {
        $stb_settings['theme'] = $_POST['stb_theme'];
        $stb_settings['padding'] = $_POST['stb_padding'];
        update_option('stb_settings', $stb_settings);
?>
<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
<?php
    } else {
        $stb_settings = get_option('stb_settings');
    }  
?>  
<div class="wrap">
    <?php screen_icon(); ?>
    <h2> <?php echo _e('Style That Block Options'); ?></h2>
    <form name="stb_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="stb_hidden" value="Y" />
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="stb_theme"><?php echo _e('Theme') ?></label>
                </th>
                <td>
                    <select id="stb-theme" name="stb_theme">
                        <option <?php if ($stb_settings['theme'] == 'light') { echo 'selected="selected"'; } ?> value="light">Light</option>
                        <option <?php if ($stb_settings['theme'] == 'dark') { echo 'selected="selected"'; } ?> value="dark">Dark</option>
                        <option <?php if ($stb_settings['theme'] == 'awesome') { echo 'selected="selected"'; } ?> value="awesome">Awesome</option>
                    </select>
                    <br/>
                    <span class="description">Choose the theme you would like to use</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="stb_padding"><?php echo _e('Padding') ?></label>
                </th>
                <td>
                    <input id="stb-padding" class="small-text" name="stb_padding" value="<?php echo $stb_settings['padding'] ?>" /><?php echo _e('px') ?>
                    <br/>
                    <span class="description">Enter the padding you would like to have on the left and right</span>
                </td>
            </tr>
        </table>
        <hr>
        <p class="submit">  
            <input class="button-primary" type="submit" name="Submit" value="<?php _e('Update Options') ?>" />
        </p>
    </form>
    
    <h2><?php echo _e('Preview'); ?></h2>
    <div id="preview">
        <span class="code">This is a test code block.</span>
    </div>
    
    <style>
        #preview span.code {
            font-family: sans-serif;
        }
    </style>
    
    <script type="text/javascript">
    //<![CDATA[
	jQuery(document).ready(function($) {
            
            /**
             * Sets css for preview
             */
            function update_preview(theme, padding) {
                var cssObj = new Array();
                cssObj['padding'] = '2px ' + padding + 'px';
                cssObj['line-height'] = '1.5em';
                cssObj['font-size'] = '13px';
                cssObj['box-shadow'] = 'none';
                cssObj['border-radius'] = '0';
                if (theme == 'light') {
                    cssObj['background-color'] = 'rgba(0, 0, 0, 0.1)';
                    cssObj['color'] = '#333';
                    $('#preview span.code').css(cssObj);
                }
                else if (theme == 'dark') {
                    cssObj['background-color'] = 'rgba(0, 0, 0, 0.75)';
                    cssObj['color'] = '#fff';
                    $('#preview span.code').css(cssObj);
                }
                else if (theme == 'awesome') {
                    cssObj['background-color'] = 'rgba(0, 0, 0, 0.05)';
                    cssObj['box-shadow'] = 'inset 0 0 3px rgba(0, 0, 0, 0.25)';
                    cssObj['border-radius'] = '2px';
                    cssObj['color'] = '#ff487f';
                    $('#preview span.code').css(cssObj);
                }
            }
            
            /*
             * On page load
             */
            var theme = $('#stb-theme').val();
            var padding = $('#stb-padding').val();
            update_preview(theme, padding);
            
            /*
             * When theme selection is changed
             */
            $('#stb-theme').change(function() {
                var theme = $('#stb-theme').val();
                var padding = $('#stb-padding').val();
                update_preview(theme, padding);
            });
            
            /*
             * When padding is changed
             */
            $('#stb-padding').keyup(function() {
                var theme = $('#stb-theme').val();
                var padding = $('#stb-padding').val();
                update_preview(theme, padding);
            });
        });
    //]]>
    </script>
</div>