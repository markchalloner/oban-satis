<?php

$target_domain = 'www.obandigital.com';

$name = $config->getConfig('NAME', 'the Satis name', null, function($answer) {
    if (0 === strlen($answer)) {
        throw new \RuntimeException(
            'The name must be entered'
        );
    }
    return $answer;
});

$domain = $config->getConfig('DOMAIN', 'the Satis domain (without http(s)://)', null, function($answer) {
    
    if (preg_match('#^https?://#', $answer)) {
        throw new \RuntimeException(
            'The domain should not begin with http:// or https://'
        );
    }
    return $answer;
});

$licence_acf = $config->getConfig('LICENCE_ACF', 'your Advance Custom Fields Pro licence key', null, function($answer) {
    if (0 === strlen($answer)) {
        throw new \RuntimeException(
            'The ACF licence must be entered'
        );
    }
    return $answer;
}, true);

$licence_wpmdb = $config->getConfig('LICENCE_WPMDB', 'your WP Migrate DB Pro licence key', null, function($answer) {
    if (0 === strlen($answer)) {
        throw new \RuntimeException(
            'The ACF licence must be entered'
        );
    }
    return $answer;
}, true);

$packages = array(
    array(
        'vendor'   => 'advanced-custom-fields',
        'name'     => 'advanced-custom-fields-pro',
        '_comment' => 'Custom package for ACF Pro see: http://support.advancedcustomfields.com/forums/topic/composer-support/',
        'versions' => array('5.2.5', '5.2.7'),
        'url'      => 'http://connect.advancedcustomfields.com/index.php?t=%3$s&p=pro&a=download&k='.$licence_acf
    ),
/* Replaced with curated plugins (plugins/) until we can get specific versions direct from DeliciousBrains
    array(
        'vendor'   => 'deliciousbrains',
        'name'     => 'wp-migrate-db-pro',
        '_comment' => 'Custom package for WP Migrate DB Pro see: https://deliciousbrains.com/wp-migrate-db-pro/doc/installing-via-composer/',
        'versions' => array('1.4.7', '1.5'),
        'url'      => 'https://deliciousbrains.com/dl/wp-migrate-db-pro-latest.zip?licence_key='.$licence_wpmdb.'&site_url='.$target_domain
    ),
    array(
        'vendor'   => 'deliciousbrains',
        'name'     => 'wp-migrate-db-pro-cli',
        '_comment' => '',
        'versions' => array('1.1'),
        'url'      => 'https://deliciousbrains.com/dl/wp-migrate-db-pro-cli-latest.zip?licence_key='.$licence_wpmdb.'&site_url='.$target_domain
    ),
    array(
        'vendor'   => 'deliciousbrains',
        'name'     => 'wp-migrate-db-pro-media-files',
        '_comment' => '',
        'versions' => array('1.3.1'),
        'url'      => 'https://deliciousbrains.com/dl/wp-migrate-db-pro-media-files-latest.zip?licence_key='.$licence_wpmdb.'&site_url='.$target_domain
    ),
*/
    array(
        'vendor'   => 'gravityforms',
        'name'     => 'gravityforms',
        '_comment' => 'Custom package for Gravity Forms see: https://github.com/gravityforms/gravityforms',
        'versions' => array('1.9.5.12'),
        'url'      => 'https://github.com/gravityforms/gravityforms/archive/%3$s.zip'
    )
);

function get_plugins_packages($plugins_dir) {
    $packages = array();
    if (file_exists($plugins_dir)) {
        $dirs = str_replace($plugins_dir.'/', '', glob($plugins_dir.'/*/*', GLOB_ONLYDIR));
        foreach($dirs as $dir) {
            list($vendor, $name) = explode('/', $dir, 2);
            $packages[] = array(
                'vendor'   => $vendor,
                'name'     => $name,
                '_comment' => file_exists($dir.'/description.txt') ? file_get_contents($dir.'/description.txt') : '',
                'versions' => array_map(function($file) {
                                 return preg_replace('/^.*-([\d.]+)\.zip$/', '\1', $file);
                              }, str_replace($plugins_dir.'/'.$dir.'/', '', glob($plugins_dir.'/'.$dir.'/*.zip'))),
                'url'      => 'plugins/%1$s/%2$s/%2$s-%3$s.zip'
            );
        }
    }
    return $packages;
}

$packages = array_merge($packages, get_plugins_packages(__DIR__.'/plugins'));

?>
{
    "name": "<?php echo $name ?>",
    "homepage": "http://<?php echo $domain ?>",
    "archive": {
        "directory": "dist",
        "format": "zip",
        "prefix-url": "http://<?php echo $domain ?>",
        "skip-dev": true
    },
    "repositories": [
        <?php foreach ($packages as $i => $package): ?>
        <?php foreach ($package['versions'] as $version): ?>
        {
            <?php if (array_key_exists('comment', $package)): ?>
            "_comment": "<?= $package['comment'] ?>",
            <?php endif ?>
            "type": "package",
            "package": {
                "name": "<?= $package['vendor'] ?>/<?= $package['name'] ?>",
                "version": "<?= $version ?>",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "<?= sprintf($package['url'], $package['vendor'], $package['name'], $version) ?>"
                }
            }
        }<?= ($i < count($packages) - 1 ? ',' : '') . "\n" ?>
        <?php endforeach ?>
        <?php endforeach ?>
    ],
    "require-all": true
}
