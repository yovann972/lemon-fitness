<h1>Projet Salle de Sport</h1>

<p dir="auto"><strong> Objectifs :</strong></p>

<p dir="auto">
L’objectif du projet est de mener une étude (Analyse des besoins) et développer l’application 
web présentée ci-dessous. Il convient également d’élaborer un dossier d’architecture web qui 
documente entre autres les choix des technologies, les choix d’architecture web et de 
configuration, les bonnes pratiques de sécurité́implémentées, etc.
Il est également demandé d’élaborer un document spécifique sur les mesures et bonnes 
pratiques de sécurité́mises en place et la justification de chacune d’entre elles. Les bases de 
données et tout autre composant nécessaire pour faire fonctionner le projet sont également
accompagnés d’un manuel de configuration et d’utilisation.
</p>

<p dir="auto"><strong> Exigences :</strong></p>

<p>
Notre client est une grande marque de salle de sport et souhaite la création d’une interface 
simple à destination de ses équipes qui gèrent les droits d'accès à ses applications web de ses 
franchisés et partenaires qui possèdent des salles de sport. Ainsi, lorsqu'une salle de sport 
ouvre et prend la franchise de cette marque, on lui donne accès à un outil de gestion en ligne. 
En fonction de ce qu’il va reverser à la marque et de son contrat, il a droit à des options ou 
modules supplémentaires. Par exemple, un onglet “faire son mailing” ou encore "gérer le 
planning équipe" ou bien “promotion de la salle" ou encore “vendre des boissons” peut être 
activé ou désactivé.
Le projet a donc pour but la création et la construction d’une interface cohérente et 
ergonomique afin d’aider leurs équipes à ouvrir des accès aux modules de leur API auprès des 
franchisés/partenaires.
L’interface devra permettre de donner de la visibilité́sur les partenaires/franchisés utilisant 
l’API et quels modules sont accessibles par ces partenaires. Elle doit faciliter l'ajout, la 
modification ou la suppression des permissions aux modules de chaque partenaire/franchisé.
</p>

<p dir="auto"><strong> Cible :</strong></p>

<p>
L’interface sera utilisée par l’équipe technique de développement de la marque.
</p>

<p dir="auto"><strong> Périmètre du projet :
</strong></p>

<p>
L’interface sera utilisée par l’équipe technique de développement de la marque.
</p>

<p>
L’interface devra avoir un design responsive et être rédigée en Français. Liste des 
fonctionnalités :
    <ul>
        <li> Afficher la liste des partenaires actifs,</li>
        <li> Afficher la liste des partenaires actifs,</li>
        <li> Afficher la liste des partenaires désactivés,</li>
        <li> Consulter les différentes structures des partenaires (activées et désactivées),</li>
        <li> Modifier les permissions des structures,</li>
        <li> Ajouter une nouvelle structure à un partenaire avec des permissions prédéfinies entre un 
    technicien du client et le partenaire concerné,
        </li>
        <li>Envoyer automatiquement un email après l’ajout d’une structure au partenaire concerné,
        </li>
        <li>Possibilité de confirmation d’accès aux données de la   structure par le partenaire,
        </li>
        <li>Afficher le contenu du mail dans un nouvel onglet.
            Pour finir, elle devra être intégrée à l’outil interne et la base de données existante. Vous êtes 
            donc libre d’adapter d'éventuelles données entrantes.
        </li>
    </ul>
</p>

<p dir="auto"><strong>Requis pour le déploiement en local</strong></p>

<ul>
    <li> (XAMPP, WAMP, MAMP) </li>
    <li> Mysql ^5.7 </li>
    <li> php: ^8.1 </li>
    <li> symfony: ^6.1 </li>
    <li> Mailtrap(serveur SMTP pour les mails) </li>
</ul>

<p><strong> Télécharger le repository et unzip le dossier </strong></p>

<p>Ouvrir un terminal</p>

<div class="highlight-bash notranslate">
    <div class="highlight">
        <pre>
            $cd lemon-fitness
            $composer install
        </pre>
    </div>
</div>

<p> Creer un fichier .env.local<p>
<p> Dans le fichier .env.local vous aurez besoin de 3 variables</p>

<ul>
    <li>APP_SECRET</li>
    <li>DATABASE_URL</li>
    <li>MAILER_DSN</li>
</ul>

<p><strong>Utiliser le terminal pour creer la base de donnée :</strong></p>
<div class="highlight-bash notranslate">
    <div class="highlight">
        <pre>
            $php bin/console doctrine:database:create
            $php bin/console doctrine:migrations:migrate
        </pre>
    </div>
</div>

<p>Se connecter à PHPMYADMIN et ajouter un utilisateur avec le role admin</p>

<p><strong>Dernière étape</strong></p>

<p> Ouvrir de nouveau le terminal : </p>
<div class="highlight-bash notranslate">
    <div class="highlight">
        <pre>$symfony server:start -d</pre>
    </div>
</div>


