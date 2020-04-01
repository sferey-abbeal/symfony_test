# Réalisation d'une API de notations

## Requis

- PHP >= 7.2.5
- SQLite

## Installation

```sh
# Installation des divers vendors
composer install

# Installation de la base de donnée
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate -n

# Peuplement de la base de donnée
php bin/console doctrine:fixtures:load -n

# Lancement du serveur
symfony server:start
```

## Accès à l'API https://127.0.0.1:8000/api

## Modéle d'utilisation via CURL

### Find all students

```sh
# GET to /api/students.json
curl --insecure --request GET \
  --url https://127.0.0.1:8000/api/students.json \
  --header 'content-type: application/json'
```

### Create student

```sh
# POST to /api/students.json
curl --insecure --request POST \
  --url https://127.0.0.1:8000/api/students.json \
  --header 'content-type: application/json' \
  --data '{
  "firstName": "John",
  "lastName": "Doe",
  "birthDate": "1987-04-01",
  "ratings": []
}'
```

### Modification d'un student

```sh
# PUT to /api/students/{:id}.json
curl --insecure --request PUT \
  --url https://127.0.0.1:8000/api/students/62.json \
  --header 'content-type: application/json' \
  --data '{
  "lastName": "Smith"
}'
```

### Suppresion d'un student

```sh
# DELETE to /api/students/{:id}.json
curl --insecure --request DELETE \
  --url https://127.0.0.1:8000/api/students/62.json
```

### Ajout d'une note

```sh
# POST to /api/ratings.json
curl --insecure --request POST \
  --url https://127.0.0.1:8000/api/ratings.json \
  --header 'content-type: application/json' \
  --data '{
  "value": 10,
  "student": "/api/students/63",
  "discipline": "/api/disciplines/6"
}'
```

### Calcul de la moyenne d'un student

```sh
# GET to /api/student/{:id}/average
curl --insecure --request GET \
  --url https://127.0.0.1:8000/api/student/63/average
```

### Calcul de la moyenne général de la classe

```sh
# GET to /api/global/average
curl --insecure --request GET \
  --url https://127.0.0.1:8000/api/global/average
```
