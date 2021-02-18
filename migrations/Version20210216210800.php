<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210216210800 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medical_history (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, created_by_id INT NOT NULL, last_updated_by_id INT DEFAULT NULL, has_surgery_history TINYINT(1) NOT NULL, has_trauma_history TINYINT(1) NOT NULL, has_medical_treatment_history TINYINT(1) NOT NULL, has_familial_history TINYINT(1) NOT NULL, surgery_history_details LONGTEXT DEFAULT NULL, trauma_history_details LONGTEXT DEFAULT NULL, medical_treatment_history_details LONGTEXT DEFAULT NULL, familial_history_details LONGTEXT DEFAULT NULL, regular_physician VARCHAR(255) DEFAULT NULL, creation_date DATETIME NOT NULL, last_update_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_61B890856B899279 (patient_id), INDEX IDX_61B89085B03A8386 (created_by_id), INDEX IDX_61B89085E562D849 (last_updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medical_history ADD CONSTRAINT FK_61B890856B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE medical_history ADD CONSTRAINT FK_61B89085B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE medical_history ADD CONSTRAINT FK_61B89085E562D849 FOREIGN KEY (last_updated_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE medical_history');
    }
}
