/*USE : UTF8*/
function set_newpage(ns, button_name) {
    var name_box = $('newpage_title_' + button_name);
    $("editform_" + button_name).setAttribute("action","?id=" + ns + name_box.value + "&do=edit");
}