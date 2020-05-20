<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520151539 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE casiers (id INT AUTO_INCREMENT NOT NULL, type INT DEFAULT NULL, nom VARCHAR(100) DEFAULT NULL, remarque VARCHAR(100) DEFAULT NULL, tag TINYINT(1) NOT NULL, Ordre INT DEFAULT NULL, INDEX FK_Type (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_casier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casiers ADD CONSTRAINT FK_86DF45568CDE5729 FOREIGN KEY (type) REFERENCES type_casier (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE casiers DROP FOREIGN KEY FK_86DF45568CDE5729');
        $this->addSql('DROP TABLE casiers');
        $this->addSql('DROP TABLE type_casier');
    }
}
