<?php

/**
 * @author Doanln
 * @copyright 2017
 */

$mess = _get('message')?_get('message'):'access [cube site]/test?message=YOUR_TEXT_MESSAGE to test';

add_pagetitle('Testing page');

cube::set_var('message',$mess);

view::display('error');

?>