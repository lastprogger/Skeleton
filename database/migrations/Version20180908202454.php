<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20180908202454 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('create table pbx
                            (
                              id            serial    not null,
                              pbx_scheme_id integer   not null,
                              user_id       integer,
                              updated_at    timestamp,
                              deleted_at    timestamp,
                              created_at    timestamp not null
                            );'
        );

        $this->addSql('create unique index pbx_id_uindex on pbx (id);');

        $this->addSql('create table pbx_scheme
                (
                  id         serial not null,
                  user_id    integer,
                  created_at timestamp,
                  updated_at timestamp,
                  deleted_at timestamp
                );'
        );

        $this->addSql('create unique index pbx_scheme_id_uindex on pbx_scheme (id);');

        $this->addSql('create table pbx_scheme_nodes
                            (
                              id            serial    not null,
                              pbx_scheme_id integer   not null,
                              node_type_id  integer   not null,
                              data          json,
                              updated_at    timestamp,
                              deleted_at    timestamp,
                              created_at    timestamp not null
                            );'
        );

        $this->addSql('create unique index pbx_scheme_nodes_id_uindex on pbx_scheme_nodes (id);');

        $this->addSql('create table pbx_scheme_node_relations
                            (
                              id            serial       not null,
                              type          varchar(255) not null,
                              from_node_id  integer      not null,
                              to_node_id    integer,
                              pbx_scheme_id integer,
                              updated_at    timestamp,
                              deleted_at    timestamp,
                              created_at    timestamp    not null
                            );'
        );

        $this->addSql('create unique index pbx_scheme_node_relations_id_uindex on pbx_scheme_node_relations (id);');

        $this->addSql('create table node_types
                            (
                              id         serial not null,
                              name       varchar(255),
                              type       varchar(255),
                              created_at timestamp,
                              deleted_at timestamp,
                              deleted    boolean
                            );'
        );

        $this->addSql('create unique index node_types_id_uindex on node_types (id);');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('drop table pbx');
        $this->addSql('drop table pbx_scheme');
        $this->addSql('drop table pbx_scheme_nodes');
        $this->addSql('drop table pbx_scheme_node_relations');
        $this->addSql('drop table node_types');
    }
}
