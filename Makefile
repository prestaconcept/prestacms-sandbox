install:
	app/console doctrine:database:drop --force
	app/console doctrine:database:create
	app/console doctrine:schema:create
	app/console doctrine:phpcr:repository:init
	app/console doctrine:phpcr:fixtures:load --no-interaction
	app/console doctrine:fixture:load --no-interaction
	chmod 777 app/database
	app/console assets:install --symlink
	app/console assetic:dump --env=prod

deploy-configure:
	curl -s http://getcomposer.org/installer | php
	php composer.phar install
	app/console assets:install web
	app/console assetic:dump --env=prod

deploy-install:
	rm -rf app/cache/*
	chmod 777 app/database app/logs app/cache
	chmod 777 app/database/*
	chmod -R 777 web/uploads

deploy-update: cc install

refresh:
	app/console doctrine:phpcr:fixtures:load --no-interaction
	app/console doctrine:fixture:load --no-interaction
	app/console cache:clear --env=prod

r:
	app/console doctrine:phpcr:fixtures:load --no-interaction

cc:
	rm -rf app/cache/*

cs:
	phpcs --extensions=php -n --standard=PSR2 --report=full src
