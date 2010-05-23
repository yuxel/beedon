<?php
/* vim: set expandtab sw=4 ts=4 sts=4: */

/**
 * Test Bootstrap
 *
 * LICENSE
 *
 * This file can be distributed under terms of LGPL
 *
 * @package    SourPHP
 * @copyright  Osman Yuksel
 * @LICENSE    http://www.gnu.org/licenses/lgpl-3.0.txt
 * @version    0.1
 */


/**
 * add upper directory to include paths and init autoloader
 */
$paths = explode(PATH_SEPARATOR, get_include_path());
array_push($paths, "../");
set_include_path(implode(PATH_SEPARATOR, $paths));

include_once("../AutoLoader.php");
