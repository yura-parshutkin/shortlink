<?php

use Phinx\Migration\AbstractMigration;

class FirstMigration extends AbstractMigration
{
    public function change()
    {
        $this
            ->table('links')
            ->addColumn('short_id', 'string')
            ->addColumn('url', 'string')
            ->addIndex(['url'], ['unique' => true ])
            ->addIndex(['short_id'], ['unique' => true])
            ->save();
    }
}
