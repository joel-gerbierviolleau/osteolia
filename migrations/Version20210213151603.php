<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210213151603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, created_on_behalf_of_id INT DEFAULT NULL, last_updated_by_id INT DEFAULT NULL, deleted_by_id INT DEFAULT NULL, gender VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birth_date DATE DEFAULT NULL, address_line1 VARCHAR(255) DEFAULT NULL, address_line2 VARCHAR(255) DEFAULT NULL, zipcode VARCHAR(5) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, phone_number VARCHAR(20) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, contact_comment LONGTEXT DEFAULT NULL, creation_date DATETIME NOT NULL, last_update_date DATETIME DEFAULT NULL, deletion_date DATETIME DEFAULT NULL, INDEX IDX_1ADAD7EBB03A8386 (created_by_id), INDEX IDX_1ADAD7EBABA141CA (created_on_behalf_of_id), INDEX IDX_1ADAD7EBE562D849 (last_updated_by_id), INDEX IDX_1ADAD7EBC76F1F52 (deleted_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBB03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBABA141CA FOREIGN KEY (created_on_behalf_of_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBE562D849 FOREIGN KEY (last_updated_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBC76F1F52 FOREIGN KEY (deleted_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prospect CHANGE phone_number phone_number VARCHAR(20) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE patient');
        $this->addSql('ALTER TABLE prospect CHANGE phone_number phone_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
