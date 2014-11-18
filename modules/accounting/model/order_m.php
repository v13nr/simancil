<?php
class Buyer extends msDB {
  private $grid; 
  
  public function __construct(){
    $this->connect(); 
    $this->grid = new Grid; 
    $this->grid->setTable("kendali_v_order"); 
	$this->grid->setJoin("
	LEFT JOIN kendali_akun ON kendali_v_order.rekanan_id = kendali_akun.id
	LEFT JOIN kendali_instalasi ON kendali_v_order.address = kendali_instalasi.idinstalasi
	LEFT JOIN kendali_jenis ON kendali_v_order.jenis = kendali_jenis.id
	");
	$this->grid->setManualFilter(" and tipe = 'Farmasi'"); 
    $this->grid->addField(
                array(
                    'field' => 'kendali_v_order.id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false)
                    )      
    ));
	$this->grid->addField(
			array(
				'field' => 'rekanan_id',
				'name'  => 'rekanan_id',
				'meta' => array(
				  'st' => array('type' => 'float'), 
				  'cm' => array('hidden' => true, 'hideable' => false)
				  )
			));
			
    $this->grid->addField(
            array(
                'field' => 'kendali_v_order.nomor',
                'name'  => 'nomor',
                'meta' => array(
                  'st' => array('type' => 'float'), 
                  'cm' => array('header' => 'Nomor Kendali','width' => 80,'sortable' => true),
                  'filter' => array('type' => 'numeric')
                )
            ));
    $this->grid->addField(
            array(
                'field' => 'kendali_akun.title',
                'name'  => 'title',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Nama Akun','width' => 200,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $this->grid->addField(
            array(
                'field' => 'tanggal',
                'name'  => 'tanggal',
                'meta' => array(
                  'st' => array('type' => 'date'), 
                  'cm' => array('header' => 'Tanggal','width' => 100,'sortable' => true,
				  'renderer' => "Ext.util.Format.date(val,'d/m/Y')"),
                  'filter' => array('type' => 'date')
                )
            ));   
    $this->grid->addField(
            array(
                'field' => 'kendali_instalasi.nama_instalasi',
                'name'  => 'nama_instalasi',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Instalasi','width' => 200,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));     
	$this->grid->addField(
            array(
                'field' => 'kendali_instalasi.idinstalasi',
                'name'  => 'address',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('hidden' => true, 'hideable' => false)
                )
            ));  
    $this->grid->addField(
            array(
                'field' => 'kendali_jenis.jenis',
                'name'  => 'nama_jenis',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Jenis','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));     
	$this->grid->addField(
            array(
                'field' => 'kendali_jenis.id',
                'name'  => 'jenis',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('hidden' => true, 'hideable' => false)
                )
            )); 
	$this->grid->addField(
            array(
                'field' => 'FORMAT(jumlah,0)',
                'name'  => 'jumlah',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Jumlah','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
	$this->grid->addField(
            array(
                'field' => 'FORMAT(pembayaran,0)',
                'name'  => 'pembayaran',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Bendahara','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
	$this->grid->addField(
            array(
                'field' => 'lunas',
                'name'  => 'lunas',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Status','width' => 100,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));
    $this->grid->addField(
            array(
                'field' => 'information',
                'name'  => 'information',
                'meta' => array(
                  'st' => array('type' => 'string'), 
                  'cm' => array('header' => 'Information','width' => 350,'sortable' => true),
                  'filter' => array('type' => 'string')
                )
            ));               
                    
  }
  
  public function getBuyer($request){
    return $this->grid->doRead($request); 
  }
  
  public function edit($id,$request){
     $this->grid->loadSingle = true;
     $this->grid->setManualFilter(" and kendali_v_order.id = $id"); 
     return $this->grid->doRead($request); 
  }

    
  public function getOrder($buyer_id,$request){
    $grid_order = new Grid; 
    $grid_order->setTable('kendali_orders');
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
                    'field' => 'name',
                    'name' => 'name',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Name', 'width' => 150, 'sortable' => true)
                    )
                  )
                );
    $grid_order->addField(
                  array(
                    'field' => 'jumlah',
                    'name' => 'jumlah',
                    'meta' => array(
                      'st' => array('type' => 'float'), 
                      'cm' => array('header' => 'Biaya(Realisasi)', 'width' => 150, 'sortable' => true, 'align' => 'right')
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
                    'field' => 'nosp',
                    'name' => 'nosp',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Nomor SP', 'width' => 150, 'sortable' => true)
                    )
                  )
                );
	
        $grid_order->addField(
                array(
                    'field' => 'tanggalsp',
                    'name'  => 'tanggalsp',
                    'meta' => array(
                      'st' => array('type' => 'date'), 
                      'cm' => array('header' => 'Tanggal SP','width' => 100, 'sortable' => true, 'renderer' => "Ext.util.Format.date(val,'d/m/Y')"),
                      'filter' => array('type' => 'date')
                    )                
                ));			
    $grid_order->addField(
                  array(
                    'field' => 'nofaktur',
                    'name' => 'nofaktur',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'No Faktur', 'width' => 150, 'sortable' => true)
                    )
                  )
                );
        $grid_order->addField(
                array(
                    'field' => 'tanggalfaktur',
                    'name'  => 'tanggalfaktur',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Tgl Faktur', 'width' => 100, 'sortable' => true)
                    )                
                ));	
				
  return $grid_order->doRead($request);  
  
  }

  public function create($post){
	
	$SQL = "SELECT pagu FROM kendali_akun WHERE id = '". mysql_real_escape_string($post['rekanan_id']) ."'";
	$hasil = mysql_query($SQL);
	$baris = mysql_fetch_array($hasil);
	$pagu = $baris['pagu'];
    /** start build query **/
    $this->db->BeginTrans(); 
    /** parent query **/     
    $str ="INSERT INTO kendali_order (rekanan_id, tanggal,address,information,tipe, jenis, pagu) VALUES('%s','%s','%s','%s','%s','%s','%s')"; 
    $query= sprintf($str,mysql_real_escape_string($post['rekanan_id']),
						mysql_real_escape_string($this->grid->formatDate($post['tanggal'])),
                         mysql_real_escape_string($post['address']), 
                         mysql_real_escape_string($post['information']),
						 'Farmasi', 
                         mysql_real_escape_string($post['jenis']), $pagu); 
                         
   $this->setSQL($query);   
    /** child query **/
   $ok = $this->executeSQL(); 
   //penomoran kendali bedasarakan akun
   $order_id = $this->getLastID(); 
   $nomor = 1;
   $SQL = "SELECT MAX(nomor) FROM kendali_order WHERE rekanan_id = '".$post['rekanan_id']."'";
   $hasil = mysql_query($SQL);
   $baris = mysql_fetch_array($hasil);
   if ($baris[0]>=0) {
		$nomor = $baris[0] + 1;
	}
   $SQL = "UPDATE kendali_order SET nomor = '". $nomor ."' WHERE id = '". $order_id ."'";
   $hasil = mysql_query($SQL);
   
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
        $sql[] = sprintf("INSERT INTO kendali_orders (%s) VALUES (%s)", implode(',',$col),implode(',',$val));
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
    $str ="UPDATE kendali_order SET rekanan_id='%s', tanggal='%s', address='%s', information = '%s', jenis = '%s' WHERE id = %s"; 
    $query= sprintf($str,mysql_real_escape_string($post['rekanan_id']),
						mysql_real_escape_string($this->grid->formatDate($post['tanggal'])),
                         mysql_real_escape_string($post['address']), 
                         mysql_real_escape_string($post['information']),
                         mysql_real_escape_string($post['jenis']),
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
           $query = "UPDATE kendali_orders SET %s WHERE id=%s";
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
          $sql[] = sprintf("INSERT INTO kendali_orders (%s) VALUES (%s)", implode(',',$col),implode(',',$val)); 
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
        $sql = "UPDATE kendali_orders set status = 0 WHERE id IN (%s)"; 
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
    $sql = "update kendali_orders  set status = 0 WHERE buyer_id in(%s)"; 
    $query = sprintf($sql,$data);    
    $this->setSQL($query);
    $ok = $this->executeSQL();
    if ($ok){
      $sql = "update kendali_order  set status = 0  WHERE id in (%s)"; 
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