<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220607121111 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cappfpmp (id INT AUTO_INCREMENT NOT NULL, etudiant_id INT NOT NULL, tuteur_id INT DEFAULT NULL, numero INT NOT NULL, enseignant VARCHAR(255) DEFAULT NULL, datedebut DATE DEFAULT NULL, datefin DATE DEFAULT NULL, absences INT DEFAULT NULL, cachet VARCHAR(255) DEFAULT NULL, INDEX IDX_2E9D7637DDEAB1A3 (etudiant_id), INDEX IDX_2E9D763786EC68D8 (tuteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE eleve (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, enseignant_id INT DEFAULT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, promotion VARCHAR(5) NOT NULL, tuteur VARCHAR(255) DEFAULT NULL, specialite VARCHAR(20) DEFAULT NULL, classe VARCHAR(10) NOT NULL, formation VARCHAR(255) DEFAULT NULL, INDEX IDX_ECA105F7642B8210 (admin_id), INDEX IDX_ECA105F7E455FCC0 (enseignant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, siren VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) NOT NULL, logo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne (id INT AUTO_INCREMENT NOT NULL, competence_id INT DEFAULT NULL, cappfpmp_id INT DEFAULT NULL, pfmp_id INT DEFAULT NULL, INDEX IDX_57F0DB8315761DAB (competence_id), INDEX IDX_57F0DB83B0BE0782 (cappfpmp_id), INDEX IDX_57F0DB833C34EC50 (pfmp_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sousligne (id INT AUTO_INCREMENT NOT NULL, travail_id INT DEFAULT NULL, ligne_id INT DEFAULT NULL, note VARCHAR(255) DEFAULT NULL, INDEX IDX_84D8F5D4EEFE7EA9 (travail_id), INDEX IDX_84D8F5D45A438E76 (ligne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travail (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tuteur (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, signature VARCHAR(255) DEFAULT NULL, INDEX IDX_56412268A4AEAFEA (entreprise_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(200) NOT NULL, prenom VARCHAR(200) NOT NULL, is_verified TINYINT(1) NOT NULL, type VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cappfpmp ADD CONSTRAINT FK_2E9D7637DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES eleve (id)');
        $this->addSql('ALTER TABLE cappfpmp ADD CONSTRAINT FK_2E9D763786EC68D8 FOREIGN KEY (tuteur_id) REFERENCES tuteur (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7642B8210 FOREIGN KEY (admin_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE ligne ADD CONSTRAINT FK_57F0DB8315761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE ligne ADD CONSTRAINT FK_57F0DB83B0BE0782 FOREIGN KEY (cappfpmp_id) REFERENCES cappfpmp (id)');
        $this->addSql('ALTER TABLE ligne ADD CONSTRAINT FK_57F0DB833C34EC50 FOREIGN KEY (pfmp_id) REFERENCES cappfpmp (id)');
        $this->addSql('ALTER TABLE sousligne ADD CONSTRAINT FK_84D8F5D4EEFE7EA9 FOREIGN KEY (travail_id) REFERENCES travail (id)');
        $this->addSql('ALTER TABLE sousligne ADD CONSTRAINT FK_84D8F5D45A438E76 FOREIGN KEY (ligne_id) REFERENCES ligne (id)');
        $this->addSql('ALTER TABLE tuteur ADD CONSTRAINT FK_56412268A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ligne DROP FOREIGN KEY FK_57F0DB83B0BE0782');
        $this->addSql('ALTER TABLE ligne DROP FOREIGN KEY FK_57F0DB833C34EC50');
        $this->addSql('ALTER TABLE ligne DROP FOREIGN KEY FK_57F0DB8315761DAB');
        $this->addSql('ALTER TABLE cappfpmp DROP FOREIGN KEY FK_2E9D7637DDEAB1A3');
        $this->addSql('ALTER TABLE tuteur DROP FOREIGN KEY FK_56412268A4AEAFEA');
        $this->addSql('ALTER TABLE sousligne DROP FOREIGN KEY FK_84D8F5D45A438E76');
        $this->addSql('ALTER TABLE sousligne DROP FOREIGN KEY FK_84D8F5D4EEFE7EA9');
        $this->addSql('ALTER TABLE cappfpmp DROP FOREIGN KEY FK_2E9D763786EC68D8');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7642B8210');
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7E455FCC0');
        $this->addSql('DROP TABLE cappfpmp');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE eleve');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE ligne');
        $this->addSql('DROP TABLE sousligne');
        $this->addSql('DROP TABLE travail');
        $this->addSql('DROP TABLE tuteur');
        $this->addSql('DROP TABLE utilisateur');
    }
}
