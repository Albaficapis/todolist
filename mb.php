<?php

if (extension_loaded('mbstring')) {
    echo 'mbstring est installé';
} else {
    echo 'mbstring n\'est pas installé';
}
phpinfo();