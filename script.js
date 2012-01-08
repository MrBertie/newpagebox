/*USE : UTF8*/
function plugin_newpagebox(ns, button_name) {
    var $edit = jQuery('#plugin__newpagebox_edit_' + button_name);
    var $form = jQuery('#plugin__newpagebox_form_' + button_name);
    $form.attr('action',"?id=" + ns + $edit.value + "&do=edit");
}