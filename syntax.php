<?php

if( ! defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__) . '/../../') . '/');
if( ! defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');
require_once(DOKU_PLUGIN . 'syntax.php');


class syntax_plugin_newpagebox extends DokuWiki_Syntax_Plugin {

    function getType(){
        return 'substition';
    }

    function getSort(){
        return 105;
    }

    function connectTo($mode) {
        $this->Lexer->addSpecialPattern('{{newpagebox>.*?}}', $mode, 'plugin_newpagebox');
    }

    function handle($match, $state, $pos, &$handler) {
        global $INFO;

        $opt = array();

        // default options
        $opt['button']  = 'page';               // display name on submit button
        $opt['date_ns'] = '';                   // add a date based sub-namespace
        $opt['ns']      = $INFO['namespace'];   // this namespace (default)
        $opt['show_ns'] = false;                // show the namespace as a placeholder
        $opt['width']   = '';                   // CSS width of the text box

		$match = substr($match, 13, -2);

        $args = explode(';', $match);
        foreach ($args as $arg) {
            list($key, $value) = explode('=', $arg);
            switch ($key) {
                case 'button':
                case 'width':
                    $opt[$key] = $value;
                    break;
                case 'byday':
                    $opt['date_ns'] = date('Y') . '-' . date('m') . '-' . date('d') . ':';
                    break;
                case 'bymonth':
                    $opt['date_ns'] = date('Y') . '-' . date('m') . ':';
                    break;
                case 'byyear':
                    $opt['date_ns'] = date('Y') . ':';
                    break;
                case 'ns':
                    $opt['ns'] = resolve_id($opt['ns'], $value);
                    break;
                case 'showns':
                    $opt['show_ns'] = true;
                    break;
            }
        }
		return $opt;
    }


	function render($mode, &$renderer, $opt) {
    	global $lang;

		$renderer->info['cache'] = false;
        $placeholder = ($opt['show_ns'] === true) ? sprintf($this->getLang('placeholder'), $opt['ns']) : '';

		if ($mode == 'xhtml') {
            $submit =  "plugin_newpagebox('" . $opt['ns'] . ":', '" . $opt['button'] . "'); return true;";
            $form_name = 'plugin__newpagebox_form_' . $opt['button'];
            $box_name = 'plugin__newpagebox_edit_' . $opt['button'];
            $width_css = ( ! empty($opt['width'])) ? 'style="width:' . $opt['width'] . ';"' : '';
		    $renderer->doc .=
                '<form name="editform" id="' . $form_name . '" ' .
                    'method="post" action="" accept-charset="'.$lang['encoding'].'" onsubmit="' . $submit . '">' .
                    '<div class="newpagebox" id="plugin__newpagebox" ' . $width_css . '>' .
                        '<input class="edit" type="text" name="title" id="' . $box_name . '" maxlength="255"' .
                        'tabindex="2" value="' . $opt['date_ns'] . '" placeholder="' . $placeholder . '"/>' .
                        '<input class="button" type="submit" value="' . 'New ' . $opt['button'] . '" tabindex="3" ' .
                        'title="' . $this->getLang('newpagebox_tip') . ' «' . $opt['ns'] . '»"/>' .
                    '</div>' .
                '</form>' .
                '<div class="clearer"></div>';
			return true;
		}
		return false;
	}
}