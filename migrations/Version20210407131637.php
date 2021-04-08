<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210407131637 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locations_countries CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE code code VARCHAR(255) DEFAULT NULL, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE locations_countries_comments ADD CONSTRAINT FK_4DF67C2EB90B8547 FOREIGN KEY (locations_countries_id) REFERENCES locations_countries (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE locations_countries MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE locations_countries DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE locations_countries CHANGE id id INT NOT NULL, CHANGE code code VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_0900_ai_ci`');
        $this->addSql('ALTER TABLE locations_countries_comments DROP FOREIGN KEY FK_4DF67C2EB90B8547');
    }
}
