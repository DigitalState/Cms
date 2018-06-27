<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Version1_0_0
 */
class Version1_0_0 extends AbstractMigration
{
    /**
     * Up
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Entity schema
        $this->addSql('CREATE SEQUENCE ds_config_id_seq INCREMENT BY 1 MINVALUE 1 START 9');
        $this->addSql('CREATE SEQUENCE ds_parameter_id_seq INCREMENT BY 1 MINVALUE 1 START 4');
        $this->addSql('CREATE SEQUENCE ds_access_id_seq INCREMENT BY 1 MINVALUE 1 START 3');
        $this->addSql('CREATE SEQUENCE ds_access_permission_id_seq INCREMENT BY 1 MINVALUE 1 START 7');
        $this->addSql('CREATE SEQUENCE ds_tenant_id_seq INCREMENT BY 1 MINVALUE 1 START 2');
        $this->addSql('CREATE SEQUENCE app_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_data_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_file_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_page_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_page_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_text_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_text_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ds_config (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, value JSON DEFAULT NULL, enabled BOOLEAN NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4D17F50A6 ON ds_config (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F48A90ABA94E59C462 ON ds_config (key, tenant)');
        $this->addSql('CREATE TABLE ds_parameter (id INT NOT NULL, "key" VARCHAR(255) NOT NULL, value JSON DEFAULT NULL, enabled BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B3C0FD91F48571EB ON ds_parameter ("key")');
        $this->addSql('CREATE TABLE ds_access (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, assignee VARCHAR(255) DEFAULT NULL, assignee_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A76F41DCD17F50A6 ON ds_access (uuid)');
        $this->addSql('CREATE TABLE ds_access_permission (id INT NOT NULL, access_id INT DEFAULT NULL, scope VARCHAR(255) DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, attributes JSON NOT NULL, tenant UUID NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D46DD4D04FEA67CF ON ds_access_permission (access_id)');
        $this->addSql('CREATE TABLE ds_tenant (id INT NOT NULL, uuid UUID NOT NULL, data JSON NOT NULL, version INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EF5FAEEAD17F50A6 ON ds_tenant (uuid)');
        $this->addSql('CREATE TABLE app_data (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, version INT DEFAULT 1 NOT NULL, tenant UUID NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A8DDD6C3D17F50A6 ON app_data (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A8DDD6C3989D9B624E59C462 ON app_data (slug, tenant)');
        $this->addSql('CREATE TABLE app_data_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6885795E2C2AC5D3 ON app_data_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_data_trans_unique_translation ON app_data_trans (translatable_id, locale)');
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
        $this->addSql('CREATE TABLE app_text_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_708E0F9C2C2AC5D3 ON app_text_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_text_trans_unique_translation ON app_text_trans (translatable_id, locale)');
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_data_trans ADD CONSTRAINT FK_6885795E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_data (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_file_trans ADD CONSTRAINT FK_8CB905F62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_file (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_page_trans ADD CONSTRAINT FK_40BB4A172C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_text_trans ADD CONSTRAINT FK_708E0F9C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_text (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        // Custom schema
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, data BYTEA NOT NULL, time INTEGER NOT NULL, lifetime INTEGER NOT NULL)');

        // Data
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
        $data = Yaml::parse($yml);

        $this->addSql('
            INSERT INTO 
                ds_parameter (id, key, value, enabled)
            VALUES 
                (1, \'ds_system.user.username\', \'"system"\', true),
                (2, \'ds_system.user.password\', \'"password"\', true),
                (3, \'ds_tenant.tenant.default\', \'"'.$data['tenant']['uuid'].'"\', true);
        ');

        $this->addSql('
            INSERT INTO 
                ds_tenant (id, uuid, data, created_at, updated_at)
            VALUES 
                (1, \''.$data['tenant']['uuid'].'\', \'{}\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_config (id, uuid, owner, owner_uuid, key, value, enabled, version, tenant, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.username\', \'"system@system.ds"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.password\', \'"'.$data['user']['system']['password'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.uuid\', \'"'.$data['user']['system']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.roles\', \'[]\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.roles\', \'[]\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.type\', \'"System"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (7, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity.uuid\', \'"'.$data['identity']['system']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (8, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.tenant\', \'"'.$data['tenant']['uuid'].'"\', true, 1, \''.$data['tenant']['uuid'].'\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access (id, uuid, owner, owner_uuid, assignee, assignee_uuid, version, tenant, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'System\', \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', 1, \''.$data['tenant']['uuid'].'\', now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access_permission (id, access_id, scope, entity, entity_uuid, key, attributes, tenant)
            VALUES 
                (1, 1, \'generic\', NULL, NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\', \''.$data['tenant']['uuid'].'\'),
                (2, 1, \'generic\', NULL, NULL, \'property\', \'["BROWSE","READ","EDIT"]\', \''.$data['tenant']['uuid'].'\'),
                (3, 1, \'generic\', NULL, NULL, \'generic\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\', \''.$data['tenant']['uuid'].'\'),
                (4, 2, \'generic\', NULL, NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\', \''.$data['tenant']['uuid'].'\'),
                (5, 2, \'generic\', NULL, NULL, \'property\', \'["BROWSE","READ","EDIT"]\', \''.$data['tenant']['uuid'].'\'),
                (6, 2, \'generic\', NULL, NULL, \'generic\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\', \''.$data['tenant']['uuid'].'\');
        ');
    }

    /**
     * Down
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        // Entity schema
        $this->addSql('ALTER TABLE ds_access_permission DROP CONSTRAINT FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_data_trans DROP CONSTRAINT FK_6885795E2C2AC5D3');
        $this->addSql('ALTER TABLE app_file_trans DROP CONSTRAINT FK_8CB905F62C2AC5D3');
        $this->addSql('ALTER TABLE app_page_trans DROP CONSTRAINT FK_40BB4A172C2AC5D3');
        $this->addSql('ALTER TABLE app_text_trans DROP CONSTRAINT FK_708E0F9C2C2AC5D3');
        $this->addSql('DROP SEQUENCE ds_config_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_parameter_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_permission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_tenant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_data_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_data_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_file_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_file_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_page_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_page_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_text_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_text_trans_id_seq CASCADE');
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_parameter');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE ds_tenant');
        $this->addSql('DROP TABLE app_data');
        $this->addSql('DROP TABLE app_data_trans');
        $this->addSql('DROP TABLE app_file');
        $this->addSql('DROP TABLE app_file_trans');
        $this->addSql('DROP TABLE app_page');
        $this->addSql('DROP TABLE app_page_trans');
        $this->addSql('DROP TABLE app_text');
        $this->addSql('DROP TABLE app_text_trans');

        // Custom schema
        $this->addSql('DROP TABLE ds_session');
    }
}
