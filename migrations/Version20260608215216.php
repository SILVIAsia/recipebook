<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260608215216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity DROP public');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787089312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390A76ED395 FOREIGN KEY (user_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63906BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB63904EC001D1 FOREIGN KEY (season_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639081C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390DA6A219 FOREIGN KEY (place_id) REFERENCES place (id)');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3C89312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activity ADD public VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787089312FE9');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639012469DE2');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390A76ED395');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63906BF700BD');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB63904EC001D1');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639081C06096');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390DA6A219');
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3C89312FE9');
    }
}
