<?php

class Doctor extends Base
{

    public function __construct(Database $db, $tableName = "Doctor")
    {
        parent::__construct($db, $tableName);
    }

}