<?php  
    if($_POST['forcod_hidden'] == 'Y') {
        $forcod_settings['theme'] = $_POST['forcod_theme'];
        $forcod_settings['padding'] = $_POST['forcod_padding'];
        update_option('forcod_settings', $forcod_settings);
?>
<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
<?php
    } else {
        $forcod_settings = get_option('forcod_settings');
    }  
?>  
<div class="wrap">
    <?php screen_icon(); ?>
    <h2> <?php echo _e('Format Code Options'); ?></h2>
    <form name="forcod_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <input type="hidden" name="forcod_hidden" value="Y" />
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    <label for="forcod_theme"><?php echo _e('Theme') ?></label>
                </th>
                <td>
                    <select id="forcod-theme" name="forcod_theme">
                        <option <?php if ($forcod_settings['theme'] == 'light') { echo 'selected="selected"'; } ?> value="light">Light</option>
                        <option <?php if ($forcod_settings['theme'] == 'dark') { echo 'selected="selected"'; } ?> value="dark">Dark</option>
                    </select>
                    <br/>
                    <span class="description">Choose the theme you would like to use</span>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    <label for="forcod_padding"><?php echo _e('Padding') ?></label>
                </th>
                <td>
                    <input id="forcod-padding" class="small-text" name="forcod_padding" value="<?php echo $forcod_settings['padding'] ?>" /><?php echo _e('px') ?>
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
                if (theme == 'light') {
                    cssObj['background-color'] = 'rgba(0, 0, 0, 0.05)';
                    cssObj['color'] = '#666';
                    $('#preview span.code').css(cssObj);
                }
                else if (theme == 'dark') {
                    cssObj['background-color'] = 'rgba(0, 0, 0, 0.75)';
                    cssObj['color'] = '#fff';
                    $('#preview span.code').css(cssObj);
                }
            }
            
            /*
             * On page load
             */
            var theme = $('#forcod-theme').val();
            var padding = $('#forcod-padding').val();
            update_preview(theme, padding);
            
            /*
             * When theme selection is changed
             */
            $('#forcod-theme').change(function() {
                var theme = $('#forcod-theme').val();
                var padding = $('#forcod-padding').val();
                update_preview(theme, padding);
            });
            
            /*
             * When padding is changed
             */
            $('#forcod-padding').keyup(function() {
                var theme = $('#forcod-theme').val();
                var padding = $('#forcod-padding').val();
                update_preview(theme, padding);
            });
        });
    //]]>
    </script>
</div>