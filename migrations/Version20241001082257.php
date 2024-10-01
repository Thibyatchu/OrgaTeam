<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241001082257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club_evenement (club_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_A42FC8F861190A32 (club_id), INDEX IDX_A42FC8F8FD02F13 (evenement_id), PRIMARY KEY(club_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipe (id INT AUTO_INCREMENT NOT NULL, club_id INT DEFAULT NULL, evenement_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, niveau VARCHAR(255) NOT NULL, numero INT NOT NULL, effectif INT NOT NULL, INDEX IDX_2449BA1561190A32 (club_id), INDEX IDX_2449BA15FD02F13 (evenement_id), INDEX IDX_2449BA15BCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, type_evenement_id INT DEFAULT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, UNIQUE INDEX UNIQ_B26681E88939516 (type_evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_evenement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, pour_tous TINYINT(1) NOT NULL, date_even DATE NOT NULL, lieu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE club_evenement ADD CONSTRAINT FK_A42FC8F861190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE club_evenement ADD CONSTRAINT FK_A42FC8F8FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA1561190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE equipe ADD CONSTRAINT FK_2449BA15BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E88939516 FOREIGN KEY (type_evenement_id) REFERENCES type_evenement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club_evenement DROP FOREIGN KEY FK_A42FC8F861190A32');
        $this->addSql('ALTER TABLE club_evenement DROP FOREIGN KEY FK_A42FC8F8FD02F13');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA1561190A32');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15FD02F13');
        $this->addSql('ALTER TABLE equipe DROP FOREIGN KEY FK_2449BA15BCF5E72D');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E88939516');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE club_evenement');
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE type_evenement');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
