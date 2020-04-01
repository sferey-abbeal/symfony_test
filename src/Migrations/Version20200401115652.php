<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200401115652 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D8892622A5522701');
        $this->addSql('DROP INDEX IDX_D8892622CB944F1A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__rating AS SELECT id, student_id, discipline_id, value FROM rating');
        $this->addSql('DROP TABLE rating');
        $this->addSql('CREATE TABLE rating (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER DEFAULT NULL, discipline_id INTEGER DEFAULT NULL, value INTEGER NOT NULL, CONSTRAINT FK_D8892622CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_D8892622A5522701 FOREIGN KEY (discipline_id) REFERENCES discipline (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO rating (id, student_id, discipline_id, value) SELECT id, student_id, discipline_id, value FROM __temp__rating');
        $this->addSql('DROP TABLE __temp__rating');
        $this->addSql('CREATE INDEX IDX_D8892622A5522701 ON rating (discipline_id)');
        $this->addSql('CREATE INDEX IDX_D8892622CB944F1A ON rating (student_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, first_name, last_name, birthdate FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL COLLATE BINARY, last_name VARCHAR(255) NOT NULL COLLATE BINARY, birth_date DATE NOT NULL)');
        $this->addSql('INSERT INTO student (id, first_name, last_name, birth_date) SELECT id, first_name, last_name, birthdate FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_D8892622CB944F1A');
        $this->addSql('DROP INDEX IDX_D8892622A5522701');
        $this->addSql('CREATE TEMPORARY TABLE __temp__rating AS SELECT id, student_id, discipline_id, value FROM rating');
        $this->addSql('DROP TABLE rating');
        $this->addSql('CREATE TABLE rating (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, student_id INTEGER DEFAULT NULL, discipline_id INTEGER DEFAULT NULL, value INTEGER NOT NULL)');
        $this->addSql('INSERT INTO rating (id, student_id, discipline_id, value) SELECT id, student_id, discipline_id, value FROM __temp__rating');
        $this->addSql('DROP TABLE __temp__rating');
        $this->addSql('CREATE INDEX IDX_D8892622CB944F1A ON rating (student_id)');
        $this->addSql('CREATE INDEX IDX_D8892622A5522701 ON rating (discipline_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__student AS SELECT id, first_name, last_name, birth_date FROM student');
        $this->addSql('DROP TABLE student');
        $this->addSql('CREATE TABLE student (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birthdate DATE NOT NULL)');
        $this->addSql('INSERT INTO student (id, first_name, last_name, birthdate) SELECT id, first_name, last_name, birth_date FROM __temp__student');
        $this->addSql('DROP TABLE __temp__student');
    }
}
