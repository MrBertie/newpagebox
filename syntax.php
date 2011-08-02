<?php
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__) . '/../../') . '/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN', DOKU_INC . 'lib/plugins/');
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
        $opt['ns'] = $INFO['namespace'];   // this namespace (default)
        $opt['button'] = 'page';           // button display name
        $opt['date_ns'] = '';              // date based sub-namespace
        $opt['show_ns'] = false;

		$match = substr($match, 13, -2);

        $args = explode(';', $match);
        foreach ($args as $arg) {
            list($key, $value) = explode('=', $arg);
            switch ($key) {
                case 'button':
                    $opt['button'] = $value;
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

		if ($mode == 'xhtml') {
            $submit =  "set_newpage('" . $opt['ns'] . ":', '" . $opt['button'] . "'); return true;";
            $show_ns = ($opt['show_ns'] === true) ? '<div class="namespace">' . $opt['ns'] . ' :</div>' : '';
		    $renderer->doc .= '<form name="editform" id="editform_' . $opt['button'] . '" method="post" action="" accept-charset="'.$lang['encoding'].'" onsubmit="' . $submit . '">' .
                              '<div class="newpage" id="newpage">' . $show_ns .
                                  '<div class="right">' .
                                      '<input class="button" type="submit" value="' . 'New ' . $opt['button'] . '" tabindex="3" ' .
                                        'title="' . $this->getLang('newpagebox_tip') . ' «' . $opt['ns'] . '»"/>' .
                                  '</div>' .
                                  '<div class="left">' .
                                      '<input class="edit" type="text" name="title" id="newpage_title_' . $opt['button'] . '" maxlength="255"' .
                                        'tabindex="2" value="' . $opt['date_ns'] . '"/>' .
                                  '</div>' .
                              '</div>' .
                              '</form>';
			return true;
		}
		return false;
	}
}