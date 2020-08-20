<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200820195636 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client_physique DROP FOREIGN KEY FK_B11F1822779CC064');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260779CC064');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260529BC2A3');
        $this->addSql('ALTER TABLE client_physique DROP FOREIGN KEY FK_B11F1822AD2D2831');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526046032730');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(50) NOT NULL, nom VARCHAR(30) NOT NULL, date_naissance VARCHAR(12) NOT NULL, lieu_naissance VARCHAR(100) NOT NULL, adresse VARCHAR(100) NOT NULL, telephone VARCHAR(15) NOT NULL, email VARCHAR(75) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(140) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE client_moral');
        $this->addSql('DROP TABLE client_physique');
        $this->addSql('DROP TABLE type_client');
        $this->addSql('DROP TABLE type_compte');
        $this->addSql('DROP TABLE type_frais');
        $this->addSql('DROP INDEX IDX_CFF6526046032730 ON compte');
        $this->addSql('DROP INDEX IDX_CFF65260529BC2A3 ON compte');
        $this->addSql('DROP INDEX IDX_CFF65260779CC064 ON compte');
        $this->addSql('ALTER TABLE compte ADD client_id INT DEFAULT NULL, ADD date_create VARCHAR(12) NOT NULL, DROP client_physique_id, DROP client_moral_id, DROP type_compte_id, DROP clerib, CHANGE numero numero VARCHAR(30) NOT NULL, CHANGE solde solde INT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_CFF6526019EB6921 ON compte (client_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF6526019EB6921');
        $this->addSql('CREATE TABLE client_moral (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, raison_social VARCHAR(75) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numero VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE client_physique (id INT AUTO_INCREMENT NOT NULL, type_client_id INT DEFAULT NULL, client_moral_id INT DEFAULT NULL, nom VARCHAR(70) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, salaire INT DEFAULT NULL, INDEX IDX_B11F1822AD2D2831 (type_client_id), INDEX IDX_B11F1822779CC064 (client_moral_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_client (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(70) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_compte (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_frais (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, montant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE client_physique ADD CONSTRAINT FK_B11F1822779CC064 FOREIGN KEY (client_moral_id) REFERENCES client_moral (id)');
        $this->addSql('ALTER TABLE client_physique ADD CONSTRAINT FK_B11F1822AD2D2831 FOREIGN KEY (type_client_id) REFERENCES type_client (id)');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_CFF6526019EB6921 ON compte');
        $this->addSql('ALTER TABLE compte ADD client_moral_id INT DEFAULT NULL, ADD type_compte_id INT NOT NULL, ADD clerib VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP date_create, CHANGE numero numero VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE solde solde INT NOT NULL, CHANGE client_id client_physique_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526046032730 FOREIGN KEY (type_compte_id) REFERENCES type_compte (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260529BC2A3 FOREIGN KEY (client_physique_id) REFERENCES client_physique (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260779CC064 FOREIGN KEY (client_moral_id) REFERENCES client_moral (id)');
        $this->addSql('CREATE INDEX IDX_CFF6526046032730 ON compte (type_compte_id)');
        $this->addSql('CREATE INDEX IDX_CFF65260529BC2A3 ON compte (client_physique_id)');
        $this->addSql('CREATE INDEX IDX_CFF65260779CC064 ON compte (client_moral_id)');
    }
}
