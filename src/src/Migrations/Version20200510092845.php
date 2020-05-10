<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200510092845 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE segment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE raw_class (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commodity (id INT AUTO_INCREMENT NOT NULL, segment_id_id INT NOT NULL, family_id_id INT NOT NULL, raw_class_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_5E8D2F746A411099 (segment_id_id), INDEX IDX_5E8D2F7443330D24 (family_id_id), INDEX IDX_5E8D2F7413A7B7A9 (raw_class_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commodity ADD CONSTRAINT FK_5E8D2F746A411099 FOREIGN KEY (segment_id_id) REFERENCES segment (id)');
        $this->addSql('ALTER TABLE commodity ADD CONSTRAINT FK_5E8D2F7443330D24 FOREIGN KEY (family_id_id) REFERENCES family (id)');
        $this->addSql('ALTER TABLE commodity ADD CONSTRAINT FK_5E8D2F7413A7B7A9 FOREIGN KEY (raw_class_id_id) REFERENCES raw_class (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commodity DROP FOREIGN KEY FK_5E8D2F746A411099');
        $this->addSql('ALTER TABLE commodity DROP FOREIGN KEY FK_5E8D2F7443330D24');
        $this->addSql('ALTER TABLE commodity DROP FOREIGN KEY FK_5E8D2F7413A7B7A9');
        $this->addSql('DROP TABLE segment');
        $this->addSql('DROP TABLE family');
        $this->addSql('DROP TABLE raw_class');
        $this->addSql('DROP TABLE commodity');
    }
}
