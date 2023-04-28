APP=roomraccoon_assessment_php-cli

exec:
	docker exec -it $(APP) bash

up:
	docker compose up --build -d

down:
	docker compose down -v --remove-orphans
