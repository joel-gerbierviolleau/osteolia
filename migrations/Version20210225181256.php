<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210225181256 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD address_line1 VARCHAR(255) DEFAULT NULL, ADD address_line2 VARCHAR(255) DEFAULT NULL, ADD zipcode VARCHAR(5) DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL, ADD private_phone_number VARCHAR(20) DEFAULT NULL, ADD public_phone_number VARCHAR(20) DEFAULT NULL, ADD public_email VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP address_line1, DROP address_line2, DROP zipcode, DROP city, DROP private_phone_number, DROP public_phone_number, DROP public_email');
    }
}
