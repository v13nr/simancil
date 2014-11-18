<?php
class Person extends msDB {
    var $grid;

    function  __construct() {
        $this->connect();
        $this->grid = new Grid;
        $this->grid->setTable('rek_susut');
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
                    'field' => 'keterangan',
                    'name'  => 'keterangan',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'rek_aktiva',
                    'name'  => 'rek_aktiva',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Rek. Aktiva','width' => 100,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'ket2',
                    'name'  => 'ket2',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan Debet','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'rek_debet',
                    'name'  => 'rek_debet',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Rek. Debet','width' => 100,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'ket3',
                    'name'  => 'ket3',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Keterangan Kredit','width' => 200,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'rek_kredit',
                    'name'  => 'rek_kredit',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Rek. Kredit','width' => 100,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));
        $this->grid->addField(
                array(
                    'field' => 'divisi',
                    'name'  => 'divisi',
                    'meta' => array(
                      'st' => array('type' => 'string'), 
                      'cm' => array('header' => 'Divisi','width' => 50,'sortable' => true),
                      'filter' => array('type' => 'string')
                    )
                ));

    }

    function create($request){
        $data = array(
          'keterangan' => $request['keterangan'],
          'rek_aktiva' => $request['rek_aktiva'],
          'ket2' => $request['ket2'],
          'rek_debet' => $request['rek_debet'],
          'ket3' => $request['ket3'],
          'rek_kredit' => $request['rek_kredit'],
          'divisi' => $request['divisi']
        );                
        return $this->grid->doCreate(json_encode($data));
    }

    function edit($id,$request){
       $this->grid->loadSingle = true;
       $this->grid->setManualFilter(" and id = $id"); 
       return $this->grid->doRead($request); 
    }
    
    function read($request){
        return $this->grid->doRead($request);
    }
    function update($request){
        $data = array(
          'id' => $request['id'],
          'keterangan' => $request['keterangan'],
          'rek_aktiva' => $request['rek_aktiva'],
          'ket2' => $request['ket2'],
          'rek_debet' => $request['rek_debet'],
          'ket3' => $request['ket3'],
          'rek_kredit' => $request['rek_kredit'],
          'divisi' => $request['divisi']
        );                
        return $this->grid->doUpdate(json_encode($data));
    }
    
    function doReport($request){
      return $this->grid->dosql($request); 
    }

    function destroy($request){
        return $this->grid->doDestroy($request);
    }
}
?>