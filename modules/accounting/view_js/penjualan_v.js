valid_script = true;  
ajax_url = 'ajax.handler.php?id=' + page;  

//nanang
idxx = -99;
Ext.util.Format.usMoney = function(v) { // override Ext.util.usMoney
    v = Ext.num(v, 0); // ensure v is a valid numeric value, otherwise use 0 as a base (fixes $NaN.00 appearing in summaryRow when no records exist)
    v = (Math.round((v - 0) * 100)) / 100;
    v = (v == Math.floor(v)) ? v + ".00" : ((v * 10 == Math.floor(v * 10)) ? v + "0" : v);
    v = String(v);

    var ps = v.split('.');
    var whole = ps[0];
    var sub = ps[1] ? '.'+ ps[1] : '.00';
    var r = /(\d+)(\d{3})/;

    while (r.test(whole)) {
            whole = whole.replace(r, '$1' + ',' + '$2');
    }

    v = whole + sub;

    if (v.charAt(0) == '-') {
        return '-$' + v.substr(1);
    }

    return "$" + v;
}

 // custom renderer example
    function change(val) {
        if (val > 0) {
            return '<span style="color:green;">' + val + '</span>';
        } else if (val < 0) {
            return '<span style="color:red;">' + val + '</span>';
        }
        return val;
    }

    // custom renderer example
    function pctChange(val) {
        if (val > 0) {
            return '<span style="color:green;">' + val + '%</span>';
        } else if(val < 0) {
            return '<span style="color:red;">' + val + '%</span>';
        }
        return val;
    }

    // custom summary renderer example
    function totalCompanies(v, params, data) {
            params.attr = 'ext:qtip="Total no. of Product"'; // summary column tooltip example
            return v? ((v === 0 || v > 1) ? '(' + v +' Item)' : '(1 Item)') : '';
    }

    // custom summary renderer example
    function averageChange(v, params, data) {
            params.attr = 'ext:qtip="Average % Change"'; // summary column tooltip example
            return v? ('Average:&#160;' + v) : '';
    }
	
var konumenStore = new Ext.data.JsonStore({
		url:'supplier.php',
		id: 'id_konumen',
		totalProperty: 'total',
		baseParams: {
			task: 'getKonumen'
		},
		root: 'data',
		fields: [
		  {name:'id'}, 
		  {name:'nama'},
		  {name:'clsname'}, 
		  {name:'icon'}
		],
		  sortInfo: {field: 'clsname', direction: 'ASC'},
		  remoteSort: true, 
		  listeners: {
				load : function(thisIcon) {
					iconcss =""; 
					thisIcon.each(function(r,i){
							row = r.data; 
							iconcss +=" "; 
							iconcss += String.format('.{0} { background-image: url(images/icon/{1}) !important; }',row.clsname,row.icon); 
							
						}
					);
					if (reloadIcon)
						Ext.util.CSS.removeStyleSheet('iconcss'); 	
					Ext.util.CSS.createStyleSheet(iconcss, 'iconcss'); 
					reloadIcon = false; 
				}
		  }
	});	
	konumenStore.load(
		{params:
			{
			start: 0, 
			limit:500
			}
		}
	);
	//konumenStore.setValue(1, true);
	
	var BBStore = new Ext.data.JsonStore({
		url:'supplier.php',
		totalProperty: 'total',
		baseParams: {
			task: 'getZazil'
		},
		root: 'data',
		fields: [
		  {name:'id'}, 
		  {name:'nama'}, 
		  {name:'harga'}
		],
		  sortInfo: {field: 'nama', direction: 'ASC'},
		  remoteSort: true,
		  autoLoad:true
	});
	
	
/*----window buyer ---- */

var summary = new Ext.ux.grid.GridSummary();

trans_detail_grid_order = Ext.extend(Ext.grid.EditorGridPanel, {
    title: 'Order',
    region: 'center',
        plugins: [summary], // have the EditorGridPanel use the GridSummary plugin
        stripeRows: true,
    clicksToEdit:1,
    loadMask:true,
    removeData:[],
    store: new Ext.data.JsonStore({
      url:ajax_url, 
      root:'data', 
      successProperty:'success',
      totalProperty:'total',
      autoLoad: false,
      remoteSort:false, 
      baseParams:{
        action :'getOrder', 
        buyer_id:0
      }, 
      fields:[
      {name:'id', type:'int'},
      {name:'bb_id',type:'int'},
      {name:'name', type:'string'},
      {name:'price', type:'float'},
      {name:'count', type:'int'},
      {name:'jumlah', type:'int'}
      ]
    }), 
    initComponent: function() {
        this.createTbar(); 
        this.columns = [
	        {
	          xtype:'numbercolumn', 
              hidden:true,
              dataIndex:'id', 
              hideable:false
	        },{
	        	dataIndex:'bb_id',
	        	hidden:true,
	        	hideable:false
	        	
	        },{
                xtype: 'gridcolumn',
                dataIndex: 'name', summaryType: 'count', summaryRenderer: totalCompanies,
                header: 'Name',
                sortable: true,
                width: 290,
                editor: {
                    xtype: 'combo',
                    hideTrigger:false,
                    store:BBStore,
                  	displayField:'nama',
                  	valueField:'nama',
                  	pageSize:10,
                  	typeAhead:true,
                  	triggerAction:'all'
                }
            },
            {
                xtype: 'numbercolumn',
                dataIndex: 'price', renderer: 'usMoney', 
                header: 'Price',
                sortable: true,
                width: 100,
                align: 'right',
                editor: new Ext.form.NumberField({allowDecimals: true})
            },
            {
                xtype: 'numbercolumn',
                header: 'Count',
                format:'0',
                sortable: true,
                width: 100,
                align: 'right',
                dataIndex: 'count',
                editor: {
                    xtype: 'numberfield'
                }
            },
            {
                xtype: 'numbercolumn',
                header: 'Jumlah', 
                sortable: true,
                width: 100,
                align: 'right',
                dataIndex: 'jumlah', renderer: 'usMoney', summaryType: 'sum',
				readonly:true,
                editor: new Ext.form.NumberField({allowDecimals: true})
            }
        ];
        trans_detail_grid_order.superclass.initComponent.call(this);
    }, 
    createTbar:function(){
      this.tbar = [
      {
        text:'Add Data',
        iconCls:'add-data', 
        scope:this,
        handler:function(){
          rec = new this.store.recordType({});
          this.store.insert(0,rec);
          this.getView().refresh();
          this.startEditing(0,1);                
        }
      },{
        text:'Remove Data',
        iconCls:'table-delete',
        scope:this,
        handler:function(){
          this.stopEditing();
          rec = this.getSelectionModel().getSelectedCell(); 
          if (!rec){
             Ext.example.msg('Peringatan','Seleksi data terlebih dahulu');
             return false;
          }
          record_data = this.store.getAt(rec[0]); 
          if (record_data.data.id){
            this.removeData.push(record_data.data.id);             
          }
	      this.store.remove(this.store.getAt(rec[0]));
	      this.getView().refresh();
	      if (this.store.getCount() > 0){
	        if (rec[0] > 0)
	          this.getSelectionModel().select(rec[0] - 1, rec[1]);
	        else
	          this.getSelectionModel().select(rec[0], rec[1]);
	      }          
        }
      }
      ]
    },
    getRemoveData:function(){
      return this.removeData; 
    }
});



var penjualan_form  = Ext.extend(Ext.Window, {
    title: 'Konsumen',
    width: 650,
    height: 459,
    layout: 'border',
    border: false,
    closeAction: 'hide',
    id: 'penjualanWindow',
    modal:true,
    initComponent: function() {
        this.buttons = this.createButton(); 
        this.grid = new trans_detail_grid_order({
      		listeners :{
      			afteredit:function(e){
      				if(e.field =='name'){
      					if(e.value){
      						//console.log(e.value);
      						var index = BBStore.find('nama',e.value);
      						//console.log(index);
      						if(index !=  -1){
      							var rec = BBStore.getAt(index);
      							e.record.set('bb_id',rec.data.id);
								e.record.set('price',rec.data.harga);
      							e.record.commit();
      						}else{
      							Ext.MessageBox.alert('Peringatan','No found item');
      							e.record.set('name',null);
      							e.record.commit();
      						}
      					}
      				}
					
					if(e.field =='count'){
						harga = e.record.get('price') * e.record.get('count');
						e.record.set('jumlah',harga);
						
      				}
      			}
      		}
        }); 
		
        this.items = [
            {
                xtype: 'form',
                region: 'north',
                border: false,
                frame: true,
                url:ajax_url, 
                autoHeight: true,
                layoutConfig: {
                    labelSeparator: ' '
                },
                items: [
                    {
                        xtype: 'hidden',
                        fieldLabel: 'Label',
                        anchor: '100%',
                        name: 'id'
                    },
					{
						
						xtype : 'iconcombo', name: 'supp_id',
						hiddenName : 'supp_id',
						fieldLabel : 'Rekanan',
						triggerAction : 'all',
						editable : false,
						store : konumenStore,
						displayField : 'nama',
						valueField : 'id',
						value: 1,
						iconClsField : 'clsname',
						mode : 'local',
						allowBlank : false,
						width : 200
						/*
						xtype: 'combo', fieldLabel: 'Supplier', width: 220,
						emptyText: 'Choose a Supplier ...', allowBlank: false,
						mode: 'local', name: 'supp_id', hiddenName: 'supp_id',
						store: supplierStore, triggerAction: 'all',
						displayField: 'nama', valueField: 'id',
						editable: 'false', id: 'supplier_id'
						*/
					},
                    {
                        xtype: 'textfield',
                        fieldLabel: 'Contact Person',
                        anchor: '100%',
                        name: 'name',
						value:'-',
                        allowBlank: false
                    },
                    {
                        xtype: 'datefield',
						format:'d/m/Y',
                        fieldLabel: 'Tanggal',
                        anchor: '100%',
                        name: 'address',
						value: 	new Date(),
                        allowBlank: false
                    },
                    {
                        xtype: 'textarea',
                        anchor: '100%',
                        fieldLabel: 'Information',
                        name: 'information'
                    }
                ]
            },this.grid
        ];
        penjualan_form .superclass.initComponent.call(this);
    }, 
    createButton:function(){
      this.botBar = [
      {
        text:'Save',
        scope:this,
        handler:function(){
			this.saveData(); 
			
        }
      },{
        text:'Close',
        scope:this,
        handler:function(){
          this.hide(); 
        }
      }
      ]; 
      return this.botBar; 
    },
    saveData:function(){
      form = this.get(0).form; 
      if (!form.isValid()){
        Ext.example.msg('Peringatan','Ada data yang tidak valid!'); 
        return false;
      }
      data =[]; 
      this.grid.store.each(function(r,i){
        data.push(r.data); 
      });
      id_data = form.getValues().id; 
      action = (id_data)?'update':'create'; 
      form.submit({
        scope:this,
        params:{
          action:action, 
          detail:Ext.encode(data),
          remove:this.grid.getRemoveData().join(',')
        }, 
        waitMsg:'Saving Data', 
        success:function(penjualan_form, result) {
			//success:function(form, result) {
			this.hide(); 
			this.onSuccess(action); 
			if(action=='create'){
				idxx = result.result.idx;
			}
			idx = id_data;
			var winprint_01 = new Ext.Window ({
			  height: 500, 
			  width: 800, 
			  title: 'Printing', 
			  html: '<iframe src="printing/print_pos.php?idx='+ idx +'" height=500 width=800></iframe>',
			  closeAction: 'close',
			  id: 'printWindow_penjualan'
			});
			
			if(idx > 0){
				winprint_01.show();
				winprint_01.hide();
			} else {
				Ext.MessageBox.alert('ID Terakhir',idxx); 
			}
        },
        failure:function(form,action){          
	         switch (action.failureType) {
	            case Ext.form.Action.CLIENT_INVALID:
	                Ext.MessageBox.alert('Failure', 'Form fields may not be submitted with invalid values');
	                break;
	            case Ext.form.Action.CONNECT_FAILURE:
	                Ext.MessageBox.alert('Failure', 'Ajax communication failed');
	                break;
	            case Ext.form.Action.SERVER_INVALID:
	                Ext.MessageBox.alert('Failure', action.result.message);
	                break;
	        }  
          
        }
      });
    }, 
    onSuccess:function(action){
      
    },
    onAddData:function(){
      this.get(0).form.reset(); 
      this.grid.store.baseParams.buyer_id = 0; 
      this.grid.store.reload(); 
    },
    reloadGrid:function(buyer_id){
      this.grid.store.baseParams.buyer_id = buyer_id;
      this.grid.store.reload(); 
    }
    
});

win_penjualan_form  = new penjualan_form ({
   onSuccess:function(action){
    grid_buyer.store.reload(); 
    grid_order.store.reload(); 
   }
}); 



/*----end window---- */

var grid_buyer = new Ext.ux.PhpDynamicGridPanel({
    title:'Order List', 
    region:'center', 
    border:false,
    remoteSort:true, //optional default true
    autoLoadStore:true, //optional default true
    storeUrl:ajax_url,
    sortInfo:{field:'name',direction:'ASC'}, //must declaration
    baseParams:{
      action:'getBuyer'
    }, 
    tbarDisable:{  //if not declaration default is true
      add:!ROLE.ADD_DATA,
      edit:!ROLE.EDIT_DATA,
      remove:!ROLE.REMOVE_DATA
    },
    onAddData:function(bt){
      win_penjualan_form .show(bt.id);    
      win_penjualan_form .onAddData(); 
   },
    onEditData:function(bt,rec){
      win_penjualan_form .setTitle('Edit Data');
      win_penjualan_form .show(bt.id); 
      win_penjualan_form .get(0).getForm().load({
          waitMsg:'Loading Data..',
          params:{action:'edit',id:rec.data.id}
      }); 
      win_penjualan_form .reloadGrid(rec.data.id); 
    },   
    onRemoveData:function(bt,rec){
      data = []; 
      Ext.each(rec,function(r){
        data.push(r.data.id); 
      }); 
      Ext.Ajax.request({
        url: ajax_url, 
        params:{
          action:'destroy',
          data:data.join(",")
        },
        success:function(res){
          result = Ext.decode(res.responseText); 
          if (result.success){
	          this.store.reload(); 
	          grid_order.store.reload();            
          }else{
            Ext.MessageBox.alert('Error',result.message);
          }

        },
        scope:this
      });       
    }    
}); 

grid_buyer.getSelectionModel().on('rowselect',function(sel,index,rec){
  grid_order.store.baseParams.buyer_id = rec.data.id; 
  grid_order.store.reload(); 
}); 

var grid_order = new Ext.ux.DynamicGridPanel({
  title :'Order', 
  border:false,
  region:'south', 
  height:270,
  collapsible:true,  
  remoteSort:true,
  storeUrl:ajax_url, 
  sortInfo:{field:'name', direction:'ASC'}, 
  baseParams:{
    action:'getOrder', 
    buyer_id:0
  }
}); 



var main_content = {
  id : id_panel,  
  title:n.text,  
  iconCls:n.attributes.iconCls,  
  layout:'border', //split for 2 column layout
  items : [grid_buyer,grid_order],
  listeners:{
    destroy:function(){
      my_win = Ext.getCmp('buyerWindow');
      if (my_win)
          my_win.destroy();
          
      mywin = Ext.getCmp('supplierWindow');
      if(mywin)
      	mywin.destroy();
    }
  }
}; 