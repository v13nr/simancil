<?php 
class Buyer extends msDB {
  private $grid; 
  
  public function __construct(){
    $this->connect(); 
    $this->grid = new Grid; 
    $this->grid->setTable("$database.jurnal_header"); 
    $this->grid->addField(
                array(
                    'field' => 'id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )      
    ));
    $this->grid->addField(
            array(
                'field' => 'name',
                'name'  => 'name',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'No. Bukti','width' => 200,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));  
    $this->grid->addField(
            array(
                'field' => 'address',
                'name'  => 'address',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Tanggal','width' => 300,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));     

    $this->grid->addField(
            array(
                'field' => 'information',
                'name'  => 'information',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Keterangan','width' => 350,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));               
                    
  }
  
  public function getBuyer($request){
    return $this->grid->doRead($request); 
  }
  
  public function edit($id,$request){
     $this->grid->loadSingle = true;
     $this->grid->setManualFilter(" and id = $id"); 
     return $this->grid->doRead($request); 
  }

    
  public function getOrder($buyer_id,$request){
    $grid_order = new Grid; 
    $grid_order->setTable('$database.jurnal');
    $grid_order->setManualFilter(" and buyer_id = $buyer_id");
    $grid_order->addField(
                  array(
                    'field' => 'id',
                    'name' => 'id',
                    'primary' => true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )                      
                  )
                );
    $grid_order->addField(
                  array(
                    'field' => 'coa',
                    'name' => 'coa',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'COA', 'width' => 150, 'sortable' => true)
                    )
                  )
                );
    $grid_order->addField(
                  array(
                    'field' => 'keterangan',
                    'name' => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan', 'width' => 250, 'sortable' => true)
                    )
                  )
                );
    $grid_order->addField(
                  array(
                    'field' => 'debet',
                    'name' => 'debet',
                    'meta' => array(
                      'st' => array('type' => 'int'), 
                      'cm' => array('header' => 'Debet', 'width' => 100, 'sortable' => true, 'align' => 'right')
                    )                  
                  )
                ); 
    $grid_order->addField(
                  array(
                    'field' => 'kredit',
                    'name' => 'kredit',
                    'meta' => array(
                      'st' => array('type' => 'int'), 
                      'cm' => array('header' => 'Kredit', 'width' => 100, 'sortable' => true, 'align' => 'right')
                    )                  
                  )
                ); 

  return $grid_order->doRead($request);                 
                    
  }

  public function create($post){
   
    /** start build query **/
    $this->db->BeginTrans(); 
    /** parent query **/     
    $str ="INSERT INTO $database.jurnal_header (name,address,information) VALUES('%s','%s','%s')"; 
    $query= sprintf($str,mysql_real_escape_string($post['name']),
                         mysql_real_escape_string($post['address']), 
                         mysql_real_escape_string($post['information'])); 
                         
   $this->setSQL($query);   
    /** child query **/
   $ok = $this->executeSQL(); 
   if ($ok)
    if ($post['detail'] != '[]'){
      $sql = array(); 
      $buyer_id = $this->getLastID(); 
      $detail = json_decode(stripslashes($post['detail'])); 
      foreach ($detail as $row){
        $col = array(); 
        $val = array(); 
        $col[]= 'buyer_id'; 
        $val[]= $buyer_id; 
        foreach ($row as $head=>$value){
          $col[] =  $head; 
          $val[] = "'". mysql_real_escape_string($value) ."'";     
        }
        $sql[] = sprintf("INSERT INTO jurnal (%s) VALUES (%s)", implode(',',$col),implode(',',$val));
      }    
      
      foreach ($sql as $str){
        if ($ok){
          $this->setSQL($str);
          $ok = $this->executeSQL(); 
        }
      }
    }
    if ($ok)
      $this->db->CommitTrans(); 
    else
      $this->db->RollbackTrans(); 
    /** end build query **/

    $result = new stdClass(); 
    $result->success = ($ok)?true:false; 
    $result->message = $this->db->ErrorMsg(); 
    
    return json_encode($result); 
  }
  
  public function update($post){
   
    /** start build query **/
    $this->db->BeginTrans(); 
    /** parent query **/     
    $str ="UPDATE $database.jurnal_header SET name='%s', address='%s', information = '%s' WHERE id = %s"; 
    $query= sprintf($str,mysql_real_escape_string($post['name']),
                         mysql_real_escape_string($post['address']), 
                         mysql_real_escape_string($post['information']),
                         mysql_real_escape_string($post['id'])); 
                                               
   $this->setSQL($query);   
   $ok = $this->executeSQL();
   /** child query update **/ 
   if ($ok)
    if ($post['detail'] != '[]'){
      $sql = array(); 
      $detail = json_decode(stripslashes($post['detail'])); 
      foreach ($detail as $row){
        if (isset($row->id)){
            $fields = array();
            $id = 0; 
            foreach ($row as $head=>$value){
              if ($head != 'id'){
                $fields[] = $head . '='. "'".mysql_real_escape_string($value)."'";
              }else{
                $id = $value; 
              }
    
            }
           $query = "UPDATE $database.jurnal SET %s WHERE id=%s";
           $query = sprintf($query,implode(',',$fields),$id); 
           $sql[] = $query;           
        }else{
          $col = array(); 
          $val = array(); 
          $col[]= 'buyer_id'; 
          $val[]= $post['id']; 
          foreach ($row as $head=>$value){
            $col[] =  $head; 
            $val[] = "'". mysql_real_escape_string($value) ."'";     
          }
          $sql[] = sprintf("INSERT INTO $database.jurnal (%s) VALUES (%s)", implode(',',$col),implode(',',$val)); 
        }

      }    
      
      foreach ($sql as $str){
        if ($ok){
          $this->setSQL($str);
          $ok = $this->executeSQL(); 
        }
      }
    }
    
    if ($post['remove'])
      if ($ok){
        $sql = "DELETE FROM $database.jurnal WHERE id IN (%s)"; 
        $query = sprintf($sql,$post['remove']); 
        $this->setSQL($query);
        $ok = $this->executeSQL(); 
      }
      
    if ($ok)
      $this->db->CommitTrans(); 
    else
      $this->db->RollbackTrans(); 
    /** end build query **/

    $result = new stdClass(); 
    $result->success = ($ok)?true:false; 
    $result->message = $this->db->ErrorMsg(); 
    
    return json_encode($result); 
  }
  
  
  public function destroy($data){
    $this->db->BeginTrans();     
    $sql = "DELETE FROM $database.jurnal WHERE buyer_id in(%s)"; 
    $query = sprintf($sql,$data);    
    $this->setSQL($query);
    $ok = $this->executeSQL();
    if ($ok){
      $sql = "DELETE FROM $database.jurnal_header WHERE id in (%s)"; 
      $query = sprintf($sql,$data);
      $this->setSQL($query);
      $ok = $this->executeSQL();
    }
        
    if ($ok)
      $this->db->CommitTrans(); 
    else
      $this->db->RollbackTrans(); 
          
    $result = new stdClass(); 
    $result->success = ($this->db->ErrorMsg()!='')?false:true; 
    $result->message = $this->db->ErrorMsg(); 
    
    return json_encode($result); 
  }
}
?>
