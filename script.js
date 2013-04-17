/*USE : UTF8*/
function plugin_newpagebox(ns, button_name) {
    var $edit = jQuery('#plugin__newpagebox_edit_' + button_name),
        $form = jQuery('#plugin__newpagebox_form_' + button_name);
    $form.attr('action', "?id=" + ns + $edit[0].value + "&do=edit");
}