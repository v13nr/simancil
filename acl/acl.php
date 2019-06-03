<?php
class ACL
{
    var $perms = array();        //Array : Stores the permissions for the user
    var $userID = 0;            //Integer : Stores the ID of the current user
    var $userRoles = array();    //Array : Stores the roles of the current user
     
    function __constructor($userID = '')
    {
        if ($userID != '')
        {
            $this->userID = floatval($userID);
        } else {
            $this->userID = floatval($_SESSION['userID']);
        }
        $this->userRoles = $this->getUserRoles('ids');
        $this->buildACL();
    }
    function ACL($userID='')
    {
        $this->__constructor($userID);
    }