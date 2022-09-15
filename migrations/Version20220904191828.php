<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220904191828 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partners (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, active TINYINT(1) NOT NULL, short_description VARCHAR(150) NOT NULL, long_description LONGTEXT NOT NULL, logo VARCHAR(255) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_EFEB5164DC2902E0 (client_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE permissions (id INT AUTO_INCREMENT NOT NULL, install_id_id INT NOT NULL, sell_drinks TINYINT(1) NOT NULL, members_statistiques TINYINT(1) NOT NULL, payment_schedules TINYINT(1) NOT NULL, employee_planning TINYINT(1) NOT NULL, INDEX IDX_2DEDCC6F1BE7EDD8 (install_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE structures (id INT AUTO_INCREMENT NOT NULL, client_id_id INT NOT NULL, partner_id_id INT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(5) NOT NULL, UNIQUE INDEX UNIQ_5BBEC55ADC2902E0 (client_id_id), INDEX IDX_5BBEC55A6C783232 (partner_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partners ADD CONSTRAINT FK_EFEB5164DC2902E0 FOREIGN KEY (client_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE permissions ADD CONSTRAINT FK_2DEDCC6F1BE7EDD8 FOREIGN KEY (install_id_id) REFERENCES structures (id)');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55ADC2902E0 FOREIGN KEY (client_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE structures ADD CONSTRAINT FK_5BBEC55A6C783232 FOREIGN KEY (partner_id_id) REFERENCES partners (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partners DROP FOREIGN KEY FK_EFEB5164DC2902E0');
        $this->addSql('ALTER TABLE permissions DROP FOREIGN KEY FK_2DEDCC6F1BE7EDD8');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55ADC2902E0');
        $this->addSql('ALTER TABLE structures DROP FOREIGN KEY FK_5BBEC55A6C783232');
        $this->addSql('DROP TABLE partners');
        $this->addSql('DROP TABLE permissions');
        $this->addSql('DROP TABLE structures');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
