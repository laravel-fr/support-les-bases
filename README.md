![header](https://repository-images.githubusercontent.com/369639032/7a00e980-ba8c-11eb-9038-d0dda0c3cf7c)

## A propos

Un starter de projet Laravel.

+ Environnement de dev basé sur Docker
+ Tailwindcss
+ Vue.js

## Lancer l'application

```bash
# Copie du fichier de configuration
cp .env.example .env

# Création des conteneurs en dev
docker-compose -f docker-compose.yml -f docker-compose.dev.yml up -d

# Création des conteneurs en prod
docker-compose -f docker-compose.yml -f docker-compose.prod.yml up -d

# Installation des dépendances
docker-compose exec app composer install
docker-compose exec app npm ci
```
