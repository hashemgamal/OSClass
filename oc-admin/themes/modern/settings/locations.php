<?php
    /**
     * OSClass – software for creating and publishing online classified advertising platforms
     *
     * Copyright (C) 2010 OSCLASS
     *
     * This program is free software: you can redistribute it and/or modify it under the terms
     * of the GNU Affero General Public License as published by the Free Software Foundation,
     * either version 3 of the License, or (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
     * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
     * See the GNU Affero General Public License for more details.
     *
     * You should have received a copy of the GNU Affero General Public
     * License along with this program. If not, see <http://www.gnu.org/licenses/>.
     */

    $aCountries = __get('aCountries');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
    <head>
        <script type="text/javascript">
            var base_url    = '<?php echo osc_admin_base_url(); ?>';
            var s_close     = '<?php _e('Close'); ?>';
            var s_view_more = '<?php _e('View more'); ?>';
        </script>
        <?php osc_current_admin_theme_path('head.php') ; ?>
    </head>
    <body>
        <?php osc_current_admin_theme_path('header.php') ; ?>
        <div id="update_version" style="display:none;"></div>
        <div class="Header"><?php _e('Dashboard'); ?></div>
        <div id="content">
            <div id="separator"></div>
            <?php osc_current_admin_theme_path ( 'include/backoffice_menu.php' ) ; ?>
            <div id="right_column">
                <div id="content_header" class="content_header">
                    <div style="float: left;">
                        <img src="<?php echo osc_current_admin_theme_url() ; ?>images/settings-icon.png" alt="" title=""/>
                    </div>
                    <div id="content_header_arrow">&raquo; <?php _e('Locations'); ?></div>
                    <div style="clear: both;"></div>
                </div>
                <div id="content_separator"></div>
                <?php osc_show_flash_message('admin') ; ?>
                <!-- settings form -->
                <div id="settings_form" style="border: 1px solid #ccc; background: #eee; min-height: 200px; ">
                    <!-- Country -->
                    <div style="float:left; width: 33%; ">
                        <div style="border-bottom: 1px dashed black; padding: 4px 4px 0px; width: 90%;" >
                            <div style="float:left;">
                                <h3 style="">
                                    <?php _e('Countries'); ?>
                                </h3>
                            </div>
                            <div style="float:right;">
                                <a id="b_new_country" href="javascript:void(0);"><?php _e('Add new'); ?></a>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div id="l_countries" style="padding: 10px 0;">
                            <?php foreach( $aCountries as $country ) { ?>
                            <div style="padding: 4px; width: 90%;">
                                <div style="float:left;">
                                    <div>
                                        <a class="close" href="<?php echo osc_admin_base_url(true); ?>?page=settings&action=locations&type=delete_country&id=<?php echo $country['pk_c_code'] ; ?>">
                                            <img src="<?php echo osc_admin_base_url() ; ?>images/close.png" alt="<?php _e('Close'); ?>" title="<?php _e('Close'); ?>" />
                                        </a>
                                        <a class="edit" href="javascript:void(0);" style="padding-right: 15px;" onclick="edit_countries($(this));"><?php echo $country['s_name'] ; ?></a>
                                    </div>
                                </div>
                                <div style="float:right">
                                    <a href="javascript:void(0)" onclick="show_region('<?php echo $country['pk_c_code']; ?>', '<?php echo $country['s_name'] ; ?>')"><?php _e('View more'); ?> &raquo;</a>
                                </div>
                            </div>
                            <div style="clear:both;"></div>
                            <?php } ?>
                        </div>
                        <div id="i_countries">
                        </div>
                    </div>
                    <!-- End country -->
                    <!-- Region -->
                    <div style="float:left; width: 33%; ">
                        <div style="border-bottom: 1px dashed black; padding: 4px 4px 0px; width: 90%;" >
                            <div style="float:left;">
                                <h3>
                                    <?php _e('Regions'); ?>
                                </h3>
                            </div>
                            <div style="float:right;">
                                <a id="b_new_region" href="javascript:void(0);" style="display: none;"><?php _e('Add new'); ?></a>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div id="i_regions" style="padding: 10px 0;">

                        </div>
                    </div>
                    <!-- End region -->
                    <!-- City -->
                    <div style="float:left; width: 33%; ">
                        <div style="border-bottom: 1px dashed black; padding: 4px 4px 0px; width: 90%;" >
                            <div style="float:left;">
                                <h3>
                                    <?php _e('Cities'); ?>
                                </h3>
                            </div>
                            <div style="float:right;">
                                <a id="b_new_city" href="javascript:void(0);" style="display:none;"><?php _e('Add new'); ?></a>
                            </div>
                            <div style="clear:both;"></div>
                        </div>
                        <div id="i_cities"  style="padding: 10px 0;">

                        </div>
                    </div>
                    <!-- End city -->
                    <div style="clear:both;"></div>
                </div>
            </div>
        </div>
        <!-- Form add country -->
        <div id="d_add_country" class="lightbox_country location">
            <div>
                <h4><?php _e('Add new country') ; ?></h4>
            </div>
            <div style="padding: 14px;">
                <form action="<?php echo osc_admin_base_url(true); ?>" method="POST" accept-charset="utf-8" onsubmit="return check_form_country();">
                    <input type="hidden" name="page" value="settings" />
                    <input type="hidden" name="action" value="locations" />
                    <input type="hidden" name="type" value="add_country" />
                    <input type="hidden" name="c_manual" value="1" />
                    <table>
                        <tr>
                            <td><?php _e('Country'); ?>: </td>
                            <td><input type="text" id="country" name="country" value="" /></td>
                        </tr>
                        <tr>
                            <td><?php _e('Country code'); ?>: </td>
                            <td><input type="text" id="c_country" name="c_country" value="" /></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><small id="c_code_error" style="color: red; display: none;"><?php _e('Country code should have two characters'); ?></small></td>
                        </tr>
                    </table>
                    <div style="margin-top: 8px; text-align: right; ">
                        <input type="button" value="<?php _e('Cancel'); ?>" onclick="$('#d_add_country').css('display','none');$('#fade').css('display','none');"/>
                        <input type="submit" name="submit" value="<?php _e('Add'); ?>" />
                    </div>
                </form>
            </div>
        </div>
        <!-- End form add country -->
        <!-- Form edit country -->
        <div id="d_edit_country" class="lightbox_country location" style="height: 140px;">
            <div>
                <h4><?php _e('Edit country') ; ?></h4>
            </div>
            <div style="padding: 14px;">
                <form action="<?php echo osc_admin_base_url(true); ?>" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="page" value="settings" />
                    <input type="hidden" name="action" value="locations" />
                    <input type="hidden" name="type" value="edit_country" />
                    <input type="hidden" name="country_old" value="" />
                    <table>
                        <tr>
                            <td><?php _e('Country'); ?>: </td>
                            <td><input type="text" id="country" name="e_country" value="" /></td>
                        </tr>
                    </table>
                    <div style="margin-top: 8px; text-align: right; ">
                        <input type="button" value="<?php _e('Cancel'); ?>" onclick="$('#d_edit_country').css('display','none');$('#fade').css('display','none');"/>
                        <input type="submit" name="submit" value="<?php _e('Edit'); ?>" />
                    </div>
                </form>
            </div>
        </div>
        <!-- End form edit country -->
        <!-- Form add region -->
        <div id="d_add_region" class="lightbox_country location" style="height: 140px;">
            <div>
                <h4><?php _e('Add new region') ; ?></h4>
            </div>
            <div style="padding: 14px;">
                <form action="<?php echo osc_admin_base_url(true); ?>" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="page" value="settings" />
                    <input type="hidden" name="action" value="locations" />
                    <input type="hidden" name="type" value="add_region" />
                    <input type="hidden" name="country_c_parent" value="" />
                    <input type="hidden" name="country_parent" value="" />
                    <input type="hidden" name="r_manual" value="1" />
                    <table>
                        <tr>
                            <td><?php _e('Region'); ?>: </td>
                            <td><input type="text" id="region" name="region" value="" /></td>
                        </tr>
                    </table>
                    <div style="margin-top: 8px; text-align: right; ">
                        <input type="button" value="<?php _e('Cancel'); ?>" onclick="$('#d_add_region').css('display','none');$('#fade').css('display','none');"/>
                        <input type="submit" name="submit" value="<?php _e('Add'); ?>" />
                    </div>
                </form>
            </div>
        </div>
        <!-- End form add region -->
        <!-- Form edit region -->
        <div id="d_edit_region" class="lightbox_country location" style="height: 140px;">
            <div>
                <h4><?php _e('Edit region') ; ?></h4>
            </div>
            <div style="padding: 14px;">
                <form action="<?php echo osc_admin_base_url(true); ?>" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="page" value="settings" />
                    <input type="hidden" name="action" value="locations" />
                    <input type="hidden" name="type" value="edit_region" />
                    <input type="hidden" name="region_id" value="" />
                    <table>
                        <tr>
                            <td><?php _e('Region'); ?>: </td>
                            <td><input type="text" id="region" name="e_region" value="" /></td>
                        </tr>
                    </table>
                    <div style="margin-top: 8px; text-align: right; ">
                        <input type="button" value="<?php _e('Cancel'); ?>" onclick="$('#d_edit_region').css('display','none');$('#fade').css('display','none');"/>
                        <input type="submit" name="submit" value="<?php _e('Edit'); ?>" />
                    </div>
                </form>
            </div>
        </div>
        <!-- End form edit region -->
        <!-- Form edit city -->
        <div id="d_add_city" class="lightbox_country location" style="height: 140px;">
            <div>
                <h4><?php _e('Add new city') ; ?></h4>
            </div>
            <div style="padding: 14px;">
                <form action="<?php echo osc_admin_base_url(true); ?>" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="page" value="settings" />
                    <input type="hidden" name="action" value="locations" />
                    <input type="hidden" name="type" value="add_city" />
                    <input type="hidden" name="country_c_parent" value="" />
                    <input type="hidden" name="country_parent" value="" />
                    <input type="hidden" name="region_parent" value="" />
                    <input type="hidden" name="ci_manual" value="1" />
                    <table>
                        <tr>
                            <td><?php _e('City'); ?>: </td>
                            <td><input type="text" id="city" name="city" value="" /></td>
                        </tr>
                    </table>
                    <div style="margin-top: 8px; text-align: right; ">
                        <input type="button" value="<?php _e('Cancel'); ?>" onclick="$('#d_add_city').css('display','none');$('#fade').css('display','none');"/>
                        <input type="submit" name="submit" value="<?php _e('Add'); ?>" />
                    </div>
                </form>
            </div>
        </div>
        <!-- End form add city -->
        <!-- Form edit city -->
        <div id="d_edit_city" class="lightbox_country location" style="height: 140px;">
            <div>
                <h4><?php _e('Edit city') ; ?></h4>
            </div>
            <div style="padding: 14px;">
                <form action="<?php echo osc_admin_base_url(true); ?>" method="POST" accept-charset="utf-8">
                    <input type="hidden" name="page" value="settings" />
                    <input type="hidden" name="action" value="locations" />
                    <input type="hidden" name="type" value="edit_city" />
                    <input type="hidden" name="city_id" value="" />
                    <table>
                        <tr>
                            <td><?php _e('City'); ?>: </td>
                            <td><input type="text" id="region" name="e_city" value="" /></td>
                        </tr>
                    </table>
                    <div style="margin-top: 8px; text-align: right; ">
                        <input type="button" value="<?php _e('Cancel'); ?>" onclick="$('#d_edit_city').css('display','none');$('#fade').css('display','none');"/>
                        <input type="submit" name="submit" value="<?php _e('Edit'); ?>" />
                    </div>
                </form>
            </div>
        </div>
        <!-- End form edit city -->
        <div id="fade" class="black_overlay"></div> 
        <?php osc_current_admin_theme_path('footer.php') ; ?>
    </body>
</html>