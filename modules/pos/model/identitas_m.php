<?php
 class Identitas extends msDB {
   
   private $grid; 
   
   public function __construct(){
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('$database.cafeid');

        $this->grid->addField(
                array(
                    'field' => 'id',
                    'name'  => 'id',
                    'primary'=> true,
                    'meta' => array(
                      'st' => array('type' => 'int'),
                      'cm' => array('hidden' => true, 'hideable' => false, 'menuDisabled' => true)
                    )
                ));

        $this->grid->addField(
                array(
                    'field' => 'nama',
                    'name'  => 'nama',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Nama','width' => 200,'sortable' => true),
                      'editor' => array('xtype' => 'textfield'), 
                      'filter' => array('type' => 'string')
                    )
                ));   
        $this->grid->addField(
                array(
                    'field' => 'alamat',
                    'name'  => 'alamat',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Alamat','width' => 500,'sortable' => true),
                      'editor' => array('xtype' => 'textfield'), 
                      'filter' => array('type' => 'string')
                    )
                ));    
           
   }
   
   public function read($request){
     return $this->grid->doRead($request); 
   }
   
   public function create($data){
     return $this->grid->doCreate($data);
   }
   
   public function update($data){
     return $this->grid->doUpdate($data); 
   }
   
   public function destroy($data){
     return $this->grid->doDestroy($data);  
   }
   
   
 }
?>