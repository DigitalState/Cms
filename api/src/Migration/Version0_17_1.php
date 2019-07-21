<?php

namespace App\Migration;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Class Version0_17_1
 */
final class Version0_17_1 extends AbstractMigration
{
    /**
     * Up migration
     *
     * @param \Doctrine\DBAL\Schema\Schema $schema
     */
    public function up(Schema $schema)
    {
        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('ALTER TABLE app_page_trans ADD presentation TEXT DEFAULT NULL');
                $this->addSql('ALTER TABLE app_page_trans ADD data JSON NOT NULL DEFAULT \'{}\'');
                $this->addSql('COMMENT ON COLUMN app_page_trans.data IS \'(DC2Type:json_array)\'');
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
        switch ($this->platform->getName()) {
            case 'postgresql':
                $this->addSql('ALTER TABLE app_page_trans DROP presentation');
                $this->addSql('ALTER TABLE app_page_trans DROP data');
                break;

            default:
                $this->abortIf(true,'Migration cannot be executed on "'.$this->platform->getName().'".');
                break;
        }
    }
}
