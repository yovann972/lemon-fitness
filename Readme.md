<h1>Lemon Fitness Webapp (ECF 2022)</h1>

Requis:
<ul> 
    <li>php: ^8.1<li>
    <li>symfony: ^6.1</li>
    <li>mailtrap(serveur SMTP)</li>
</ul>


Pour le déploiement en local:

$cd lemon-fitness
$composer install

$php bin/console doctrine:database:create
$php bin/console make:migration
$php bin/console doctrine:migrations:migrate