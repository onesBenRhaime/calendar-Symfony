<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240331212705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C2FF709B6 FOREIGN KEY (id_module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE membre_projet DROP FOREIGN KEY membre_projet_ibfk_1');
        $this->addSql('ALTER TABLE membre_tache DROP FOREIGN KEY membre_tache_ibfk_1');
        $this->addSql('DROP TABLE membre_projet');
        $this->addSql('DROP TABLE membre_tache');
        $this->addSql('ALTER TABLE projet MODIFY id_projet INT NOT NULL');
        $this->addSql('DROP INDEX `primary` ON projet');
        $this->addSql('ALTER TABLE projet DROP progression, DROP priorite, DROP proprietaire, CHANGE nom nom VARCHAR(30) NOT NULL, CHANGE id_projet id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY tache_ibfk_1');
        $this->addSql('DROP INDEX id_projet ON tache');
        $this->addSql('ALTER TABLE tache DROP priorite, DROP statut, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE assigne assigne VARCHAR(255) NOT NULL, CHANGE id_projet projet_id INT NOT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('CREATE INDEX IDX_93872075C18272 ON tache (projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE membre_projet (id_projet INT NOT NULL, id_membreP INT AUTO_INCREMENT NOT NULL, nom_p VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom_p VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX id_projet (id_projet), PRIMARY KEY(id_membreP)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE membre_tache (id_tache INT NOT NULL, id_membreT INT AUTO_INCREMENT NOT NULL, nom_t VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom_t VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, INDEX id_tache (id_tache), PRIMARY KEY(id_membreT)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE membre_projet ADD CONSTRAINT membre_projet_ibfk_1 FOREIGN KEY (id_projet) REFERENCES projet (id_projet) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE membre_tache ADD CONSTRAINT membre_tache_ibfk_1 FOREIGN KEY (id_tache) REFERENCES tache (id_tache) ON UPDATE CASCADE ON DELETE CASCADE');
        
             
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE projet MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON projet');
        $this->addSql('ALTER TABLE projet ADD progression VARCHAR(50) NOT NULL, ADD priorite VARCHAR(50) NOT NULL, ADD proprietaire VARCHAR(50) NOT NULL, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE id id_projet INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE projet ADD PRIMARY KEY (id_projet)');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075C18272');
        $this->addSql('DROP INDEX IDX_93872075C18272 ON tache');
        $this->addSql('ALTER TABLE tache ADD priorite VARCHAR(50) NOT NULL, ADD statut VARCHAR(50) NOT NULL, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE assigne assigne VARCHAR(50) NOT NULL, CHANGE projet_id id_projet INT NOT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT tache_ibfk_1 FOREIGN KEY (id_projet) REFERENCES projet (id_projet)');
        $this->addSql('CREATE INDEX id_projet ON tache (id_projet)');
    }
}
