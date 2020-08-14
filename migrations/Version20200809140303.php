<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200809140303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client_moral (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) NOT NULL, raison_social VARCHAR(75) NOT NULL, numero VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_physique (id INT AUTO_INCREMENT NOT NULL, type_client_id INT DEFAULT NULL, client_moral_id INT DEFAULT NULL, nom VARCHAR(70) NOT NULL, prenom VARCHAR(100) NOT NULL, salaire INT DEFAULT NULL, INDEX IDX_B11F1822AD2D2831 (type_client_id), INDEX IDX_B11F1822779CC064 (client_moral_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, client_physique_id INT DEFAULT NULL, client_moral_id INT DEFAULT NULL, type_compte_id INT NOT NULL, clerib VARCHAR(30) NOT NULL, numero VARCHAR(50) NOT NULL, solde INT NOT NULL, INDEX IDX_CFF65260529BC2A3 (client_physique_id), INDEX IDX_CFF65260779CC064 (client_moral_id), INDEX IDX_CFF6526046032730 (type_compte_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_client (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_compte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_frais (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, montant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client_physique ADD CONSTRAINT FK_B11F1822AD2D2831 FOREIGN KEY (type_client_id) REFERENCES type_client (id)');
        $this->addSql('ALTER TABLE client_physique ADD CONSTRAINT FK_B11F1822779CC064 FOREIGN KEY (client_moral_id) REFERENCES client_moral (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260529BC2A3 FOREIGN KEY (client_physique_id) REFERENCES client_physique (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260779CC064 FOREIGN KEY (client_moral_id) REFERENCES client_moral (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526046032730 FOREIGN KEY (type_compte_id) REFERENCES type_compte (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_physique DROP FOREIGN KEY FK_B11F1822779CC064');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260779CC064');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260529BC2A3');
        $this->addSql('ALTER TABLE client_physique DROP FOREIGN KEY FK_B11F1822AD2D2831');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526046032730');
        $this->addSql('DROP TABLE client_moral');
        $this->addSql('DROP TABLE client_physique');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE type_client');
        $this->addSql('DROP TABLE type_compte');
        $this->addSql('DROP TABLE type_frais');
    }
}
