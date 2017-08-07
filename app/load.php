<?php

/**
 * @author Doanln
 * @copyright 2017
 */

include_once(CLASSDIR.'array.php');
include_once(CLASSDIR.'bitly.php');
include_once(FUNCDIR.'request.php');
include_once(FUNCDIR.'bitly.php');
include_once(FUNCDIR.'html.php');

include_once(CLASSDIR.'curl.php');
include_once(CLASSDIR.'cube_data.php');
include_once(CLASSDIR.'datas.php');
include_once(CLASSDIR.'db.php');
include_once(CLASSDIR.'files.php');
include_once(CLASSDIR.'PDOdb.php');
include_once(CLASSDIR.'map.php');
include_once(CLASSDIR.'paging.php');
include_once(CLASSDIR.'path.php');
include_once(CLASSDIR.'Table.php');
include_once(CLASSDIR.'vars.php');
include_once(CLASSDIR.'Model.php');
include_once(CLASSDIR.'html_menu.php');

include_once(FUNCDIR.'map.php');
include_once(FUNCDIR.'cubes.php');
include_once(FUNCDIR.'Model.php');
//include_once(FUNCDIR.'language.php');
include_once(FUNCDIR.'path.php');

include_once(FUNCDIR.'html_vars.php');
include_once(FUNCDIR.'str.php');


include_once(SYSTEMDIR.'cube.php');
include_once(SYSTEMDIR.'view.php');
include_once(SYSTEMDIR.'cube_session.php');
cube::config($config);
cube_start();

include_once(SYSTEMDIR.'controller.php');

cube_finish();





?>