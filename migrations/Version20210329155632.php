<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210329155632 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE maison_hote (id INT AUTO_INCREMENT NOT NULL, adresse VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, nombre_chambres INT NOT NULL, prix INT NOT NULL, lat INT NOT NULL, lng INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison_images (id INT AUTO_INCREMENT NOT NULL, maison_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_14030889D67D8AF (maison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, google_id VARCHAR(255) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, roles JSON DEFAULT NULL, cin INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE maison_images ADD CONSTRAINT FK_14030889D67D8AF FOREIGN KEY (maison_id) REFERENCES maison_hote (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maison_images DROP FOREIGN KEY FK_14030889D67D8AF');
        $this->addSql('DROP TABLE maison_hote');
        $this->addSql('DROP TABLE maison_images');
        $this->addSql('DROP TABLE `user`');
    }
}
