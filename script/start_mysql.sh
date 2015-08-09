#!/usr/bin/env bash
docker run --name migration-mysql -e MYSQL_ROOT_PASSWORD=docker -d -p 4407:3306 mysql:5.5