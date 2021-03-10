<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210310200824 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE maison_images (id INT AUTO_INCREMENT NOT NULL, maison_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_14030889D67D8AF (maison_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE maison_images ADD CONSTRAINT FK_14030889D67D8AF FOREIGN KEY (maison_id) REFERENCES maison_hote (id)');
        $this->addSql('ALTER TABLE maison_hote DROP image, CHANGE localisation localisation VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(255) NOT NULL, CHANGE type type VARCHAR(255) NOT NULL, CHANGE nombre_chambres nombre_chambres INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE maison_images');
        $this->addSql('ALTER TABLE maison_hote ADD image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE localisation localisation VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type type VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre_chambres nombre_chambres INT DEFAULT NULL');
    }
}
