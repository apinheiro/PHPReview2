<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Usuário Administrador
 * 
 * Esta migration serve para criar o usuário administrador do sistema.
 * 
 * Senha Original do Administrador: PHPReview123
 */
class Version20120613212712 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->connection->insert('usuario',array('nm_usuario'=>'Administrador','ds_email'=>'administrador@phpreview.net','sexo'=>'M','ds_senha'=>'35dsq+UKFKLLGcjduxBqD1xVY268=','ds_salt'=>'MjAxMjA3MDIwNjMzMDU=','dt_criacao'=>date(\Datetime::ATOM),'dt_atualizacao'=>date(\Datetime::ATOM),'ds_role'=>'ROLE_SUPER_ADMIN'));

    }

    public function down(Schema $schema)
    {
        $this->connection->delete('usuario', array('ds_email'=>'administrador@phpreview.net'));

    }
}
