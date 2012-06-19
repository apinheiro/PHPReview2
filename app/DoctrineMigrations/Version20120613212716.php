<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Populando a tabela de nível hierárquico
 */
class Version20120613212716 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->connection->insert('cargos',array('ds_cargo'=>'Presidente/Fundador','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Diretor','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Gerente','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Coordenador','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Analista','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Programador','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Estagiário','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Entusiasta','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Free-lancer','in_disponivel'=>1));
        $this->connection->insert('cargos',array('ds_cargo'=>'Outros','in_disponivel'=>1));
    }

    public function down(Schema $schema)
    {
        $this->connection->delete('cargos',array());

    }
}
