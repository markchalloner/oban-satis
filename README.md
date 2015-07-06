# Oban Satis

## Introduction

[Satis] repository for Oban Digital for hosting private packages.

## Installation

Via Git

``` bash
git clone git@github.com/oban/oban-satis.git
```

## Usage

``` bash
composer install
bin/build
```

The build script

- Generates an .htpasswd if none is present with the username composer
- Generates an .htaccess file from the .htaccess.php file (using [SatisGen]), creating environmental variables in a [Dotenv] file (.env) if not pre-existing.
- Generates a satis.json file from the satis.php file (using [SatisGen]), creating environmental variables in a [Dotenv] file (.env) if not pre-existing.
- Generates the satis website and creates dependency zips (using [Satis])

### Curated plugins

Curated plugins (i.e. manually updated plugins) should be kept under plugins, in the following format

```
/plugins/{{vendor}}/{{name}}/{{name}}-{{version}}.zip
```

These are automatically loaded in the satis.php file. See:

```
satis.php
```

These zip files are a direct zip of the plugins contents (i.e. do not hold a top level folder). An example of the folder structure these zip files should adhere to are:

```
name.zip
|- assets/
|- config/
|- include
|- credits.txt
|- name.php
```

The zip files downloaded (e.g. from Envato/CodeCanyon) may have to be unzipped and the correct contents rezipped to follow this folder structure.

## Change log

Please see [CHANGELOG] for more information what has changed recently.

[Satis]: https://getcomposer.org/doc/articles/handling-private-packages-with-satis.md#satis
[SatisGen]: https://github.com/markchalloner/satisgen
[Dotenv]: https://github.com/vlucas/phpdotenv
[CHANGELOG]: CHANGELOG.md

