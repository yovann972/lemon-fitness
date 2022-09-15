Lemon Fitness Webapp (ECF 2022)

Requis:
    - php: ^8.1
    - symfony: ^6.1
    - mailtrap(serveur SMTP)


Pour le déploiement en local:

Télécharger le repository et unzip le dossier

$cd lemon-fitness
$composer install

$php bin/console doctrine:database:create
$php bin/console make:migration
$php bin/console doctrine:migrations:migrate

