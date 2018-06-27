build:
	docker-compose -f docker-compose.build.yml build

push-website: build
	docker-compose -f docker-compose.build.yml push website

stop:
	docker-compose down --remove-orphans

run: stop
	docker-compose -f docker-compose.yml up -d --force-recreate

run-stage: stop
	docker-compose -f docker-compose.yml -f docker-compose.stage.yml up -d --force-recreate

run-local: stop
	docker-compose -f docker-compose.yml -f docker-compose.local.yml up -d --force-recreate

ps-stage:
	docker-compose -f docker-compose.yml -f docker-compose.stage.yml ps

ps-local:
	docker-compose -f docker-compose.yml -f docker-compose.local.yml ps