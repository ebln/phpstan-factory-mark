DEFAULT_CONTAINER=php
DOCKER_COMPOSE_DIR=./.provision
DOCKER_COMPOSE_YML=$(DOCKER_COMPOSE_DIR)/docker-compose.yml
MKFILE_PATH=$(abspath $(lastword $(MAKEFILE_LIST)))
CURRENT_DIR=$(notdir $(patsubst %/,%,$(dir $(MKFILE_PATH))))
DOCKER_COMPOSE=COMPOSE_PROJECT_NAME=$(CURRENT_DIR) docker-compose -f $(DOCKER_COMPOSE_YML)
MAKE=make -s
.DEFAULT_GOAL := help

.PHONY: help build rm down stop enter test quality style-fix coverage

help: ## Show this help.
	@grep -E '^[a-zA-Z_-]+:.*?##\s*.*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?##\\s*"}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

build:##Build containers
	$(MAKE) rm
	$(DOCKER_COMPOSE) build --force-rm

rm:##Remove containers
	$(DOCKER_COMPOSE) rm --force --stop -v

down:####Alias of «rm»
	$(MAKE) rm
stop:##Alias of «rm»
	$(MAKE) rm

enter:##Log into the main container
	$(DOCKER_COMPOSE) run --rm ${DEFAULT_CONTAINER} /bin/bash

quality:##Run the complete code quality suite
	$(DOCKER_COMPOSE) run --rm ${DEFAULT_CONTAINER} composer quality

style-fix:##Apply code style
	$(DOCKER_COMPOSE) run --rm ${DEFAULT_CONTAINER} composer style-fix
