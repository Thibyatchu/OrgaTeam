<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105140555 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD evenements_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E63C02CD4 FOREIGN KEY (evenements_id) REFERENCES type_evenement (id)');
        $this->addSql('CREATE INDEX IDX_B26681E63C02CD4 ON evenement (evenements_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E63C02CD4');
        $this->addSql('DROP INDEX IDX_B26681E63C02CD4 ON evenement');
        $this->addSql('ALTER TABLE evenement DROP evenements_id');
    }
}
