<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180409135145 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration (id INT AUTO_INCREMENT NOT NULL, color VARCHAR(255) NOT NULL, memory LONGTEXT DEFAULT NULL, serial VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration_product (configuration_id INT NOT NULL, product_id INT NOT NULL, INDEX IDX_5D02CC7373F32DD8 (configuration_id), INDEX IDX_5D02CC734584665A (product_id), PRIMARY KEY(configuration_id, product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, url VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, INDEX IDX_C53D045F4584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE manufacturer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, manufacturer_id INT DEFAULT NULL, client_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_create DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description LONGTEXT NOT NULL, size VARCHAR(255) NOT NULL, multimedia LONGTEXT DEFAULT NULL, networks LONGTEXT DEFAULT NULL, screen LONGTEXT DEFAULT NULL, autonomy LONGTEXT DEFAULT NULL, price NUMERIC(6, 2) NOT NULL, INDEX IDX_D34A04ADA23B42D (manufacturer_id), INDEX IDX_D34A04AD19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_configuration (product_id INT NOT NULL, configuration_id INT NOT NULL, INDEX IDX_7F0FB9254584665A (product_id), INDEX IDX_7F0FB92573F32DD8 (configuration_id), PRIMARY KEY(product_id, configuration_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, INDEX IDX_8D93D64919EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE configuration_product ADD CONSTRAINT FK_5D02CC7373F32DD8 FOREIGN KEY (configuration_id) REFERENCES configuration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE configuration_product ADD CONSTRAINT FK_5D02CC734584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADA23B42D FOREIGN KEY (manufacturer_id) REFERENCES manufacturer (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE product_configuration ADD CONSTRAINT FK_7F0FB9254584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_configuration ADD CONSTRAINT FK_7F0FB92573F32DD8 FOREIGN KEY (configuration_id) REFERENCES configuration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64919EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD19EB6921');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64919EB6921');
        $this->addSql('ALTER TABLE configuration_product DROP FOREIGN KEY FK_5D02CC7373F32DD8');
        $this->addSql('ALTER TABLE product_configuration DROP FOREIGN KEY FK_7F0FB92573F32DD8');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADA23B42D');
        $this->addSql('ALTER TABLE configuration_product DROP FOREIGN KEY FK_5D02CC734584665A');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4584665A');
        $this->addSql('ALTER TABLE product_configuration DROP FOREIGN KEY FK_7F0FB9254584665A');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE configuration_product');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE manufacturer');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_configuration');
        $this->addSql('DROP TABLE user');
    }
}
