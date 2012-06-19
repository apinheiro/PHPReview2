<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Geração dos dados para preencher a tabela de como conheceu a revista.
 */
class Version20120613212718 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->connection->insert('comoconheceu',array('ds_como_conheceu'=>'Pesquisa na Internet','in_ativo'=>1));
        $this->connection->insert('comoconheceu',array('ds_como_conheceu'=>'Twitter','in_ativo'=>1));
        $this->connection->insert('comoconheceu',array('ds_como_conheceu'=>'Facebook','in_ativo'=>1));
        $this->connection->insert('comoconheceu',array('ds_como_conheceu'=>'Amigos','in_ativo'=>1));
        $this->connection->insert('comoconheceu',array('ds_como_conheceu'=>'Eventos','in_ativo'=>1));
        $this->connection->insert('comoconheceu',array('ds_como_conheceu'=>'Banner em site','in_ativo'=>1));
        $this->connection->insert('comoconheceu',array('ds_como_conheceu'=>'Outros','in_ativo'=>1));
    }

    public function down(Schema $schema)
    {
        $this->connection->delete('comoconheceu',array());

    }
}
