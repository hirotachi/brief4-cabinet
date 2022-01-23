<?php

class Doctor extends Base
{

    public function __construct(Database $db, $tableName)
    {
        parent::__construct($db, $tableName);
    }

}