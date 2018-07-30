<?php
/**
 * Concos - Calibre on Nextcloud OPDS Server
 *
 * @author Claas Lisowski
 * @copyright 2018 Claas Lisowski
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 */

namespace OCA\Calibre_opds;

require_once 'base.php';

$err = getURLParam('err', -1);
$full = getURLParam('full');
$error = NULL;
switch ($err) {
case 1:
    $error = 'Database error';
    break;
}

$format = new Format;

$html = '<h2><b><u> COPS Configuration Check </u></b></h2>';
$formatted_html = $format->HTML($html);
echo $formatted_html;

if (!is_null($error)) {
    $error_title = '<h3>You\'ve been redirected because COPS is not configured properly</h3>';
    $formatted_error_title = $format->HTML($error_title);
    echo $formatted_error_title;

    $formatted_error = $format->HTML($error);
    echo $error;
}

$html = '<h3>Check if PHP version is correct</h3>';
$formatted_html = $format->HTML($html);
echo $formatted_html;
if (defined('PHP_VERSION_ID')) {
    if (PHP_VERSION_ID >= 50300) {
        echo 'OK (' . PHP_VERSION . ')';
    } else {
        echo 'Please install PHP >= 5.3 (' . PHP_VERSION . ')';
    }
} else {
    echo 'Please install PHP >= 5.3';
}

$html = '<h3>Check if GD is properly installed and loaded</h3>';
$formatted_html = $format->HTML($html);
echo $formatted_html;
if (extension_loaded('gd') && function_exists('gd_info')) {
    echo 'OK';
} else {
    echo 'Please install the php5-gd / php7.0-gd extension and make sure it\'s enabled';
}

$html = '<h3>Check if Sqlite is properly installed and loaded</h3>';
$formatted_html = $format->HTML($html);
echo $formatted_html;
if (extension_loaded('pdo_sqlite')) {
    echo 'OK';
} else {
    echo 'Please install the php5-sqlite / php7.0-sqlite3 extension and make sure it\'s enabled';
}

$html = '<h3>Check if libxml is properly installed and loaded</h3>';
$formatted_html = $format->HTML($html);
echo $formatted_html;
if (extension_loaded('libxml')) {
    echo 'OK';
} else {
    echo 'Please make sure libxml is enabled';
}

$html = '<h3>Check if Json is properly installed and loaded</h3>';
$formatted_html = $format->HTML($html);
echo $formatted_html;
if (extension_loaded('json')) {
    echo 'OK';
} else {
    echo 'Please install the php5-json / php7.0-json extension and make sure it\'s enabled';
}

$html = '<h3>Check if mbstring is properly installed and loaded</h3>';
$formatted_html = $format->HTML($html);
echo $formatted_html;
if (extension_loaded('mbstring')) {
    echo 'OK';
} else {
    echo 'Please install the php5-mbstring / php7.0-mbstring extension and make sure it\'s enabled';
}

$html = '<h3>Check if intl is properly installed and loaded</h3>';
$formatted_html = $format->HTML($html);
echo $formatted_html;
if (extension_loaded('intl')) {
    echo 'OK';
} else {
    echo 'Please install the php5-intl / php7.0-intl extension and make sure it\'s enabled';
}

$html = '<h3>Check if Normalizer class is properly installed and loaded</h3>';
$formatted_html = $format->HTML($html);
echo $formatted_html;
if (class_exists('Normalizer', $autoload = false)) {
    echo 'OK';
} else {
    echo 'Please make sure intl is enabled in your php.ini';
}

$i = 0;
foreach (Base::getDbList() as $name => $database) {

    $html = '<h3>Check if Calibre database path is not an URL</h3>';
    $formatted_html = $format->HTML($html);
    echo $formatted_html;
    if (!preg_match('#^http#', $database)) {
        echo $name . ' OK';
    } else {
        echo $name . ' Calibre path has to be local (no URL allowed)';
    }

    $html = '<h3>Check if Calibre database file exists and is readable</h3>';
    $formatted_html = $format->HTML($html);
    echo $formatted_html;

    $file = \OC\Files\Filesystem::isReadable(Base::getDbFileName($i));
    if ($file) {
        echo $name . ' OK';
    } else {
        echo $name . ' File ' . Base::getDbFileName($i) . ' not found,
Please check
<ul>
<li>Value of \'concos_user_calibre_path\'</li>
<li>Value of <a href="http://php.net/manual/en/ini.core.php#ini.open-basedir">open_basedir</a> in your php.ini</li>
<li>The access rights of the Calibre Database</li>
<li>Synology users please read <a href="https://github.com/seblucas/cops/wiki/Howto---Synology">this</a></li>
<li>Note that hosting your Calibre Library in /home is almost impossible due to access rights restriction</li>
</ul>';
    }

    $calibre_db = getFullFilePath(Base::getDbFileName($i));

    $html = '<h3>Check if Calibre database file can be opened with PHP</h3>';
    $formatted_html = $format->HTML($html);
    echo $formatted_html;
    try {
        $db = new \PDO('sqlite:' . $calibre_db);
        echo $name . ' OK';
    } catch (Exception $e) {
        echo $name . ' If the file is readable, check your php configuration. Exception detail : ' . $e;
    }

    $html = '<h3>Check if Calibre database file contains at least some of the needed tables</h3>';
    $formatted_html = $format->HTML($html);
    echo $formatted_html;
    try {
        $db = new \PDO('sqlite:' . $calibre_db);
        $count = $db->query('select count(*) FROM sqlite_master WHERE type="table" AND name in ("books", "authors", "tags", "series")')->fetchColumn();
        if ($count == 4) {
            echo $name . ' OK';
        } else {
            echo $name . ' Not all Calibre tables were found. Are you sure you\'re using the correct database.';
        }
    } catch (Exception $e) {
        echo $name . ' If the file is readable, check your php configuration. Exception detail : ' . $e;
    }

    $html = '<h3>Check if all Calibre books are found</h3>';
    $formatted_html = $format->HTML($html);
    echo $formatted_html;
    try {
        $db = new \PDO('sqlite:' . $calibre_db);
        $result = $db->prepare('select books.path || "/" || data.name || "." || lower (format) as fullpath from data join books on data.book = books.id');
        $result->execute();
        while ($post = $result->fetchObject()) {
            if (!is_file(Base::getDbDirectory($i) . $post->fullpath)) {
                echo '<p>' . Base::getDbDirectory($i) . $post->fullpath . '</p>';
            }
        }
    } catch (Exception $e) {
        echo $name . ' If the file is readable, check your php configuration. Exception detail : ' . $e;
    }
}
?>


