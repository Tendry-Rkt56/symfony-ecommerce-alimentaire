<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240516203326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE details (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_72260B8A82EA2E54 (commande_id), INDEX IDX_72260B8A1EBAF6CC (articles_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8A82EA2E54 FOREIGN KEY (commande_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8A1EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8A82EA2E54');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8A1EBAF6CC');
        $this->addSql('DROP TABLE details');
    }
}
