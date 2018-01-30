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

        // Schema
        $this->addSql('CREATE SEQUENCE ds_config_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ds_access_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ds_access_permission_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_data_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_data_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_file_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_file_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_page_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_page_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_text_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE app_text_trans_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ds_config (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, "value" TEXT DEFAULT NULL, enabled BOOLEAN NOT NULL, version INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4D17F50A6 ON ds_config (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_758C45F4F48571EB ON ds_config ("key")');
        $this->addSql('CREATE TABLE ds_access (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, identity VARCHAR(255) DEFAULT NULL, identity_uuid UUID DEFAULT NULL, version INT DEFAULT 1 NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A76F41DCD17F50A6 ON ds_access (uuid)');
        $this->addSql('CREATE TABLE ds_access_permission (id INT NOT NULL, access_id INT DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, entity_uuid UUID DEFAULT NULL, "key" VARCHAR(255) NOT NULL, attributes JSON NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D46DD4D04FEA67CF ON ds_access_permission (access_id)');
        $this->addSql('CREATE TABLE ds_session (id VARCHAR(128) NOT NULL PRIMARY KEY, data BYTEA NOT NULL, time INTEGER NOT NULL, lifetime INTEGER NOT NULL)');
        $this->addSql('CREATE TABLE app_data (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A8DDD6C3D17F50A6 ON app_data (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A8DDD6C3989D9B62 ON app_data (slug)');
        $this->addSql('CREATE TABLE app_data_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, data JSON NOT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6885795E2C2AC5D3 ON app_data_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_data_trans_unique_translation ON app_data_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_file (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, "type" VARCHAR(255) DEFAULT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_89B113B0D17F50A6 ON app_file (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_89B113B0989D9B62 ON app_file (slug)');
        $this->addSql('CREATE TABLE app_file_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, presentation TEXT DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8CB905F62C2AC5D3 ON app_file_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_file_trans_unique_translation ON app_file_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_page (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11249380D17F50A6 ON app_page (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11249380989D9B62 ON app_page (slug)');
        $this->addSql('CREATE TABLE app_page_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_40BB4A172C2AC5D3 ON app_page_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_page_trans_unique_translation ON app_page_trans (translatable_id, locale)');
        $this->addSql('CREATE TABLE app_text (id INT NOT NULL, uuid UUID NOT NULL, "owner" VARCHAR(255) DEFAULT NULL, owner_uuid UUID DEFAULT NULL, slug VARCHAR(255) NOT NULL, version INT DEFAULT 1 NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3EA58267D17F50A6 ON app_text (uuid)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3EA58267989D9B62 ON app_text (slug)');
        $this->addSql('CREATE TABLE app_text_trans (id INT NOT NULL, translatable_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, value VARCHAR(255) DEFAULT NULL, locale VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_708E0F9C2C2AC5D3 ON app_text_trans (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX app_text_trans_unique_translation ON app_text_trans (translatable_id, locale)');
        $this->addSql('ALTER TABLE ds_access_permission ADD CONSTRAINT FK_D46DD4D04FEA67CF FOREIGN KEY (access_id) REFERENCES ds_access (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_data_trans ADD CONSTRAINT FK_6885795E2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_data (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_file_trans ADD CONSTRAINT FK_8CB905F62C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_file (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_page_trans ADD CONSTRAINT FK_40BB4A172C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_page (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE app_text_trans ADD CONSTRAINT FK_708E0F9C2C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES app_text (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');

        // Data
        $yml = file_get_contents('/srv/api-platform/src/AppBundle/Resources/migrations/1_0_0.yml');
        $data = Yaml::parse($yml);

        $this->addSql('
            INSERT INTO 
                ds_config (id, uuid, owner, owner_uuid, key, value, enabled, version, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.username\', \'system@ds\', true, 1, now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.uuid\', \''.$data['user']['system']['uuid'].'\', true, 1, now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.roles\', \'ROLE_SYSTEM\', true, 1, now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity\', \'System\', true, 1, now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.user.identity_uuid\', \''.$data['identity']['system']['uuid'].'\', true, 1, now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.assets.host\', \''.$data['config']['ds_api.api.assets.host']['value'].'\', true, 1, now(), now()),
                (7, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.authentication.host\', \''.$data['config']['ds_api.api.authentication.host']['value'].'\', true, 1, now(), now()),
                (8, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.camunda.host\', \''.$data['config']['ds_api.api.camunda.host']['value'].'\', true, 1, now(), now()),
                (9, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.cases.host\', \''.$data['config']['ds_api.api.cases.host']['value'].'\', true, 1, now(), now()),
                (10, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.cms.host\', \''.$data['config']['ds_api.api.cms.host']['value'].'\', true, 1, now(), now()),
                (11, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.formio.host\', \''.$data['config']['ds_api.api.formio.host']['value'].'\', true, 1, now(), now()),
                (12, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.identities.host\', \''.$data['config']['ds_api.api.identities.host']['value'].'\', true, 1, now(), now()),
                (13, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.records.host\', \''.$data['config']['ds_api.api.records.host']['value'].'\', true, 1, now(), now()),
                (14, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.services.host\', \''.$data['config']['ds_api.api.services.host']['value'].'\', true, 1, now(), now()),
                (15, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'ds_api.api.tasks.host\', \''.$data['config']['ds_api.api.tasks.host']['value'].'\', true, 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access (id, uuid, owner, owner_uuid, identity, identity_uuid, version, created_at, updated_at)
            VALUES 
                (1, \''.Uuid::uuid4()->toString().'\', \'System\', \''.$data['identity']['system']['uuid'].'\', \'System\', \''.$data['identity']['system']['uuid'].'\', 1, now(), now()),
                (2, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Anonymous\', NULL, 1, now(), now()),
                (3, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Individual\', NULL, 1, now(), now()),
                (4, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Organization\', NULL, 1, now(), now()),
                (5, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', NULL, 1, now(), now()),
                (6, \''.Uuid::uuid4()->toString().'\', \'BusinessUnit\', \''.$data['business_unit']['administration']['uuid'].'\', \'Staff\', \''.$data['identity']['admin']['uuid'].'\', 1, now(), now());
        ');

        $this->addSql('
            INSERT INTO 
                ds_access_permission (id, access_id, entity, entity_uuid, key, attributes)
            VALUES 
                (1, 1, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (2, 1, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (3, 1, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\'),
                (4, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data\', \'["BROWSE","READ"]\'),
                (5, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_uuid\', \'["BROWSE","READ"]\'),
                (6, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_slug\', \'["BROWSE","READ"]\'),
                (7, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_title\', \'["BROWSE","READ"]\'),
                (8, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_data\', \'["BROWSE","READ"]\'),
                (9, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file\', \'["BROWSE","READ"]\'),
                (10, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_uuid\', \'["BROWSE","READ"]\'),
                (11, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_slug\', \'["BROWSE","READ"]\'),
                (12, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_title\', \'["BROWSE","READ"]\'),
                (13, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_description\', \'["BROWSE","READ"]\'),
                (14, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_presentation\', \'["BROWSE","READ"]\'),
                (15, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_type\', \'["BROWSE","READ"]\'),
                (16, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text\', \'["BROWSE","READ"]\'),
                (17, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_uuid\', \'["BROWSE","READ"]\'),
                (18, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_slug\', \'["BROWSE","READ"]\'),
                (19, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_title\', \'["BROWSE","READ"]\'),
                (20, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_value\', \'["BROWSE","READ"]\'),
                (21, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page\', \'["BROWSE","READ"]\'),
                (22, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_uuid\', \'["BROWSE","READ"]\'),
                (23, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_slug\', \'["BROWSE","READ"]\'),
                (24, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_title\', \'["BROWSE","READ"]\'),
                (25, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_description\', \'["BROWSE","READ"]\'),
                (26, 2, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'content\', \'["BROWSE","READ"]\'),
                (27, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data\', \'["BROWSE","READ"]\'),
                (28, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_uuid\', \'["BROWSE","READ"]\'),
                (29, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_slug\', \'["BROWSE","READ"]\'),
                (30, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_title\', \'["BROWSE","READ"]\'),
                (31, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_data\', \'["BROWSE","READ"]\'),
                (32, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file\', \'["BROWSE","READ"]\'),
                (33, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_uuid\', \'["BROWSE","READ"]\'),
                (34, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_slug\', \'["BROWSE","READ"]\'),
                (35, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_title\', \'["BROWSE","READ"]\'),
                (36, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_description\', \'["BROWSE","READ"]\'),
                (37, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_presentation\', \'["BROWSE","READ"]\'),
                (38, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_type\', \'["BROWSE","READ"]\'),
                (39, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text\', \'["BROWSE","READ"]\'),
                (40, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_uuid\', \'["BROWSE","READ"]\'),
                (41, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_slug\', \'["BROWSE","READ"]\'),
                (42, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_title\', \'["BROWSE","READ"]\'),
                (43, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_value\', \'["BROWSE","READ"]\'),
                (44, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page\', \'["BROWSE","READ"]\'),
                (45, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_uuid\', \'["BROWSE","READ"]\'),
                (46, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_slug\', \'["BROWSE","READ"]\'),
                (47, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_title\', \'["BROWSE","READ"]\'),
                (48, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_description\', \'["BROWSE","READ"]\'),
                (49, 3, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'content\', \'["BROWSE","READ"]\'),
                (50, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data\', \'["BROWSE","READ"]\'),
                (51, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_uuid\', \'["BROWSE","READ"]\'),
                (52, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_slug\', \'["BROWSE","READ"]\'),
                (53, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_title\', \'["BROWSE","READ"]\'),
                (54, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_data\', \'["BROWSE","READ"]\'),
                (55, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file\', \'["BROWSE","READ"]\'),
                (56, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_uuid\', \'["BROWSE","READ"]\'),
                (57, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_slug\', \'["BROWSE","READ"]\'),
                (58, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_title\', \'["BROWSE","READ"]\'),
                (59, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_description\', \'["BROWSE","READ"]\'),
                (60, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_presentation\', \'["BROWSE","READ"]\'),
                (61, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_type\', \'["BROWSE","READ"]\'),
                (62, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text\', \'["BROWSE","READ"]\'),
                (63, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_uuid\', \'["BROWSE","READ"]\'),
                (64, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_slug\', \'["BROWSE","READ"]\'),
                (65, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_title\', \'["BROWSE","READ"]\'),
                (66, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_value\', \'["BROWSE","READ"]\'),
                (67, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page\', \'["BROWSE","READ"]\'),
                (68, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_uuid\', \'["BROWSE","READ"]\'),
                (69, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_slug\', \'["BROWSE","READ"]\'),
                (70, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_title\', \'["BROWSE","READ"]\'),
                (71, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_description\', \'["BROWSE","READ"]\'),
                (72, 4, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'content\', \'["BROWSE","READ"]\'),
                (73, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data\', \'["BROWSE","READ"]\'),
                (74, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'data_property\', \'["BROWSE","READ"]\'),
                (75, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file\', \'["BROWSE","READ"]\'),
                (76, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'file_property\', \'["BROWSE","READ"]\'),
                (77, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text\', \'["BROWSE","READ"]\'),
                (78, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'text_property\', \'["BROWSE","READ"]\'),
                (79, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page\', \'["BROWSE","READ"]\'),
                (80, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'page_property\', \'["BROWSE","READ"]\'),
                (81, 5, \'BusinessUnit\', \''.$data['business_unit']['portal']['uuid'].'\', \'content\', \'["BROWSE","READ"]\'),
                (82, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'data\', \'["BROWSE","READ"]\'),
                (83, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'data_property\', \'["BROWSE","READ"]\'),
                (84, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'file\', \'["BROWSE","READ"]\'),
                (85, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'file_property\', \'["BROWSE","READ"]\'),
                (86, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'text\', \'["BROWSE","READ"]\'),
                (87, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'text_property\', \'["BROWSE","READ"]\'),
                (88, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'page\', \'["BROWSE","READ"]\'),
                (89, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'page_property\', \'["BROWSE","READ"]\'),
                (90, 5, \'BusinessUnit\', \''.$data['business_unit']['backoffice']['uuid'].'\', \'content\', \'["BROWSE","READ"]\'),
                (91, 6, \'BusinessUnit\', NULL, \'entity\', \'["BROWSE","READ","EDIT","ADD","DELETE"]\'),
                (92, 6, \'BusinessUnit\', NULL, \'property\', \'["BROWSE","READ","EDIT"]\'),
                (93, 6, \'BusinessUnit\', NULL, \'custom\', \'["BROWSE","READ","EDIT","ADD","DELETE","EXECUTE"]\');
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

        // Schema
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE ds_access_permission DROP CONSTRAINT FK_D46DD4D04FEA67CF');
        $this->addSql('ALTER TABLE app_data_trans DROP CONSTRAINT FK_6885795E2C2AC5D3');
        $this->addSql('ALTER TABLE app_file_trans DROP CONSTRAINT FK_8CB905F62C2AC5D3');
        $this->addSql('ALTER TABLE app_page_trans DROP CONSTRAINT FK_40BB4A172C2AC5D3');
        $this->addSql('ALTER TABLE app_text_trans DROP CONSTRAINT FK_708E0F9C2C2AC5D3');
        $this->addSql('DROP SEQUENCE ds_config_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ds_access_permission_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_data_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_data_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_file_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_file_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_page_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_page_trans_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_text_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE app_text_trans_id_seq CASCADE');
        $this->addSql('DROP TABLE ds_config');
        $this->addSql('DROP TABLE ds_access');
        $this->addSql('DROP TABLE ds_access_permission');
        $this->addSql('DROP TABLE ds_session');
        $this->addSql('DROP TABLE app_data');
        $this->addSql('DROP TABLE app_data_trans');
        $this->addSql('DROP TABLE app_file');
        $this->addSql('DROP TABLE app_file_trans');
        $this->addSql('DROP TABLE app_page');
        $this->addSql('DROP TABLE app_page_trans');
        $this->addSql('DROP TABLE app_text');
        $this->addSql('DROP TABLE app_text_trans');
    }
}
