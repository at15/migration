# Migration

## Docker

- install mysql5.5 `docker pull mysql:5.5`
- list all the images `docker images`
- list running containers `docker ps`
- list all containers (include stopped one) `docker ps -a`
- remove all stopped containers `docker rm $(docker ps -a -q)`
- start mysql `docker run --name migration-mysql -e MYSQL_ROOT_PASSWORD=docker -d -p 4407:3306 mysql:5.5`
  the port in host is `4407` and root password is `docker`

http://yeasy.gitbooks.io/docker_practice/content/container/rm.html

TODO:

It's quite strange, when have mysql installed and docker mysql running