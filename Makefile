login:
	$(aws ecr get-login --no-include-email --region eu-west-2)

build:
	docker-compose -f docker-compose.build.yml build

push-website: build
	docker-compose -f docker-compose.build.yml push website

stop:
	docker-compose down --remove-orphans

pull: login
	docker-compose -f docker-compose.yml pull

run: stop pull
	docker-compose -f docker-compose.yml up -d --force-recreate

run-stage: stop pull
	docker-compose -f docker-compose.yml -f docker-compose.stage.yml up -d --force-recreate

run-local: stop
	docker-compose -f docker-compose.yml -f docker-compose.local.yml up -d --force-recreate

ps-stage:
	docker-compose -f docker-compose.yml -f docker-compose.stage.yml ps

ps-local:
	docker-compose -f docker-compose.yml -f docker-compose.local.yml ps