<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260608092022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette ADD season_id INT DEFAULT NULL, ADD activity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390A76ED395 FOREIGN KEY (user_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63906BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63904EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639081C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('CREATE INDEX IDX_49BB63904EC001D1 ON recette (season_id)');
        $this->addSql('CREATE INDEX IDX_49BB639081C06096 ON recette (activity_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639012469DE2');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390A76ED395');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63906BF700BD');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63904EC001D1');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639081C06096');
        $this->addSql('DROP INDEX IDX_49BB63904EC001D1 ON recette');
        $this->addSql('DROP INDEX IDX_49BB639081C06096 ON recette');
        $this->addSql('ALTER TABLE recette DROP season_id, DROP activity_id');
    }
}
