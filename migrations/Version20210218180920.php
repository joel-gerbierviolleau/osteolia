<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210218180920 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, created_by_id INT NOT NULL, last_updated_by_id INT DEFAULT NULL, deleted_by_id INT DEFAULT NULL, anamnesia LONGTEXT DEFAULT NULL, procedures LONGTEXT DEFAULT NULL, creation_date DATETIME NOT NULL, last_update_date DATETIME DEFAULT NULL, deletion_date DATETIME DEFAULT NULL, is_deleted TINYINT(1) DEFAULT NULL, INDEX IDX_964685A66B899279 (patient_id), INDEX IDX_964685A6B03A8386 (created_by_id), INDEX IDX_964685A6E562D849 (last_updated_by_id), INDEX IDX_964685A6C76F1F52 (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6E562D849 FOREIGN KEY (last_updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6C76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE consultation');
    }
}
