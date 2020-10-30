<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201028220223 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patient (id VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, gender TINYINT(1) NOT NULL, age INT NOT NULL, city VARCHAR(255) NOT NULL, zip_code VARCHAR(255) NOT NULL, street VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, mobile VARCHAR(255) NOT NULL, antecedent JSON NOT NULL COMMENT \'(DC2Type:json_array)\', treatment JSON NOT NULL COMMENT \'(DC2Type:json_array)\', symptoms JSON NOT NULL COMMENT \'(DC2Type:json_array)\', symptoms_start_date DATE NOT NULL, emergency_visited TINYINT(1) NOT NULL, temperature DOUBLE PRECISION NOT NULL, breathing_frequency DOUBLE PRECISION NOT NULL, oxygen_saturation DOUBLE PRECISION NOT NULL, heart_beat DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE patient');
    }
}
