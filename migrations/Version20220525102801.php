<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220525102801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7E455FCC0');
        $this->addSql('DROP INDEX IDX_ECA105F7E455FCC0 ON eleve');
        $this->addSql('ALTER TABLE eleve CHANGE enseignant_id admin_id INT NOT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7642B8210 FOREIGN KEY (admin_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_ECA105F7642B8210 ON eleve (admin_id)');
        $this->addSql('ALTER TABLE utilisateur DROP type');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE eleve DROP FOREIGN KEY FK_ECA105F7642B8210');
        $this->addSql('DROP INDEX IDX_ECA105F7642B8210 ON eleve');
        $this->addSql('ALTER TABLE eleve CHANGE admin_id enseignant_id INT NOT NULL');
        $this->addSql('ALTER TABLE eleve ADD CONSTRAINT FK_ECA105F7E455FCC0 FOREIGN KEY (enseignant_id) REFERENCES utilisateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_ECA105F7E455FCC0 ON eleve (enseignant_id)');
        $this->addSql('ALTER TABLE utilisateur ADD type VARCHAR(1) NOT NULL');
    }
}
