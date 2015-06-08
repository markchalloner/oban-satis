<?php

$name = $config->getConfig('NAME', 'the Satis name', null, function($answer) {
    if (0 === strlen($answer)) {
        throw new \RuntimeException(
            'The name must be entered'
        );
    }
    return $answer;
});

?>
AuthType Basic
AuthName "<?php echo $name ?>"
AuthUserFile "<?php echo __DIR__ ?>/.htpasswd"
Require valid-user
