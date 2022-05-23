<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523212026 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(250) NOT NULL, siren VARCHAR(20) NOT NULL, cachet VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pfmp (id INT AUTO_INCREMENT NOT NULL, eleve_id INT NOT NULL, enseignant_id INT DEFAULT NULL, entreprise_id INT NOT NULL, numero VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, noter INT NOT NULL, INDEX IDX_8677ACC4A6CC7B2 (eleve_id), INDEX IDX_8677ACC4E455FCC0 (enseignant_id), INDEX IDX_8677ACC4A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteur (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, signature VARCHAR(255) NOT NULL, INDEX IDX_56412268A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pfmp ADD CONSTRAINT FK_8677ACC4A6CC7B2 FOREIGN KEY (eleve_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE pfmp ADD CONSTRAINT FK_8677ACC4E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE pfmp ADD CONSTRAINT FK_8677ACC4A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE tuteur ADD CONSTRAINT FK_56412268A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE eleve ADD enseignant_id INT NOT NULL, ADD formation_id INT NOT NULL, ADD tuteur VARCHAR(255) NOT NULL, ADD specialite VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F75200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7E455FCC0 ON eleve (enseignant_id)');
        $this->addSql('CREATE INDEX IDX_ECA105F75200282E ON eleve (formation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pfmp DROP FOREIGN KEY FK_8677ACC4A4AEAFEA');
        $this->addSql('ALTER TABLE tuteur DROP FOREIGN KEY FK_56412268A4AEAFEA');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F75200282E');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE pfmp');
        $this->addSql('DROP TABLE tuteur');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7E455FCC0');
        $this->addSql('DROP INDEX IDX_ECA105F7E455FCC0 ON eleve');
        $this->addSql('DROP INDEX IDX_ECA105F75200282E ON eleve');
        $this->addSql('ALTER TABLE eleve DROP enseignant_id, DROP formation_id, DROP tuteur, DROP specialite');
    }
}
