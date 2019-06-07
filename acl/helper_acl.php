<?php
//https://code.tutsplus.com/tutorials/a-better-login-system--net-3461
function getUserRoles()
{
    $strSQL = "SELECT * FROM `user_roles` WHERE `userID` = " . floatval($this->userID) . " ORDER BY `addDate` ASC";
    $data = mysql_query($strSQL);
    $resp = array();
    while($row = mysql_fetch_array($data))
    {
        $resp[] = $row['roleID'];
    }
    return $resp;
}
function getAllRoles($format='ids')
{
    $format = strtolower($format);
    $strSQL = "SELECT * FROM `roles` ORDER BY `roleName` ASC";
    $data = mysql_query($strSQL);
    $resp = array();
    while($row = mysql_fetch_array($data))
    {
        if ($format == 'full')
        {
            $resp[] = array("ID" => $row['ID'],"Name" => $row['roleName']);
        } else {
            $resp[] = $row['ID'];
        }
    }
    return $resp;
}
function buildACL()
{
    //first, get the rules for the user's role
    if (count($this->userRoles) > 0)
    {
        $this->perms = array_merge($this->perms,$this->getRolePerms($this->userRoles));
    }
    //then, get the individual user permissions
    $this->perms = array_merge($this->perms,$this->getUserPerms($this->userID));
}
function getPermKeyFromID($permID)
{
    $strSQL = "SELECT `permKey` FROM `permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
    $data = mysql_query($strSQL);
    $row = mysql_fetch_array($data);
    return $row[0];
}
function getPermNameFromID($permID)
{
    $strSQL = "SELECT `permName` FROM `permissions` WHERE `ID` = " . floatval($permID) . " LIMIT 1";
    $data = mysql_query($strSQL);
    $row = mysql_fetch_array($data);
    return $row[0];
}
function getRoleNameFromID($roleID)
{
    $strSQL = "SELECT `roleName` FROM `roles` WHERE `ID` = " . floatval($roleID) . " LIMIT 1";
    $data = mysql_query($strSQL);
    $row = mysql_fetch_array($data);
    return $row[0];
}
function getUsername($userID)
{
    $strSQL = "SELECT `username` FROM `users` WHERE `ID` = " . floatval($userID) . " LIMIT 1";
    $data = mysql_query($strSQL);
    $row = mysql_fetch_array($data);
    return $row[0];
}

function cekAkses($userID, $mnfront){
	include "../config_sistem.php";
    $strSQL = "SELECT A.user_id FROM jo_menu_detail A,  jo_menu B WHERE A.menu_id = B.id AND A.user_id = '".$userID
    ."' AND B.file = '" . $mnfront . "' LIMIT 1";
    //echo $strSQL;
    $data = mysql_query($strSQL) or die(mysql_error());
    $row = mysql_fetch_array($data);
    //return $row[0];
    if($_SESSION["sess_user_id"]=$row[0]){

    } else {
    	die("And tidak memiliki hak akses fitur ini. Terimakasih.");
    }
}
