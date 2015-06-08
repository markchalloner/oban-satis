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
        {
            "_comment": "Custom package for ACF Pro see: http://support.advancedcustomfields.com/forums/topic/composer-support/", 
            "type": "package",
            "package": {
                "name": "advanced-custom-fields/advanced-custom-fields-pro",
                "version": "5.2.5",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "http://connect.advancedcustomfields.com/index.php?t=5.2.5&p=pro&a=download&k=<?php $licence_acf ?>"
                }
            }
        },
        {
            "_comment": "Custom package for WP Migrate DB Pro see: https://deliciousbrains.com/wp-migrate-db-pro/doc/installing-via-composer/", 
            "type": "package",
            "package": {
                "name": "deliciousbrains/wp-migrate-db-pro",
                "version": "1.4.7",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "https://deliciousbrains.com/dl/wp-migrate-db-pro-latest.zip?licence_key=<?php $licence_wpmdb ?>&site_url=<?php echo $target_domain ?>"
                }
            }
        },
        {
            "type": "package",
            "package": {
                "name": "deliciousbrains/wp-migrate-db-pro-cli",
                "version": "1.1",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "https://deliciousbrains.com/dl/wp-migrate-db-pro-cli-latest.zip?licence_key=<?php $licence_wpmdb ?>&site_url=<?php echo $target_domain ?>"
                }
            }
        },
        {
            "type": "package",
            "package": {
                "name": "deliciousbrains/wp-migrate-db-pro-media-files",
                "version": "1.3.1",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "https://deliciousbrains.com/dl/wp-migrate-db-pro-media-files-latest.zip?licence_key=<?php $licence_wpmdb ?>&site_url=<?php echo $target_domain ?>"
                }
            }
        },
        {
            "_comment": "Custom package for Gravity Forms see: https://github.com/gravityforms/gravityforms", 
            "type": "package",
            "package": {
                "name": "gravityforms/gravityforms",
                "version": "1.9.5.12",
                "type": "wordpress-plugin",
                "dist": {
                        "type": "zip",
                        "url": "https://github.com/gravityforms/gravityforms/archive/1.9.5.12.zip"
                }
            }
        },
        {
            "_comment": "Custom package for Visual Composer sourced from Envato CodeCanyon http://codecanyon.net/",
            "type": "package",
            "package": {
                "name": "envato/js_composer",
                "version": "4.5.1",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "plugins/js_composer.zip"
                }
            }
        },
        {
            "_comment": "Custom package for Slider Revolution Responsive sourced from Envato CodeCanyon http://codecanyon.net/",
            "type": "package",
            "package": {
                "name": "envato/revslider",
                "version": "1.1",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "plugins/revslider.zip"
                }
            }
        },
        {
            "_comment": "Custom package for Testimonial Showcase sourced from Envato CodeCanyon http://codecanyon.net/",
            "type": "package",
            "package": {
                "name": "envato/testimonials-showcase",
                "version": "1.2",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "plugins/testimonials-showcase.zip"
                }
            }
        },
        {
            "_comment": "Custom package for TouchCarousel sourced from Envato CodeCanyon http://codecanyon.net/",
            "type": "package",
            "package": {
                "name": "envato/touchcarousel",
                "version": "1.3",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "plugins/touchcarousel.zip"
                }
            }
        },
        {
            "_comment": "Custom package for VersionPress sourced from http://versionpress.net/",
            "type": "package",
            "package": {
                "name": "versionpress/versionpress",
                "version": "1.0.1",
                "type": "wordpress-plugin",
                "dist": {
                    "type": "zip",
                    "url": "plugins/versionpress.zip"
                }
            }
        }
    ],
    "require-all": true
}
