# Laravel
## Sujet : organisme de formation
Par Mathis Dyk, Raphaël Herblot & Maëva Pasteur

### Description
Nous avons réalisé un site permettant à un organisme de créer des formations en lui assignant un professeur.
<br><br>
Ce site permet d'optimiser la charge administrative à l'organisme. 
<br>
En effet, l'organisme peut simplement recruter des freelances et mettre à disposition des salles de classes pour accueillir des sessions de cours. Ces professeurs pourront ainsi proposer eux-même des formations et ouvrir des sessions selon les salles disponibles à la date souhaitée.
<br>
En optimisant la logistique des salles de classes, nous pouvons ainsi optimiser le nombre de places disponibles par session selon la classe choisie.
<br>
<br>
L'étudiant aura quant à lui, un calendrier des sessions à venir, la liste des formations disponibles et la possibilité de s'inscrire tant que la date du début de la session n'est pas atteinte.
<br>
Il peut également accéder à son emploi du temps sous forme de calendrier.
## Installation

```
composer install
npm install
```

Cloner le fichier .env.example

```
cp .env.example .env
php artisan key:generate
```

Migrer la base de données

```
php artisan migrate
```
## Base données
Vous pouvez partir d'une base de donnée vierge ou récupérer le fichier suivant
```
laravel_formation.sql
```
Dans cette base de donnée, vous pouvez accéder aux comptes :
* professeur
    * maeva.pasteur.pro@gmail.com
    * 00000000
* admin
    * admin@gmail.com
    * 00000000
* élève
    * jmarks@example.net
    * 00000000

## Mode développement
```php
php artisan serve
yarn watch
```
