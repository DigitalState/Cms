<?php

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Migrations\Version;
use Ds\Component\Acl\Migration\Version0_15_0 as Acl;
use Ds\Component\Config\Migration\Version0_15_0 as Config;
use Ds\Component\Container\Attribute;
use Ds\Component\Database\Util\Objects;
use Ds\Component\Database\Util\Parameters;
use Ds\Component\Metadata\Migration\Version0_15_0 as Metadata;
use Ds\Component\Parameter\Migration\Version0_15_0 as Parameter;
use Ds\Component\Tenant\Migration\Version0_15_0 as Tenant;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Class Version0_15_0
 */
final class Version0_15_0 extends AbstractMigration implements ContainerAwareInterface
{
    use Attribute\Container;

    /**
     * @cont string
     */
    const DIRECTORY = '/srv/api/config/migrations';

    /**
     * @var \Ds\Component\Acl\Migration\Version0_15_0
     */
    private $acl;

    /**
     * @var \Ds\Component\Config\Migration\Version0_15_0
     */
    private $config;

    /**
     * @var \Ds\Component\Metadata\Migration\Version0_15_0
     */
    private $metadata;

    /**
     * @var \Ds\Component\Parameter\Migration\Version0_15_0
     */
    private $parameter;

    /**
     * @var \Ds\Component\Tenant\Migration\Version0_15_0
     */
    private $tenant;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Migrations\Version  $version
     */
    public function __construct(Version $version)
    {
        parent::__construct($version);
        $this->acl = new Acl($version);
        $this->config = new Config($version);
        $this->metadata = new Metadata($version);
        $this->parameter = new Parameter($version);
        $this->tenant = new Tenant($version);
    }

    /**
     * Up migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $parameters = Parameters::parseFile(static::DIRECTORY.'/parameters.yaml');
        $this->acl->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/acl.yaml', $parameters));
        $this->config->setContainer($this->container)->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/config.yaml', $parameters));
        $this->metadata->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/metadata.yaml', $parameters));
        $this->parameter->setContainer($this->container)->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/system/parameter.yaml', $parameters));
        $this->tenant->up($schema, Objects::parseFile(static::DIRECTORY.'/0_15_0/system/tenant.yaml', $parameters));

        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('CREATE SEQUENCE app_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_data_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_file_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_page_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_page_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_text_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE SEQUENCE app_text_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
                $this->addSql('CREATE TABLE app_data (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_A8DDD6C3D17F50A6 ON app_data (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_A8DDD6C3989D9B624E59C462 ON app_data (slug, tenant)');
                $this->addSql('CREATE TABLE app_data_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_6885795E2C2AC5D3 ON app_data_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_data_trans_unique_translation ON app_data_trans (translatable_id, locale)');
                $this->addSql('COMMENT ON COLUMN app_data_trans.data IS \'(DC2Type:json_array)\'');
                $this->addSql('CREATE TABLE app_file (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, "type" VARCHAR(255) DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_89B113B0D17F50A6 ON app_file (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_89B113B0989D9B624E59C462 ON app_file (slug, tenant)');
                $this->addSql('CREATE TABLE app_file_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, presentation TEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_8CB905F62C2AC5D3 ON app_file_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_file_trans_unique_translation ON app_file_trans (translatable_id, locale)');
                $this->addSql('CREATE TABLE app_page (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_11249380D17F50A6 ON app_page (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_11249380989D9B624E59C462 ON app_page (slug, tenant)');
                $this->addSql('CREATE TABLE app_page_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_40BB4A172C2AC5D3 ON app_page_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_page_trans_unique_translation ON app_page_trans (translatable_id, locale)');
                $this->addSql('CREATE TABLE app_text (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_3EA58267D17F50A6 ON app_text (uuid)');
                $this->addSql('CREATE UNIQUE INDEX UNIQ_3EA58267989D9B624E59C462 ON app_text (slug, tenant)');
                $this->addSql('CREATE TABLE app_text_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, value TEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
                $this->addSql('CREATE INDEX IDX_708E0F9C2C2AC5D3 ON app_text_trans (translatable_id)');
                $this->addSql('CREATE UNIQUE INDEX app_text_trans_unique_translation ON app_text_trans (translatable_id, locale)');
                $this->addSql('ALTER TABLE app_data_trans ADD CONSTRAINT FK_6885795E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_data (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_file_trans ADD CONSTRAINT FK_8CB905F62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_file (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_page_trans ADD CONSTRAINT FK_40BB4A172C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                $this->addSql('ALTER TABLE app_text_trans ADD CONSTRAINT FK_708E0F9C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_text (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }

    /**
     * Down migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->acl->down($schema);
        $this->config->setContainer($this->container)->down($schema);
        $this->metadata->down($schema);
        $this->parameter->setContainer($this->container)->down($schema);
        $this->tenant->down($schema);

        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('ALTER TABLE app_data_trans DROP CONSTRAINT FK_6885795E2C2AC5D3');
                $this->addSql('ALTER TABLE app_file_trans DROP CONSTRAINT FK_8CB905F62C2AC5D3');
                $this->addSql('ALTER TABLE app_page_trans DROP CONSTRAINT FK_40BB4A172C2AC5D3');
                $this->addSql('ALTER TABLE app_text_trans DROP CONSTRAINT FK_708E0F9C2C2AC5D3');
                $this->addSql('DROP SEQUENCE app_data_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_data_trans_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_file_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_file_trans_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_page_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_page_trans_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_text_id_seq CASCADE');
                $this->addSql('DROP SEQUENCE app_text_trans_id_seq CASCADE');
                $this->addSql('DROP TABLE app_data');
                $this->addSql('DROP TABLE app_data_trans');
                $this->addSql('DROP TABLE app_file');
                $this->addSql('DROP TABLE app_file_trans');
                $this->addSql('DROP TABLE app_page');
                $this->addSql('DROP TABLE app_page_trans');
                $this->addSql('DROP TABLE app_text');
                $this->addSql('DROP TABLE app_text_trans');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }
}
