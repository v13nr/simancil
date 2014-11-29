<?php 
 class CoreModule extends msDB {
   
   private $grid; 
   
   public function __construct(){
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('jogjaide_core.modules');

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
                    'field' => 'module',
                    'name'  => 'module',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'Module','width' => 200,'sortable' => true),
                      'editor' => array('xtype' => 'textfield'), 
                      'filter' => array('type' => 'string')
                    )
                ));   
        $this->grid->addField(
                array(
                    'field' => 'host',
                    'name'  => 'host',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => false), 
                      'cm' => array('header' => 'HOST','width' => 500,'sortable' => true),
                      'editor' => array('xtype' => 'textfield'), 
                      'filter' => array('type' => 'string')
                    )
                ));    
        $this->grid->addField(
                array(
                    'field' => 'databasee',
                    'name'  => 'databasee',
                    'meta' => array(
                      'st' => array('type' => 'string', 'allowBlank' => true), 
                      'cm' => array('header' => 'Database','width' => 200,'sortable' => true),
                      'editor' => array('xtype' => 'textfield'), 
                      'filter' => array('type' => 'string')
                    )
                ));    
        $this->grid->addField(
                array(
                    'field' => 'aktif',
                    'name'  => 'aktif',
                    'meta' => array(
                      'st' => array('type' => 'bool'), 
                      'cm' => array('xtype' => 'checkcolumn','header' => 'Active','width' => 60, 'sortable' => true),
                      'filter' => array('type' => 'boolean')
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